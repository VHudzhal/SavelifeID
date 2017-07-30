<?php
  /**
   * @var $this \yii\web\View
   * @var $model \app\modules\patient\models\RecordForm
   */
use \app\components\Helper;
use \app\modules\patient\models\RecordForm;

$this->title = 'Complete Registration';
$template = "<div class='form-group'>*{label}:\n{input}\n{hint}\n{error}</div>";

$this->registerCss(" .form-inline .form-group {margin-right:10px} ");
\app\assets\RecordAsset::register($this);
?>
<div class="col-sm-12 med-info__wrap" style="margin-bottom:10px;">
  <h1 class="med-info__left-title">Complete Registration</h1>
  <div class="med-info__right-text" style="padding: 24px 0 0 24px;">Select Medical History items to display when your SaveLifeID card, bracelet or necklace is scanned.</div>
</div>


<?php if ($model->display_all){ ?>
	<?= $this->render( '__activate-complete-registration-short', [ 'model' => $model]) ?>
<?php } else { ?>
	<?= $this->render('__activate-complete-registration-full', ['model' => $model]) ?>
<?php } ?>

<?php if (!Yii::$app->patient->completed_registration_date) { ?>
    <div class="container">
	      <a href="/subscriber-home/complete-registration" class="btn btn-success">Complete Registration</a>
    </div>
<?php } ?>
