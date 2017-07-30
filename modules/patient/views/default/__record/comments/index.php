<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<?php if ($model->comments) { ?>
	  <?= \app\modules\patient\components\widgets\RecordBlock::widget([
  		'scenario' => RecordForm::SCENARIO_COMMENTS,
		  'block_id'  => 'comments',
		  'title'     => [
			  'checked'   => 'Click to prevent any Comments from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
			  'unchecked' => 'Click to allow selected Comments to appear on your emergency profile; otherwise none will appear.'
		  ],
		  'subtitle'  => [
			  'checked'   => 'Comments will now be displayed on your profile',
			  'unchecked' => 'Comments information will not be displayed in your profile.',
		  ],
		  'model'     => $model,
		  'attribute' => 'display_comments',
		  'content'   => $this->render('__record_comments_block', ['item' => $model->comments, 'class' => 'list-group margin-bottom-0']),
	  ]) ?>
<?php } ?>
