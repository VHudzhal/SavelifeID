<?php
/**
 * @var $this \yii\web\View
 * @var $partial boolean
 */
  $partial = isset($partial)?$partial:false;
?>
<?php if (!$partial) {?>
<div class="modal fade" id="reactivateModal" role="dialog" style="display: none;">
	<div class="modal-dialog modal-sm change-card">
		<div class="modal-content" id="reactivate-modal">
      <form class="kvk-ajax-form simple-ajax-form form-horizontal" method="post" action="/subscriber-home/reactivate" data-target="#reactivateModal .modal-body">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Reactivate Account</h4>
        </div>
        <div class="modal-body">
          <?php } ?>
          <h5>Please fill the valid credit card</h5>
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-4">
                <label class="control-label" for="cc_no">Credit Card No:</label>
              </div>
              <div class="col-xs-8">
                <input class="col-xs-8 change-card__card form-control js-validate-cc" name="cc_no" id="cc_no" placeholder="Enter Credit Card No" type="text">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-4">
                <label class="control-label" for="cc_ed">Expiration Date:</label>
              </div>
              <div class="col-xs-5">
                <select name="cc_month" class="form-control change-card__day">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
                <select name="cc_year" class="form-control change-card__year">
            <?php for($i=date('Y'); $i<(date('Y')+20); $i++){ ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
            <?php } ?>
                  </select>
              </div>
              <div class="col-xs-3">
                <label class="control-label" for="cc_cvv">CVV:</label>
                <input class="change-card__cvv form-control js-validate-cvv" id="cc_cvv" name="cc_cvv" placeholder="CVV" type="text">
              </div>
            </div>
          </div>

          <h5>Choose the Billing Plan</h5>
          <div class="container-fluid">
            <ul class="list-group">

              <?php
                 $plans = Yii::$app->stripe->getPlans(); $first = " checked='checked' ";
                 foreach ($plans as $plan){
  //                 \yii\helpers\VarDumper::dump($plan, 10, true);
              ?>
                   <li class="list-group-item">
                     <label for="plan-<?= $plan->id ?>"><?= ucfirst(Yii::$app->stripe->types[$plan->interval]) ?> ($<?= $plan->amount/100 ?>/<?= $plan->interval ?>)</label>
                     <div class="pull-right">
                       <input id="plan-<?= $plan->id ?>" name="plan_id" value="<?= $plan->id ?>" type="radio" <?= $first ?>>
                       <label for="plan-<?= $plan->id ?>"></label>
                     </div>
                   </li>
                  <?php $first = '';  ?>
              <?php } ?>
            </ul>
          </div>
	        <?php if (!$partial) {?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Not Now</button>
          <button type="button" class="btn btn-success js-send-popup-form">Reactivate</button>
  			</div>
      </form>
    </div>
	</div>
</div>
<?php } ?>