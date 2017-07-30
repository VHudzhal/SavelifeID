<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\patient\models\PracticesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practices-index">

    <h1><?= Html::encode('Manage Practices') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'practice_id',
            'practice_name',
            'practice_umr_id',
            'auth_user',
            'auth_pass',
            'enrollment_code',
            // 'partner_id',
            'demo',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update}',
              'buttons' => [
	              'update' => function ($url, $model) {
	                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-pencil"]);
		              return "<a href='$url' title='Update Practice #{$model->practice_id}' data-pjax='0' class='js-popup'>$icon</a>";
	              }
              ]


            ],
        ],
    ]); ?>

    <p>
      <?= Html::a('Create Practice', ['create'], ['class' => 'btn btn-default']) ?>
    </p>

</div>
<?php

  $this->registerJs("
$('.js-popup').on('click', function(e){
  e.preventDefault();
    
  var options = {
        url: $(this).attr('href'),
        title: $(this).attr('title'),
        size: eModal.size.sm,
    };  
  
  eModal.iframe(options);
});
");