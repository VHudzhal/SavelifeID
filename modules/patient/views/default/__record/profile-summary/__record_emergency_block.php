<?php
  /**
   * @var $class string
   * @var $items array[]
   */
?>
<ul class="<?= $class ?>">
	<?php foreach($items as $item){ ?>
		<?php if ($item){ ?>
      <li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
          <?php if (!$item['custom']) { ?>
            <?= \yii\bootstrap\Html::hiddenInput('RecordForm[emergency_profile_items_ids][]', 0)?>
            <?= \yii\bootstrap\Html::checkbox('RecordForm[emergency_profile_items_ids][]', $item['checked'], ['value' => $item['value'],'id'=> 'record-form-emergency-profile-items-'.$item['value']])?>
	          <?= \yii\bootstrap\Html::label('', 'record-form-emergency-profile-items-'.$item['value'])?>
          <?php } else { ?>
            <?= \yii\bootstrap\Html::hiddenInput('RecordForm[emergency_profile_items_ids][]', $item['value'])?>
                  <a href="#" class="glyphicon glyphicon-remove chk-6 top0 js-remove-profile-item" data-id="<?= $item['id'] ?>" data-toggle="tooltip" data-placement="left" title="Click here to remove this custom-defined text from your emergency profile and from this list"></a>
          <?php } ?>
        </span>
		    <?= \yii\bootstrap\Html::label($item['name'], 'record-form-emergency-profile-items-'.$item['value'], ['class' => 'item-name'])?>
				<div class="clearfix"></div>
			</li>
		<?php } ?>
	<?php } ?>
</ul>
