<?php
/**
 * @var $model \app\modules\patient\models\Patient
 * @var $this \yii\web\View
 */
\app\assets\AjaxFormAsset::register($this);
$this->title = 'Account Information';

?>

<div class="panel-body">
	<?php /** @var $this \yii\web\View */ ?>
	<h3 style="margin:0">Subscription status
		<span class="label label-success" style="margin-left:10px">Active</span></h3>
	<p style="margin-top:4px"><b>Next <?= \Yii::$app->stripe->getSubscribeTypeName() ?> payment <?= date('Y-m-d', \Yii::$app->stripe->getNextPaymentDate()) ?></b></p>
	<p>
		<a class="btn btn-default emodal-ajax" href="/subscriber-home/account-status?popup=ReviewBillingScheduleModal" ><i class="glyphicon glyphicon-calendar"></i> Billing Shedule</a>
		<a class="btn btn-primary" href="/subscriber-home/previous-payments"><i class="glyphicon glyphicon-tasks"></i> Previous Payments</a>
		<a class="btn btn-default emodal-ajax" href="/subscriber-home/account-status?popup=ReviewPaymentMethodModal"><i class="glyphicon glyphicon-credit-card"></i> Payment Method</a>
	</p>
	<div class="row">
		<div class="col-sm-12">

		<?= \kartik\grid\GridView::widget([
			'emptyText' => '<div class="red">No matching data.</div>',
			'dataProvider' => $provider,
			'columns' => [
		    'created' => [
		      'attribute' => 'created',
	      'value' => function ($model) {
		      return date('m/d/Y', $model['created']);
	      },
        ],
        'amount' => [
          'attribute' => 'amount',
          'value' => function ($model) {
	          return '$'.$model['amount'] / 100;
          },
        ],
        'plan',
	      'details' => [
	        'format' => 'raw',
          'label' => 'Details',
          'value' => function($model){
		          $href = "/subscriber-home/account-status?popup=paymentDetails&pid=".$model['id'];
              return \yii\helpers\Html::a('details', $href, ['class' => 'emodal-ajax']);
          }
        ],
        'сontest' => [
	        'format' => 'raw',
	        'label' => 'Contest',
	        'value' => function($model){
		        $href = "/subscriber-home/account-status?popup=paymentContest&pid=".$model['id'];
		        return \yii\helpers\Html::a('contest', $href, ['class' => 'emodal-ajax']);
	        }
        ]
			],
		]); ?>
    </div>
	</div>

</div>
