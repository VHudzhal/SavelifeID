<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\patient\models\Practices */

$this->title = 'Update Practices: ' . $model->practice_id;
$this->params['breadcrumbs'][] = ['label' => 'Practices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->practice_id, 'url' => ['view', 'id' => $model->practice_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="practices-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
