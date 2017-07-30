<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.06.17
 * Time: 12:12
 */

namespace app\components\mail;


class InvoicePaymentFailedLast extends prototype {
	public $defaults = [
		'attempts'  => 0,
		'subject'   => 'Your account has been deactivated until you fix payment issues',
		'template'  => 'patient/InvoicePaymentFailedLast',
		'callback'  => 'app\components\mail\callback\InvoicePaymentFailedLast'
	];

	public function setData($data){
		$data = $this->asFlatArray($data);
		$this->data = $data;
	}
}