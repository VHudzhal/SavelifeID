<?php
 /***
  * @var $item \app\modules\patient\models\OtherPhysicians
  */
?>

<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">

	<?= \app\components\Helper::eyeInput('RecordForm[other_physicians_id][]', $item->physician_id, [
		'checked' => $item->display,
		'label' => false,
		'clearfix' => false,
		'id' => 'patient_file_display-'.$item->physician_id
	]); ?>
  <label class="pull-left item-name" for="record-form-physicians-items-<?= $item->physician_id?>">
    <div>
      <b><?= $item->physician_name ?></b>
	    <?php  if ($item->main_physician){ ?>
          <span>(Main Physician)</span>
	    <?php } ?>
    </div>
	  <?php if ($item->physician_specialty){ ?>
        <div>
          <b>Specialty:</b> <?= $item->physician_specialty ?>
        </div>
	  <?php } ?>
	  <?php if ($item->physician_phone){ ?>
        <div>
          <b>Phone:</b> <?= $item->physician_phone ?>
        </div>
	  <?php } ?>
	  <?php if ($item->address || $item->city || $item->state || $item->zip){ ?>
        <div>
          <b>Address:</b>
        </div>
        <div>
		    <?php if ($item->address){ ?>
              <div><?= $item->address ?></div>
		    <?php } ?>
		    <?php if ($item->city || $item->state || $item->zip){ ?>
              <div><?php if ($item->city){ ?><?= $item->city ?>, <?php } ?><?= $item->state ?> <?= $item->zip ?></div>
		    <?php } ?>
        </div>
	  <?php } ?>
  </label>
  <div class="clearfix"></div>
</li>
