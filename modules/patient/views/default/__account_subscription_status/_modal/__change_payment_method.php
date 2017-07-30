<?php
  /**
   * @var $this \yii\web\View
   * @var $nextPaymentDate integer
   * @var $subscribeType string
   * @var $partial boolean
   */
  $customer = Yii::$app->stripe->retriveCustomerData();
  $defaultSourceId = $customer->default_source;
  $defaultCard = Yii::$app->stripe->getSource($defaultSourceId);
  $partial = isset($partial)?$partial:false;
?>
<?php if (!$partial) {?>
<div class="modal fade" id="ChangePaymentMethodModal" role="dialog" style="display: none;">
	<div class="modal-dialog modal-sm change-card">
		<div class="modal-content">
      <form class="kvk-ajax-form simple-ajax-form form-horizontal" method="post" action="/subscriber-home/change-card" data-target="#ChangePaymentMethodModal .modal-body">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Change Card in Use</h4>
        </div>
        <div class="modal-body">
          <?php } ?>
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-4">
                <label class="control-label" for="cc_no">Credit Card No:</label>
              </div>
              <div class="col-xs-8">
                <input class="col-xs-8 change-card__card form-control" name="cc_no" type="text" id="cc_no" placeholder="Enter Credit Card No">
              </div>
            </div>
            <div class="row">
            <div class="col-xs-4">
              <label class="control-label" for="cc_ed">Expiration Date:</label>
            </div>
            <div class="col-xs-5">
              <select  name="cc_month" class="form-control change-card__day">
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
              <input type="text" class="change-card__cvv form-control" id="cc_cvv"  name="cc_cvv" placeholder="CVV">
            </div>
          </div>
          </div>
	        <?php if (!$partial) {?>
        </div>
        <div class="modal-footer">
          <div class="pull-left">
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok-circle"></i> Submit</button>
          </div>
          <div class="pull-right">

            <a class="btn btn-default" href="#" data-toggle="modal" data-dismiss="modal" data-target="#ReviewPaymentMethodModal">Cancel</a>
          </div>
          <div class="clearfix"></div>
        </div>
      </form>
		</div>
	</div>
</div>
<?php } ?>