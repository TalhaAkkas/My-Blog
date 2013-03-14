<?php

class ArticleController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $footermenu = array();
    public $tags = array();
    public $articles = array();

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'articleview', 'commentAjax'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'create', 'update'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function beforeAction($action) {
        $this->footermenu['firstcolumnheader'] = "En Son Yazılar";

        $firstArray = array();
        foreach (Article::model()->findAll() as $article) {
            array_push($firstArray, array('href' => $article->id, 'text' => $article->title));
        }
        $this->footermenu['firstcolumn'] = array_reverse($firstArray);
        $this->footermenu['secondcolumnheader'] = "Bazı Yazılar";
        $this->tags = Tag::model()->findAll();
        foreach ($this->tags as $tags) {
            foreach ($tags->holders as $holder) {
                $prop = Article::model()->findAll("holder = ?", $holder->id);
                foreach ($prop as $article) {
                    array_push($this->articles, $article);
                }
            }
        }
        return true;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $comment = new Comment;
        $model = $this->loadModel($id);
        $this->footermenu['secondcolumnheader'] = "Benzer Yazılar";
        $this->tags = $model->holder0->tags;
        foreach ($this->tags as $tags) {
            foreach ($tags->holders as $holder) {
                $prop = Article::model()->findAll("holder = ?", $holder->id);
                foreach ($prop as $article) {
                    array_push($this->articles, $article);
                }
            }
        }
        // uncomment the following code to enable ajax-based validation
//       if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-ArticleView-form-commentform') {
//            echo CActiveForm::validate($model);
//            Yii::app()->end();
//        }

        if (isset($_POST['Comment'])) {
            $comment->owner = $model->holder;
            $comment->attributes = $_POST['Comment'];
            if ($comment->validate()) {
                $comment->save();
            }
            $this->redirect(array('view', 'id' => $model->id));
        }
        $this->render('view', array(
            'model' => $model,
            'comment' => $comment
        )
       );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {


        $model = new Article;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Article'])) {
//                     die(print_r($_POST));
            $model->attributes = $_POST['Article'];
            $model->title = $model->title;
            $model->holder0 = new Holder();
            $model->holder0->save();
            $model->holder = $model->holder0->id;
            foreach (TagHolder::model()->findall('holder = \'' . $model->holder . '\'') as $th) {
                $th->delete();
            }
            foreach (explode('~', $_POST['Article']['tagstr']) as $tagtext) {
                if ($tagtext == '')
                    continue;
                if (Tag::model()->find('text = \'' . $tagtext . '\'')) {
                    $tag = Tag::model()->find('text = \'' . $tagtext . '\'');
                } else {
                    $tag = new Tag();
                    $tag->text = $tagtext;
                    $tag->save();
//                                die(print_r($tag->text));
                }
                $tagholder = new TagHolder;
                $tagholder->tag = $tag->id;
                $tagholder->holder = $model->holder;
                try {
                    $tagholder->save();
                } catch (CDbException $error) {
                    
                }
            }
            $model->holder0->save();

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            foreach (TagHolder::model()->findall('holder = \'' . $model->holder . '\'') as $th) {
                $th->delete();
            }
            foreach (explode('~', $_POST['Article']['tagstr']) as $tagtext) {
                if ($tagtext == '')
                    continue;
                if (Tag::model()->find('text = \'' . $tagtext . '\'')) {
                    $tag = Tag::model()->find('text = \'' . $tagtext . '\'');
                } else {
                    $tag = new Tag();
                    $tag->text = $tagtext;
                    $tag->save();
//                                die(print_r($tag->text));
                }
                $tagholder = new TagHolder;
                $tagholder->tag = $tag->id;
                $tagholder->holder = $model->holder;
                try {
                    $tagholder->save();
                } catch (CDbException $error) {
                    
                }
            }
            $model->holder0->save();
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $holder = $this->loadModel($id)->holder0;
            $this->loadModel($id)->delete();
            $holder->delete();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Article', array(
            'sort'=>array(
                    'defaultOrder'=>'id DESC',
                ),
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Article('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Article']))
            $model->attributes = $_GET['Article'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Article::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'article-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


    public function actionCommentAjax($id) {
        echo "hohohhohohoh";
        print_r($_POST['Comment']);
        $model = new Comment;
        $article = $this->loadModel($id);
        $model->owner = $article->holder;
        // uncomment the following code to enable ajax-based validation
//       if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-ArticleView-form-commentform') {
//            echo CActiveForm::validate($model);
//            Yii::app()->end();
//        }

        if (isset($_POST['Comment'])) {
            $model->attributes = $_POST['Comment'];
            if ($model->validate()) {
                $model->save();
            }
        }
        
        //$this->renderPartial('../comment/commentsList', array('commentsList' => $article->holder0->comments), false, true);
    
        
    }

}
