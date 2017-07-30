<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.06.17
 * Time: 12:12
 */

namespace app\components\mail;


class InvoicePaymentFailed extends prototype {
	public $defaults = [
		'attempts'  => 0,
		'subject'   => 'Your most recent invoice payment failed',
        'template'  => 'patient/InvoicePaymentFailed',
        'callback'  => 'app\components\mail\callback\InvoicePaymentFailed'
	];

	public function setData($data){
		$data = $this->asFlatArray($data);
		$data['weeks'] = 2;
		$this->data = $data;
	}
}