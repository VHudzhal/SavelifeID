<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\patient\models\Patient */

$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-view">
    <?php if ($model->support_request == 1){ ?>
      <a href='/admin/query-user/query?id=<?= $model->patients_id ?>' class="pull-right btn btn-info">Open support session</a>
    <?php } ?>

    <h1><?= Html::encode('View patient #'.$model->patients_id) ?></h1>

    <?php
      foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
      }
    ?>

    <?= $this->render('_support_request', ['model' => $model]) ?>

    <h2>SaveLifeID account details</h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
	        'email:email',
	        'internal_id',
	        'self_registered' => [
	          'attribute' => 'self_registered',
	          'value' => function($model){
		          return $model->self_registered?"true":"false";
	          }
          ],
	        'status',
	        'password' => [
	          'attribute' => 'self_registered',
	          'label' => 'Has password',
	          'value' => function($model){
		          return $model->password ?"true":"false";
	          }
          ],
	        'date_created',
	        'last_updated',
	        'practice_id',
	        'expiration_date',
	        'completed_registration_date',
        ],
    ]) ?>

    <h2>Stripe Info</h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'stripe_customer',
            'stripe_subscription_id',
            'stripe_subscription_type',
        ],
    ]) ?>

    <h2>Subscriber details</h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
	        'first_name',
	        'last_name',
	        'billing_name',
	        'address_1',
	        'address_2',
	        'city',
	        'state',
	        'cell_phone',
	        'zip',
        ],
    ]) ?>

    <h2>User tokens</h2>


    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $tokenProvider,
        'perfectScrollbar' => true,
        'columns' => [
	        'token_slid',
	        'token_id',
	        'enrollment',
	        'active',
	        'token_type',
	        'description',
        ],
    ]) ?>

</div>
