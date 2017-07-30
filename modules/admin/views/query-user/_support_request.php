<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\patient\models\Patient */

if ($model->support_request == 0){
?>

	<div class="alert alert-warning js-support-request">
    Awaiting patient's confirmation
    <img src="/img/preloader.gif" style="height: 48px;">
  </div>

<?php
    $this->registerJs("
(function($){

  var ti=setInterval(function(){
$.get('/admin/query-user/support-request-status?id=".$model->patients_id."', function(data){
  if (data.status == 1){
    $('.js-support-request').removeClass('alert-warning').addClass('alert-success').html('Support session has been confirmed.');
  }
}, 'json');  
}, 2000);

})(jQuery);    
");
}

