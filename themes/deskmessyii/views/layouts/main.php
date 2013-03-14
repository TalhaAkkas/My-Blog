<?php
/**
 * Desk Mess Mirrored
 *
 * Theme Description: Marble desktop covered with a mix of old and new items,
 * such as some vintage papers, a stainless steel pen, and, a hot cup of coffee!
 * Now with more documentation and post-format support for the following types:
 * asides, quotes and status!
 *
 * @package     Desk_Mess_Mirrored
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/desk-mess-mirrored/
 * @link        https://github.com/Cais/desk-mess-mirrored/
 * @link        http://wordpress.org/extend/themes/desk-mess-mirrored/
 *
 * @internal    REQUIRES WordPress version 3.4
 * @internal    Tested up to WordPress version 3.4
 *
 * @version     2.0.4
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.
 *
 * You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to:
 *
 *      Free Software Foundation, Inc.
 *      51 Franklin St, Fifth Floor
 *      Boston, MA  02110-1301  USA
 *
 * The license for this software can also likely be found here:
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @internal Project To-do List - see readme.txt for pre-2.0 PTL
 * @todo Review / Update 404.php page
 * @todo Review adding 'category.php' template back into theme files (also consider 'tag.php', 'date.php', etc.)
 * @todo Review post meta comment text - sort out how to show amount of comments if they exist when comments are closed
 * @todo Review verbiage used for the 'Page Link' on pages (see `the_shortlink`)
 * @todo Add Post-Format: Link - use infinity symbol (2.1-early)
 * @todo Add 'search.php' template? (see http://wordpress.org/support/topic/theme-desk-mess-mirrored-searchphp-for-theme-version-191)
 * @todo Add specific CSS to the placeholders used by the new (comment) author classes
 * @todo Add more i18n support, for example: create and include a current '.pot' file
 * @todo Review menu issues with bbPress?! see BNS comment: http://buynowshop.com/themes/desk-mess-mirrored/comment-page-3/#comment-12440
 * @todo Review About box in the 'author.php' template
 *
 * @version 2.0.3
 * @date    July 5, 2012
 * see changelog.txt for details of theme updates / modifications
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head profile="http://gmpg.org/xfn/11">
        <title><?php echo 'Muhammet Talha Büyükakkaşlar Kişisel Web Sitesi'; ?></title>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" media="screen, projection" />  
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/coderblog.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/editor-style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/extra.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/scripts.js"></script>
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-35916805-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </head>

    <body>
        <div id="mainwrap">
            <div id="header-container">
                <div id="header"> <!-- header -->
                    <div id="headerleft"></div>
                    <div id="logo">
                        <h2>Talha Büyükakkaşlar</h2>
                        <p>Yazılım Programlama Birazda Oraya Buraya Dağılmış Düşünceler</p>
                    </div> <!-- #logo -->
                    <div id="cup"></div>
                    <div id="top-navigation-menu">
                        <?php
                        $this->widget('TopMenuCustomize');
                        ?>
                    </div>
                </div> <!-- #header -->
            </div> <!-- #header-container -->
            <div id="maintop"></div>
            <div id="wrapper">
                <?php echo $content; ?>
            </div><!--end wrapper-->
            <div id="bottom"></div>
            <div id="bottom-extended">
                <div id="bottom-container">
                    <div class="padding"> Copyright &copy; <?php echo date('Y', time()) . ' ' . CHtml::encode(Yii::app()->name); ?>    
                        | Design: <a href="http://www.free-css-templates.com">David Herreman </a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.solucija.com">Solucija.com</a> | <a href="http://www.free-css.com/">Login</a> </div>

                </div> <!-- #bottom-container -->
            </div> <!-- #bottom-extended -->
        </div> <!-- #mainwrap -->
    </body>
</html>