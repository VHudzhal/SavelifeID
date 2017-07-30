<?php
/**
 * @var $class string
 * @var $form \app\components\ActiveForm
 * @var $items \app\modules\patient\models\OtherPhysicians[]
 * @var $this \yii\web\View
 */
?>
<ul class="<?= $class ?>">
	<?php foreach($items as $item){ ?>
		<?php if ($item){ ?>
        <?= $this->render('____physicians-contact-info-item', ['item' => $item]) ?>
		<?php } ?>
	<?php } ?>
</ul>
<div class="clearfix"></div>