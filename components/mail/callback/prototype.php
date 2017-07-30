<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.06.17
 * Time: 11:27
 */

namespace app\components\mail\callback;


use app\models\MailQueue;

class prototype {
	public $log = '';

	/** @var MailQueue */
	protected $_model;
	protected $_data;

	public function __construct(MailQueue $model) {
		$this->_model = $model;
		$this->_data = $model->data;
	}

	public function run(){
		ob_start();
		try{
			$this->_run();
		} catch (\Exception $e){
			echo("Error occured: ".$e->getMessage().' in '.$e->getFile()." [".$e->getLine()."]");
		}
		$this->log = ob_get_contents();
		ob_end_clean();
	}

	protected function _run(){}
}