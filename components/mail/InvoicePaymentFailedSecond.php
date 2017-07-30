<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.06.17
 * Time: 12:12
 */

namespace app\components\mail;


class InvoicePaymentFailedSecond extends InvoicePaymentFailed {
	public $defaults = [
		'attempts'  => 0,
		'subject'   => 'Your most recent invoice payment failed',
		'template'  => 'patient/InvoicePaymentFailed',
		'callback'  => 'app\components\mail\callback\InvoicePaymentFailedSecond'
	];

	public function setData($data){
		parent::setData($data);
		$this->data ['weeks'] = 1;
	}
}