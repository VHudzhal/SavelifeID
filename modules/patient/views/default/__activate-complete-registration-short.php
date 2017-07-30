<?php
  /**
   * @var $this \yii\web\View
   * @var $model \app\modules\patient\models\RecordForm
   */
use \app\components\Helper;
use \app\modules\patient\models\RecordForm;

$this->title = 'Complete Registration';
?>
<?= $this->render( '____activate-complete-registration-inner',     [ 'model' => $model]); ?>
<div class="col-sm-12" id="blocks">
	<?= $this->render('__record/profile-summary/index',     ['model' => $model]); ?>
  <?= $this->render('__record/emergency-contacts/index',  ['model' => $model]); ?>
</div>

