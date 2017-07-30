<?php
  /**
   * @var $this \yii\web\View
   * @var $nextPaymentDate integer
   * @var $subscribeType string
   */
  $anotherPlan = null;
  $plans = \Yii::$app->stripe->getPlans();
  foreach ($plans as $key => $plan){
    if ($key != Yii::$app->stripe->getSubscribeType()){
	    $anotherPlan = $plan;
    }
  }
?>
<div class="modal fade" id="ReviewBillingScheduleModal" role="dialog" style="display: none;">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Review Billing Schedule</h4>
			</div>
			<div class="modal-body">
				<p>
          Your last payment covers service until <?= Yii::$app->formatter->asDate(\Yii::$app->stripe->getNextPaymentDate(),'medium'); ?>.
          Your next payment ($<?= \Yii::$app->stripe->getSubscribeAmount()/100 ?>/<?= \Yii::$app->stripe->getSubscribeType() ?>)
          will then cover continued service for another <strong><?= \Yii::$app->stripe->getSubscribeType() ?></strong> starting that day.
        </p>
  		  <?php if ($anotherPlan){ ?>
        <p>
          If you prefer, you can convert your plan to <?= Yii::$app->stripe->types[$anotherPlan->interval] ?> billing
          ($<?= $anotherPlan->amount/100?>/<?= $anotherPlan->interval ?>) starting with your next payment, so the payment
          would cover a <strong><?= $anotherPlan->interval ?></strong> of service starting on
	        <?= Yii::$app->formatter->asDate(\Yii::$app->stripe->getNextPaymentDate(),'medium'); ?> instead.
        </p>
	      <?php } ?>
			</div>
			<div class="modal-footer">
        <div class="pull-left">
          <button type="submit" class="btn btn-primary btn-sm" data-dismiss="modal">Continue <?= \Yii::$app->stripe->getSubscribeTypeName() ?></button>
        </div>
		    <?php if ($anotherPlan){ ?>
        <form class="kvk-ajax-form simple-ajax-form pull-right" method="post" action="/subscriber-home/switch-plan" data-target="#ReviewBillingScheduleModal .modal-body">
          <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
          <input type="hidden" name="id" value="<?= $anotherPlan->id ?>">
          <button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-transfer"></i> Switch to <?= ucfirst(Yii::$app->stripe->types[$anotherPlan->interval]) ?></button>
        </form>
    	  <?php } ?>
        <div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>