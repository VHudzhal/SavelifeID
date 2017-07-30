<?php
  /**
   * @var $this \yii\web\View
   * @var $nextPaymentDate integer
   * @var $subscribeType string
   */
?>
<div class="modal fade" id="ReviewPaymentMethodModal" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Payment details</h4>
			</div>
			<div class="modal-body">
        <div class="container-fluid">
          <h2>Summary of payment</h2>
          <table class="table table-bordered table-responsive table-hover table-striped">
          <?= ConditionalPrint('Description', $payment->description) ?>
            <?= ConditionalPrint('Dispute', $payment->dispute) ?>
            <?= ConditionalPrint('Amount refunded', $payment->refunded ) ?>
            <?= ConditionalPrint('Failure', $payment->failure_code.' '.$payment->failure_message, $payment->failure_code) ?>
            <?= ConditionalPrint('Fraud details', $payment->fraud_details) ?>
            <?= ConditionalPrint('Seller message', $payment->outcome->seller_message) ?>
            <?= ConditionalPrint('Network status', $payment->outcome->network_status) ?>
            <?= ConditionalPrint('Risk level', $payment->outcome->risk_level) ?>
          </table>
          <h2>Summary of Card Used</h2>
          <table class="table table-bordered table-responsive table-hover table-striped">
            <?= ConditionalPrint('Card Brand', $payment->source->brand) ?>
            <?= ConditionalPrint('CVC check', $payment->source->cvc_check) ?>
            <?= ConditionalPrint('Expiration', $payment->source->exp_month .'/'. $payment->source->exp_year) ?>
            <?= ConditionalPrint('Last 4 digits', $payment->source->last4) ?>
          </table>
        </div>
			</div>
			<div class="modal-footer">
        <div class="pull-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        <div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<?php

  function ConditionalPrint($name, $value, $condition = false){
	  $condition = ($condition !== false)?$condition:$value;
    if ($condition) {
      return "
<tr>
  <td width='50%'>{$name}</td>
  <td>$value</td>
</tr>
      ";
    }
    return '';
  }

?>