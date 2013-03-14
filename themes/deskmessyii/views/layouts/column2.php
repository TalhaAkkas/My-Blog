<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
    <div id="main-blog">
        <div class="clear">&nbsp;</div>
        <?php echo $content; ?>
        <!-- content -->
    </div>
    <div id="sidebar">
        <?php
        $this->beginWidget('Sidebar', array(
        ));
        if (!Yii::app()->user->isGuest) {
            if (isset($this->menu['sidemenu'])) {
                $this->beginWidget('SidebarWidget', array(
                    'title' => 'Yönetim Seçenekleri',
                ));

                echo '<ul>';
                foreach ($this->menu['sidemenu'] as $item) {
                    echo '<li>';
                    if (isset($item['url'])) {
                        $label = $item['label'];
                        echo CHtml::link($label, $item['url'], isset($item['linkOptions']) ? $item['linkOptions'] : array());
                    }


                    //echo "<a href='{}'>  {} </a>";
                    echo '</li>';
                }

                echo '</ul>';

                $this->endWidget();
            }
        }
        if (isset($this->footermenu)) {
            $this->beginWidget('SidebarWidget', array(
                'title' => $this->footermenu['firstcolumnheader'],
            ));

            echo '<ul>';

            foreach ($this->footermenu['firstcolumn'] as $element) {
                echo '<li>';
                echo "<a href='{$element['href']}'>'{$element['text']}'</a>";

                echo '</li>';
            }

            echo '</ul>';

            $this->endWidget();
        }
        if (isset($this->articles)) {

            $i = 0;
            $secondArray = array();
            foreach ($this->articles as $article) {
                $secondArray["../article/" . $article->id] = $article->title;
                $i++;
                if (count($secondArray) > 5) {
                    break;
                }
            }
            $this->beginWidget('SidebarWidget', array(
                'title' => $this->footermenu['secondcolumnheader'],
            ));

            echo '<ul>';

            foreach ($secondArray as $key => $value) {
                echo '<li>';
                echo "<a href='{$key}'>'{$value}'</a>";
                echo '</li>';
            }

            echo '</ul>';

            $this->endWidget();
        }

        $this->endWidget();
        ?>
    </div><!-- sidebar -->
    <div class="clear"></div>
</div>
<?php $this->endContent(); ?>




