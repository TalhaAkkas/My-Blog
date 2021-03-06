<?php
Yii::import('ext.feed.*');

class SiteController extends Controller {

    public $footermenu = array();
    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function beforeAction($action) {
        $this->footermenu['firstcolumnheader'] = "En Son Yazılar";

        $firstArray = array();
        foreach (Article::model()->findAll() as $article) {
            array_push($firstArray, array('href' => "../article/" . $article->id, 'text' => $article->title));
        }
        $this->footermenu['firstcolumn'] = array_reverse($firstArray);
        $this->footermenu['secondcolumnheader'] = "Bazı Yazılar";

        return true;
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'

        $this->redirect(array('article/index'));
        //$this->render('article/index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.'.Yii::app()->params['adminEmail']);
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }


    public function actionFeed($id = ''){
        $posts =  Article::model()->findAll(array(
            'order'=>'id DESC',
        ));
        
        $feed = new EFeed(EFeed::ATOM);
        $feed->title = 'TalhAkkas.Com';
        $feed->link = 'http://www.TalhAkkas.Com';
 
        $feed->addChannelTag('updated', date(DATE_ATOM, time()));
        $feed->addChannelTag('author', array('name'=>'Talha Büyükakkaşlar'));
        $pop = 0;
        foreach($posts as $post){
            $val = $id == '';
            $item = $feed->createNewItem();
 
            $item->title = $post->title;
            $item->link  = "http://www.talhakkas.com/article/".$post->id;
            // we can also insert well formatted date strings
            $item->date = date($post->holder0->date) ;
            $item->description = $post->text;
            
            foreach($post->holder0->tags as $t){
               if(strtolower($id)==strtolower ($t->text))
                   $val = true;
            }
            if($val){
                $feed->addItem($item);
                $pop ++;
                if($pop > 20)
                    break;
            }
            
        }
        if($pop)
            $feed->generateFeed();
    }
}