<?php
  /**
   * @var $this \yii\web\View
   * @var $model \app\modules\patient\models\RecordForm
   * @var $type string
   */

	use app\modules\patient\models\PatientFiles;

	$meta = [
		PatientFiles::TYPE_ADVANCED_DIRECTIVE => [
			'models' => Yii::$app->patient->model->filesAdvancedDirective,
			'title' => 'Advanced Directives',
	    'filename' => 'Advanced Directive',
			'field' => 'display_advance_directives'
		],
		PatientFiles::TYPE_EKG => [
			'models' => Yii::$app->patient->model->filesEKG,
			'title' => 'EKG',
			'filename' => 'EKG',
			'field' => 'display_ekg'
		],
		PatientFiles::TYPE_OTHER => [
			'models' => Yii::$app->patient->model->filesOther,
			'title' => 'Medical Images/Records',
			'filename' => 'Medical Image',
			'field' => 'display_other_documents'
		]
	];

	if (!$meta[$type]['models']) return;
	$model->file_type = $type;
?>

<?= \app\modules\patient\components\widgets\RecordBlock::widget([
  'scenario' => \app\modules\patient\models\RecordForm::SCENARIO_FILES,
  'block_id'  => uniqid(sha1($type)),
  'title'     => [
    'checked'   => 'Click to prevent any '.$model->getAttributeLabel($meta[$type]['field']).' from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
    'unchecked' => 'Click to allow selected '.$model->getAttributeLabel($meta[$type]['field']).' to appear on your emergency profile; otherwise none will appear.'
  ],
  'subtitle'  => [
    'checked'   => $model->getAttributeLabel($meta[$type]['field']).' can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball',
    'unchecked' => $model->getAttributeLabel($meta[$type]['field']).' information will not be displayed in your emergency profile until you click the section\'s eyeball to enable it.',
  ],
  'model'     => $model,
  'attribute' => $meta[$type]['field'],
  'content'   => $this->render('__patient_files_block', ['model' => $model,'items' => $meta[$type]['models'], 'class' => 'list-group', 'name' => $meta[$type]['filename']]),
]) ?>
