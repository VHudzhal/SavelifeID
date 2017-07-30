<?php

namespace app\modules\api\components;

use app\components\mail\InvoicePaymentFailed;
use app\models\MailQueue;
use app\modules\api\models\LogWebhooks;
use app\modules\patient\models\Patient;
use yii\base\Component;
use yii\base\Exception;
use yii\helpers\Html;
use yii\helpers\VarDumper;

class Webhook extends Component {
	public $event;
	/** @var LogWebhooks */
	public $model;
	private $customer;

	/*
	 * Purpose of the flush, is to send the response code back to Stripe right away
	 * to prevent their request from timing out, and retries being sent.
	 */

	public function init(){
		$this->model = LogWebhooks::findOne(['stripe_event_id' => $this->event->id]);
		if (!$this->model){

			$customer_id = $patients_id = null;
			if (isset($this->event->data) && isset($this->event->data->object) && isset($this->event->data->object->customer)){
				$customer_id = $this->event->data->object->customer;
			}
			if ($customer_id){
				$patient = Patient::findOne(['stripe_customer' => $customer_id]);
				if ($patient) {
					$patients_id = $patient->patients_id;
				}
			}

			$this->model = new LogWebhooks();
			$this->model->stripe_event_id = $this->event->id;
			$this->model->type            = $this->event->type;
			$this->model->event           = json_encode($this->event);
			$this->model->customer_id     = $customer_id;
			$this->model->patients_id     = $patients_id;
		}
	}

	public function account_updated(){}
	public function account_application_deauthorized(){}
	public function account_external_account_created(){}
	public function account_external_account_deleted(){}
	public function account_external_account_updated(){}
	public function application_fee_created(){}
	public function application_fee_refunded(){}
	public function application_fee_refund_updated(){}
	public function balance_available(){}
	public function bitcoin_receiver_created(){}
	public function bitcoin_receiver_filled(){}
	public function bitcoin_receiver_updated(){}
	public function bitcoin_receiver_transaction_created(){}
	public function charge_captured(){}
	public function charge_failed(){}
	public function charge_pending(){}
	public function charge_refunded(){}
	public function charge_succeeded(){}
	public function charge_updated(){}
	public function charge_dispute_closed(){}
	public function charge_dispute_created(){}
	public function charge_dispute_funds_reinstated(){}
	public function charge_dispute_funds_withdrawn(){}
	public function charge_dispute_updated(){}
	public function coupon_created(){}
	public function coupon_deleted(){}
	public function coupon_updated(){}
	public function customer_created(){}
	public function customer_deleted(){}
	public function customer_updated(){}
	public function customer_discount_created(){}
	public function customer_discount_deleted(){}
	public function customer_discount_updated(){}
	public function customer_source_created(){}
	public function customer_source_deleted(){}
	public function customer_source_updated(){}
	public function customer_subscription_created(){}
	public function customer_subscription_deleted(){}
	public function customer_subscription_trial_will_end(){}
	public function customer_subscription_updated(){}
	public function invoice_created(){}
	public function invoice_payment_failed(){
		$patient = Patient::findOne(['stripe_customer' => $this->event->data->object->customer]);
		if ($patient){
			echo("Patient {$this->event->data->object->customer} exist. Processing... \n");
			$mail = new InvoicePaymentFailed();
			$mail->setData($this->event->data->object);
			$mail->patients_id = $patient->patients_id;
			if (!$mail->save()){
				var_dump($mail->attributes);
				echo(' Error occurred: '.strip_tags(Html::errorSummary($mail)));
				// throw new Exception(' Error occurred: '.strip_tags(Html::errorSummary($mail)));
			}
		} else echo("Patient not found: {$this->event->data->object->customer}. ");
	}
	public function invoice_payment_succeeded(){}
	public function invoice_sent(){}
	public function invoice_updated(){}
	public function invoiceitem_created(){}
	public function invoiceitem_deleted(){}
	public function invoiceitem_updated(){}
	public function order_created(){}
	public function order_payment_failed(){}
	public function order_payment_succeeded(){}
	public function order_updated(){}
	public function order_return_created(){}
	public function payout_paid(){}
	public function payout_failed(){}
	public function payout_canceled(){}
	public function payout_created(){}
	public function payout_updated(){}
	public function plan_created(){}
	public function plan_deleted(){}
	public function plan_updated(){}
	public function product_created(){}
	public function product_deleted(){}
	public function product_updated(){}
	public function review_closed(){}
	public function review_opened(){}
	public function sku_created(){}
	public function sku_deleted(){}
	public function sku_updated(){}
	public function source_canceled(){}
	public function source_chargeable(){}
	public function source_failed(){}
	public function source_transaction_created(){}
	public function transfer_created(){}
	public function transfer_deleted(){}
	public function transfer_failed(){}
	public function transfer_paid(){}
	public function transfer_reversed(){}
	public function transfer_updated(){}
	public function ping(){}

	public function isNewEvent(){
		return $this->model->isNewRecord;
	}

	public function log(){
		if (!$this->model->save()) {
			echo Html::errorSummary($this->model);
		}
	}

}