<?php
/**
 * @var $class string
 * @var $form \app\components\ActiveForm
 * @var $items array[]
 */
?>
<ul class="<?= $class ?>">
	<?php foreach($items as $item){ ?>
		<?php if ($item){ ?>
      <li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
				<?php /** @var $item \app\modules\patient\models\HistoryText */ ?>

        <?= \app\components\Helper::eyeInput('RecordForm[medical_history_text_items_ids][]', $item->text_id, [
          'checked' => $item->display,
          'label' => $item->text,
        ]); ?>

			</li>
		<?php } ?>
	<?php } ?>
</ul>
