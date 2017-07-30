<?php
  /**
   * @var $this \yii\web\View
   * @var $nextPaymentDate integer
   * @var $subscribeType string
   */
  $customer = Yii::$app->stripe->retriveCustomerData();
  $defaultSourceId = $customer->default_source;
  $defaultCard = Yii::$app->stripe->getSource($defaultSourceId);
?>
<div class="modal fade" id="ReviewPaymentMethodModal" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Summary of Card Currently in Use</h4>
			</div>
			<div class="modal-body">
        <?php if ($defaultCard){ ?>
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-4">Last 4 digits: <b class="cc_last4"><?= $defaultCard->last4 ?></b></div>
                <div class="col-sm-4">Card type: <b class="cc_brand"><?= $defaultCard->brand ?></b></div>
                <div class="col-sm-4">Expiration: <b class="cc_exp"><?= $defaultCard->exp_month.'/'.$defaultCard->exp_year ?></b></div>
              </div>
            </div>
        <?php } else { ?>
          <div class="alert alert-danger">No default card</div>
        <?php } ?>
			</div>
			<div class="modal-footer">
        <div class="pull-left">
          <a class="btn btn-default emodal-ajax" href="/subscriber-home/account-status?popup=ChangePaymentMethodModal"><i class="glyphicon glyphicon-refresh"></i> Change Card</a>
        </div>
        <div class="pull-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        <div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>