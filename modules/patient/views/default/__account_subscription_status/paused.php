<?php /** @var $this \yii\web\View */ ?>
<h3 style="margin:0">Subscription status
	<span class="label label-default" style="margin-left:10px"><?= ucfirst(Yii::$app->patient->status) ?></span></h3>
<p style="margin-top:4px"><b>Next <?= \Yii::$app->stripe->getSubscribeTypeName() ?> payment <?= date('Y-m-d', \Yii::$app->stripe->getNextPaymentDate()) ?></b></p>
  <p>
    <a class="btn btn-default emodal-ajax" href="/subscriber-home/account-status?popup=ReviewBillingScheduleModal" ><i class="glyphicon glyphicon-calendar"></i> Billing Shedule</a>
    <a class="btn btn-default" href="/subscriber-home/previous-payments"><i class="glyphicon glyphicon-tasks"></i> Previous Payments</a>
    <a class="btn btn-default emodal-ajax" href="/subscriber-home/account-status?popup=ReviewPaymentMethodModal"><i class="glyphicon glyphicon-credit-card"></i> Payment Method</a>
  </p>
<div class="row">
  <div class="col-sm-6">
    <form method="post" action="/subscriber-home/set-status" data-target="#subscription-status .panel-body">
      <p>Because your account is paused, your medical profile will not display when your card is scanned. Resuming your account will restore this function.</p>
      <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
      <input type="hidden" name="status" value="<?= \app\modules\patient\models\Patient::STATUS_ACTIVE ?>">
      <button type="submit" class="btn btn-success right">Resume Account</button>
    </form>
    <div class="clearfix"></div>
  </div>
  <div class="col-sm-6">
    <p>If you wish to remove your account entirely, along with all medical information, and stop any future payments, you can cancel your account. If you cancel, you will need to re-enroll from scratch with your physician.</p>
    <button type="button" class="btn btn-danger right" data-toggle="modal" data-target="#cancelModal">Cancel Account</button>
    <div class="clearfix"></div>
  </div>
</div>


<?= $this->render('_modal/__cancel') ?>
