<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.06.17
 * Time: 13:48
 */

namespace app\components\mail\callback;


class InvoicePaymentFailed extends prototype {

	protected function _run(){
		$date = date(DATE_W3C, time() + 7*24*60*60);
		echo("Schedule send next mail at {$date}.");
		$mail = new \app\components\mail\InvoicePaymentFailedSecond();
		$mail->data = $this->_model->data;
		$mail->patients_id = $this->_model->patients_id;
		$mail->send_time = $date;
		$mail->save();
	}
}