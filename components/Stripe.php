<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 13.06.17
 * Time: 15:28
 */

namespace app\components;


use app\modules\api\components\Webhook;
use Stripe\Collection;
use Stripe\Event;
use Stripe\Subscription;
use yii\base\Component;
use yii\helpers\VarDumper;

class Stripe extends Component {
	const TYPE_DAY = 'day';
	const TYPE_MONTHLY = 'month';
	const TYPE_YEARLY  = 'year';

	public $types = [
		self::TYPE_MONTHLY => 'monthly',
		self::TYPE_YEARLY => 'yearly',
		self::TYPE_DAY => 'daily',
	];
	public $eventArray = array(
		'account.updated',
		'account.application.deauthorized',
		'account.external_account.created',
		'account.external_account.deleted',
		'account.external_account.updated',
		'application_fee.created',
		'application_fee.refunded',
		'application_fee.refund.updated',
		'balance.available',
		'bitcoin.receiver.created',
		'bitcoin.receiver.filled',
		'bitcoin.receiver.updated',
		'bitcoin.receiver.transaction.created',
		'charge.captured',
		'charge.failed',
		'charge.pending',
		'charge.refunded',
		'charge.succeeded',
		'charge.updated',
		'charge.dispute.closed',
		'charge.dispute.created',
		'charge.dispute.funds_reinstated',
		'charge.dispute.funds_withdrawn',
		'charge.dispute.updated',
		'coupon.created',
		'coupon.deleted',
		'coupon.updated',
		'customer.created',
		'customer.deleted',
		'customer.updated',
		'customer.discount.created',
		'customer.discount.deleted',
		'customer.discount.updated',
		'customer.source.created',
		'customer.source.deleted',
		'customer.source.updated',
		'customer.subscription.created',
		'customer.subscription.deleted',
		'customer.subscription.updated',
		'customer.subscription.trial_will_end',
		'invoice.created',
		'invoice.payment_failed',
		'invoice.payment_succeeded',
		'invoice.sent',
		'invoice.updated',
		'invoiceitem.created',
		'invoiceitem.deleted',
		'invoiceitem.updated',
		'order.created',
		'order.payment_failed',
		'order.payment_succeeded',
		'order.updated',
		'order_return.created',
		'payout.canceled',
		'payout.created',
		'payout.updated',
		'payout.paid',
		'payout.failed',
		'plan.created',
		'plan.deleted',
		'plan.updated',
		'product.created',
		'product.deleted',
		'product.updated',
		'review.closed',
		'review.opened',
		'sku.created',
		'sku.deleted',
		'sku.updated',
		'source.canceled',
		'source.chargeable',
		'source.failed',
		'source.transaction.created',
		'transfer.created',
		'transfer.failed',
		'transfer.paid',
		'transfer.reversed',
		'transfer.updated',
		'ping'
	);

	private $errors = [];
	private $_key = null;

	/** @var null|\Stripe\Customer */
	private $_customer = null;
	/** @var null|\Stripe\Subscription */
	private $_subscribtion = null;
	/** @var \Stripe\Card[] */
	private $_sources = null;
	/** @var \Stripe\Charge[] */
	private $_previous_payments = [];

	public function getNextPaymentDate($force = false){
		$subscribtion = $this->getSubscribe($force);
		$ts = ($subscribtion&&$subscribtion->current_period_end)?$subscribtion->current_period_end+1:null;
		return $ts;
	}

	public function getSubscribeAmount($force = false){
		$subscribtion = $this->getSubscribe($force);
		$amount = ($subscribtion && $subscribtion->plan && $subscribtion->plan->amount)?$subscribtion->plan->amount:null;
		return $amount;
	}

	public function getSubscribeType($force = false){
		$subscribtion = $this->getSubscribe($force);
		$type = ($subscribtion && $subscribtion->plan && $subscribtion->plan->interval)?$subscribtion->plan->interval:null;

		return isset($this->types[$type])?$type:null;
	}

	public function getSubscribeTypeName($force = false){
		$type = $this->getSubscribeType($force);
		if ($type) return $this->types[$type];
		return null;
	}

	public function cancelSubscription(Subscription $subscription){
		$key  = $this->getKey();
		if ( $key ) {
			try {
				\Stripe\Stripe::setApiKey( $key );
				$subscription->cancel();
				return true;
			} catch ( \Exception $e ) {
				$this->addError( $e->getMessage() );
			}
		} else { $this->addError( "Getting API key failed." ); }
		return false;
	}

	public function createCoupon(){
		$key  = $this->getKey();
		if ( $key ) {
			try {
				\Stripe\Stripe::setApiKey( $key );

				$date_utc = new \DateTime(null, new \DateTimeZone("UTC"));

				$coupon = \Stripe\Coupon::create(array(
					"percent_off" => 100,
					"duration" => "forever",
					"max_redemptions" => $date_utc->getTimestamp() + 1 * 60 * 60 ));
				return $coupon;
			} catch ( \Exception $e ) {
				$this->addError( $e->getMessage() );
			}
		} else { $this->addError( "Getting API key failed." ); }
		return false;
	}

	public function processEvent($verification = true){
		$key  = $this->getKey();
		if ( $key ) {
			try {
				\Stripe\Stripe::setApiKey( $key );

				$body = @file_get_contents('php://input');
				$event = json_decode($body);

				if ($verification){
					$signature = $_SERVER['HTTP_STRIPE_SIGNATURE'];
					try{
						$event = \Stripe\Webhook::constructEvent($body,$signature, getenv('STRIPE_VERIFICATION_CODE'));
					} catch(\UnexpectedValueException $e) {
						$this->addError('Unexpected Value');
					} catch(\Stripe\Error\SignatureVerification $e) {
						$this->addError('No signatures found matching the expected signature for payload');
					} catch (\Exception $e){
						$this->addError($e->getMessage());
					}
				}
				if (!$this->isError()) {
					$this->handleEvent($event);
				}
			} catch ( \Exception $e ) {
				$this->addError( $e->getMessage() );
			}
		} else { $this->addError( "Getting API key failed." ); }
	}

	/**
	 * @return \Stripe\Plan[]
	 */
	public function getPlans(){
		$data = [];
		$key = $this->getKey();
		if ($key) {
			try {
				\Stripe\Stripe::setApiKey($key);
				$plans = \Stripe\Plan::all(array("limit" => 10));
				/** @var $plans Collection */


				foreach($plans->data as $one){
					if (!$one->metadata || ($one->metadata && (!$one->metadata->hidden))){
						$data[$one->interval] = $one;
					}
				}
			} catch (\Exception $e){
				$this->addError($e->getMessage());
			}
		}

		usort($data, function($a, $b){
			if ($a->amount == $b->amount) {
				return 0;
			}
			return ($a->amount > $b->amount) ? -1 : 1;
		});

		return $data;
	}
	public function getSubscribe($force = false){
		if ($this->_subscribtion && !$force){
			return $this->_subscribtion;
		} else {
			$data = \Yii::$app->stripe->retriveCustomerData();
			if ($data){
				$subscribtions = $data->subscriptions->data;
				if (is_array($subscribtions) && $subscribtions){
					$subscribtion = array_pop($subscribtions);
					$this->_subscribtion = $subscribtion;
					return $subscribtion;
				} else $this->addError("No current subscribtions present");
			} else $this->addError("No customer found");
		}
		return null;
	}
	public function getSource($sid){
		$cards = $this->getSources();
		foreach ($cards as $card){
			if ($card->id == $sid) return $card;
		}
		return null;
	}
	public function getSources($force = false){
		if ($this->_sources && !$force){
			return $this->_sources;
		} else {
			$data = \Yii::$app->stripe->retriveCustomerData();
			if ($data){
				$sources = $data->sources->data;
				if (is_array($sources) && $sources){
					$this->_sources= $sources;
					return $sources;
				} else $this->addError("No current cards present");
			} else $this->addError("No customer found");
		}
		return [];
	}
	public function getPayment($pid){
		$this->_previous_payments = [];
		$key  = $this->getKey();
		if ( $key ) {
			try {
				\Stripe\Stripe::setApiKey( $key );
				return \Stripe\Charge::retrieve($pid);
			} catch ( \Exception $e ) {
				$this->addError( $e->getMessage() );
			}
		}
		return null;
	}
	public function getPreviousPayments($force = false){
		if ($this->_previous_payments && !$force){
			return $this->_previous_payments;
		} else {
			$this->_previous_payments = [];
			$key  = $this->getKey();
			if ( $key ) {
				try {
					\Stripe\Stripe::setApiKey( $key );
					$this->_previous_payments = \Stripe\Charge::all( ['customer' => \Yii::$app->patient->model->stripe_customer] )->data;
				} catch ( \Exception $e ) {
					$this->addError( $e->getMessage() );
				}
			}
		}
		return $this->_previous_payments;
	}
	public function createInvoice(){
		$invoice = false;
		$key  = $this->getKey();
		if ( $key ) {
			try {
				$customer = $this->retriveCustomerData();
				$subscription = $this->getSubscribe();
				\Stripe\Stripe::setApiKey( $key );
				$invoice = \Stripe\Invoice::create(array(
					"customer" => $customer->id,
					'subscription' => $subscription->id
				));

			} catch ( \Exception $e ) {
				$this->addError( $e->getMessage() );
			}
		}
		return $invoice;
	}
	/**
	 * @return null|\Stripe\Customer
	 */
	public function retriveCustomerData($force = false){
		if ($this->_customer && !$force){
			return $this->_customer;
		} else {
			$this->_customer = null;
			$key  = $this->getKey();
			if ( $key ) {
				try {
					\Stripe\Stripe::setApiKey( $key );
					$this->_customer = \Stripe\Customer::retrieve( \Yii::$app->patient->model->stripe_customer );
				} catch ( \Exception $e ) {
					$this->addError( $e->getMessage() );
				}
			}
			return $this->_customer;
		}
	}
	public function getKey(){
		if ($this->_key) return $this->_key;
		try{
			$key = \Yii::$app->awsParams->getParam(getenv("STRIPE_KEY_NAME"));
			$this->_key = $key;
		} catch (\Exception $e){
			$this->addError($e->getMessage());
		}
		return $this->_key;
	}
	public function isError(){
		return (bool)$this->errors;
	}
	public function getErrors(){
		return $this->errors;
	}
	public function addError($message){
		$this->errors[] = $message;
	}

	private function handleEvent($event){
		// , $this->eventArray
		$event_type = $event->type;
		/*
		 * replace '.' in the event type with _ to suit function naming conventions.
		 */
		if(in_array($event_type, $this->eventArray)) {
			$event_type = str_replace('.', '_', $event_type);
			$webhook = new Webhook(['event' => $event]);
			if($webhook->isNewEvent()){
				$webhook->log();
				$webhook->{$event_type}();
			} else {
				echo('This event is already processed - skip. ');
			}
		}
	}
}