<?php
  /**
   * @var $menu array
   * @var $this \yii\web\View
   */

	$buttons = '';
	foreach ($menu as $one) {
		if ($one){
			$urls   = isset($one['item-hrefs'])?$one['item-hrefs']:[];
			$urls[] = $one['href'];
			$active = (in_array('/'.\Yii::$app->request->pathInfo, $urls));

			$prefix = isset($one['prefix'])?$one['prefix']:'<span class="glyphicon"></span>';
			$suffix = isset($one['suffix'])?$one['suffix']:'<span class="glyphicon glyphicon-chevron-right right"></span>';

			$one['class']  = isset($one['class'])?$one['class']:'';
			$title = $one['title'];
			if (isset($one['mobile-title'])){
				$title = "<span class='title-desktop'>{$title}</span><span class='title-mobile'>{$one['mobile-title']}</span>";
			}
			$url   = $one['href'];

			unset($one['title'], $one['href'], $one['mobile-title'], $one['prefix'], $one['suffix']);

			$buttons .= '<li class="'. ($active?"active":"") .'">';

			$suffix  .= '<div class="clearfix"></div>';
			$title    = $prefix . $title . $suffix;

			$one['data-target'] = "#";

			$buttons .= \yii\helpers\Html::a($title, $url, $one);

			$buttons .= '</li>';
		} else {
			$buttons .= "<li><hr style='margin:10px 0;'></li>";
		}
	}
	$html = '<ul class="nav nav-pills nav-stacked">'.$buttons.'</ul>';

	echo($html);

