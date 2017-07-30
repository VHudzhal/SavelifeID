<?php
  /**
   * @var $menu array
   * @var $this \yii\web\View
   */

	$buttons = '';
	foreach ($menu as $one) {
		if ($one){
			$one['class']  = isset($one['class'])?$one['class']:'';
			$one['class'] .= ' btn';

			$urls   = isset($one['item-hrefs'])?$one['item-hrefs']:[];
			$urls[] = $one['href'];
			$active = (in_array('/'.\Yii::$app->request->pathInfo, $urls));

			$one['class'] .= $active?' btn-primary':' btn-default';
			$title = $one['title'];
			if (isset($one['mobile-title'])){
				$title = "<span class='title-desktop'>{$title}</span><span class='title-mobile'>{$one['mobile-title']}</span>";
			}
			$url   = $one['href'];

			unset($one['title'], $one['href'], $one['mobile-title']);

			$buttons .= \yii\helpers\Html::a($title, $url, $one);
		} else {
			$buttons.= "</div>&nbsp;<div class='btn-group' style='margin-left: 10px;'>";
		}
	}
	$html = '<div class="btn-group">'.$buttons.'</div>';

	echo($html);
