<?php
/**
 * @var $class string
 * @var $form \app\components\ActiveForm
 * @var $items array[]
 */
?>
<ul class="<?= $class ?>">
	<?php foreach ( $items as $item ) { ?>
		<?php if ( $item ) { ?>
      <li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
    			<?php /** @var $item \app\modules\patient\models\Insurance */ ?>

	        <?= \app\components\Helper::eyeInput('RecordForm[insurance_items_id][]', $item->life_insurance_id, [
		        'checked' => $item->display,
		        'label' => false,
		        'clearfix' => false,
            'id' => 'record-form-insurance-items-'.$item->life_insurance_id
	        ]); ?>
          <label class="pull-left item-name" for="record-form-insurance-items-<?= $item->life_insurance_id?>">
            <div>
              <b>Plan Name:</b> <?= $item->name ?>
            </div>
            <?php if ( $item->insurance_plan_number ) { ?>
            <div>
              <b>Plan Number:</b> <?= $item->insurance_plan_number ?>
            </div>
            <?php } ?>
            <?php if ( $item->insurance_plan_member_id ) { ?>
            <div>
              <b>Member ID:</b> <?= $item->insurance_plan_member_id ?>
            </div>
            <?php } ?>
            <?php if ( $item->insurance_group_id ) { ?>
            <div>
              <b>Group ID:</b> <?= $item->insurance_group_id ?>
            </div>
            <?php } ?>
            <?php if ( $item->insurance_phone_number ) { ?>
            <div>
              <b>Phone:</b> <?= $item->insurance_phone_number ?>
            </div>
            <?php } ?>
            <?php if ( $item->insurance_file_name ) { ?>
            <div>
              <b>Insurance Card:</b> <?= $item->insurance_file_name ?>
            </div>
            <?php } ?>
          </label>
          <div class="clearfix"></div>
        </li>
		<?php } ?>
	<?php } ?>
</ul>
