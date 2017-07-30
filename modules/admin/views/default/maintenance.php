<?php

use yii\helpers\Html;
use app\components\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\Maintenance */
/* @var $models \app\models\Maintenance[] */
/* @var $form ActiveForm */
?>
<h2>Manage Maintenance mode</h2>
<div class="maintenance">
	<?php if (count($models) > 0){ ?>
    <?php foreach ($models as $one) { ?>
      <?php if ($one->isActive()){ ?>
        <div class="alert alert-danger">
          <strong>In Maintenance</strong> <?= $one->relevateTime(); ?>.
          <a class="pull-right glyphicon glyphicon-remove" href="/admin/remove-maintenance?id=<?= $one->id ?>"></a>
        </div>
      <?php } else { ?>
        <div class="alert alert-warning">
          <strong>Maintenance</strong> <?= $one->relevateTime(); ?>.
          <a class="pull-right glyphicon glyphicon-remove" href="/admin/remove-maintenance?id=<?= $one->id ?>"></a>
        </div>
      <?php } ?>
    <?php } ?>

  <?php } else { ?>
    <div class="text-info"><p>No maintenance scheduled</p></div>
	<?php } ?>
</div>
<div class="maintenance">

    <?php $form = ActiveForm::begin(); ?>
		<?php if ($model->hasErrors()){ ?>
			<?= \yii\helpers\Html::errorSummary($model, ['class' => 'alert alert-danger', 'header' => '']); ?>
		<?php } ?>
        <h3>Next Maintenance Start</h3>
        <?= $form->field($model, 'next_hours')->dropDownList([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,24=>24,36=>36,48=>48]); ?>
        <?= $form->field($model, 'next_mins')->dropDownList([0=>0,15=>15,30=>30,45=>45]); ?>

        <div class="form-group clearfix">
          <?= Html::submitButton('Add', ['class' => 'btn btn-primary pull-left']) ?>
        </div>
        <div class="clearfix"></div>

        <div class="form-group clearfix pull-right">
          <?= Yii::$app->controller->getMenuHtml(\app\models\Maintenance::isActiveAny()?[[ 'href' => '/?maintenance=off', 'title' => 'Turn off maintenance mode', 'class' => 'btn-danger btn-block', 'suffix' => '', 'prefix' => '<span class="glyphicon glyphicon-wrench"></span>']]:[]); ?></div>
        </div>
        <div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

</div><!-- maintenance -->
