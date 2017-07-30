<?php

/**
 * @var $class string
 * @var $name string
 * @var $this \yii\web\View
 * @var $items \app\modules\patient\models\PatientFiles[]
 */

?>
<ul class="<?=$class?> margin-bottom-0">
	<?php foreach($items as $item){ ?>

    <li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
	    <?= \app\components\Helper::eyeInput('RecordForm[file_id][]', $item->patient_files_id, [
		    'checked' => $item->display,
		    'label' => false,
  	    'clearfix' => false,
        'id' => 'patient_file_display-'.$item->patient_files_id
	    ]); ?>
      <label class="pull-left item-name" for="patient_file_display-<?= $item->patient_files_id?>">
	      <?php
	      if (!$name){
		      $name = $item->file_name .'.'. $item->file_extension;
		      $name = $item->file_description?$item->file_description:$name;
	      }
	      $attrs = '';
        $href = $item->getHref();
	      switch ($item->file_extension){
		      case 'jpg':
		      case 'png':
		      case 'gif':
			      $attrs = 'data-fancybox';
			      $href = '/subscriber-home/preview-image?url='.base64_encode($href);
			      break;
		      default:
			      $attrs = 'target="_blank" ';
	      }

	      ?>
        <a href="<?= $href ?>" <?= $attrs ?> ><?= $name ?></a>
        (<?= $item->file_date ?>)
      </label>
      <div class="clearfix"></div>
    </li>

	<?php } ?>
</ul>
<?= \yii\bootstrap\Html::activeHiddenInput($model, 'file_type') ?>

