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
			<li class="list-group-item">
				<?php /** @var $item \app\modules\patient\models\HistoryText */ ?>

        <?= \app\components\Helper::eyeInput('RecordForm[surgical_history_text_items_ids][]', $item->text_id, [
          'checked' => $item->display,
          'label' => $item->text,
        ]); ?>

			</li>
		<?php } ?>
	<?php } ?>
</ul>
