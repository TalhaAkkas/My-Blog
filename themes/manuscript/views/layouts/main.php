<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/coderblog.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/scripts.js"></script>
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    </head>
    <body>
        <div class="content">
            <div id="header">
                <div class="title">
                    <h1>Talha Büyükakkaşlar</h1>
                    <h3>Yazılım Programlama Birazda Oraya Buraya Dağılmış Düşünceler</h3>
                </div>
            </div>
            <div id="main">
                <div class="center">
                    <?php echo $content; ?>

                </div>
                <div class="leftmenu">
                    <div class="nav">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array('label' => 'Home', 'url' => array('/site/index')),
                                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                                array('label' => 'Contact', 'url' => array('/site/contact')),
                                array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                            ),
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div id="prefooter">
                <?php
                if (!isset($this->tags)){
                    $tags = Tag::model()->findAll();
                    $header = "Bazı Yazılar";
                }
                else {
                    $header = $this->footermenu['secondcolumnheader'];
                    $tags = $this->tags;
                }
                 $this->widget('FooterMenu', array(
                'firstcolumheader' => $this->footermenu['firstcolumnheader'],
                'firstcolumlist' => $this->footermenu['firstcolumn'],
                'secondcolumheader' => $header,
                'secondcolumlist' => $tags,
                ));
                ?>
            </div>
            <div id="footer">
                <div class="padding"> Copyright &copy; <?php echo date('Y', time()) . ' ' . CHtml::encode(Yii::app()->name); ?>    
                    | Design: <a href="http://www.free-css-templates.com">David Herreman </a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.solucija.com">Solucija.com</a> | <a href="http://www.free-css.com/">Login</a> </div>
            </div>
        </div>
    </body>
</html>
