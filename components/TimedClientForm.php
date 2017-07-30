<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 01.06.17
 * Time: 11:32
 */

namespace app\components;


use kartik\form\ActiveFormAsset;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;

class TimedClientForm extends ActiveForm {
	var $errorSummaryCssClass = 'alert alert-danger';

	public function registerTries(TimedForm $model){
		$model->validateTimeout();
		if ($model->isExpired()){
			$expire  = $model->getExpire();
			$message = new JsExpression($model->triesErrorMessage);
			$attribute = new JsExpression(Html::getInputId($model, $model->maxTriesCountAttribute));
			// $model->getid.'-'$model->maxTriesCountAttribute);
			$view = $this->getView();
			$form = 'jQuery("#' . $this->options['id'].'" )' ;
			$view->registerJs("
(function($){
  if (!Date.now) {
    Date.now = function() { return new Date().getTime(); }
  }  

  var ts     = Math.floor(Date.now() / 1000);
  var expire = ts + parseInt({$expire});
  var form   = {$form};
  var msg    = '{$message}';
  var ti     = setInterval(sf, 1000); 

  $(form).on('submit', sf);
  
  function sf(e){
	var cts = Math.floor(Date.now() / 1000);
    if (expire > cts) {
      if (e) {
	    e.preventDefault();
	  }
      
      current_message = msg.replace('{time}', expire - cts);
	  $(form).yiiActiveForm('updateMessages', {
	    '{$attribute}': [current_message],
      }, true);      
      
      return false;
    } else {
	  $(form).yiiActiveForm('updateMessages', {
	    '{$attribute}': false,
      }, true);      
      clearInterval(ti);
    }
  }
  
})(jQuery);			
", View::POS_READY, 'timeout-'.$model->id);
		}
	}
}