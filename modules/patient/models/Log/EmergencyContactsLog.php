<?php

namespace app\modules\patient\models\Log;

use app\modules\patient\models\EmergencyContacts;
use app\modules\patient\models\Log;

/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.03.17
 * Time: 13:23
 */
class EmergencyContactsLog extends LogPrototype {
	public $type = Log::TYPE_EMERGENCY_CONTACTS;
	public $ignoreAttr = ['internal_id', 'practice_id', 'contact_id'];
	public $ignoreEmptyAttr = ['added_by_user', 'contact_phone', 'contact_cell', 'contact_email', 'contact_preferred'];
	/** @var EmergencyContacts */
	public $contact;
	public $actionType = '';
	public $actionData = [];

	protected $aggregate = false;

	public function save() {

		$xml = new \SimpleXMLElement('<Contacts/>');

		$contact = $xml->addChild('Contact');
		$contact->addAttribute('id', $this->contact->contact_id);

		$action = $contact->addChild('Action');
		$action->addAttribute('type', $this->actionType);
		foreach ($this->actionData as $key => $value){
			$action->addAttribute($key, $value);
		}

		foreach ($this->contact->getAttributes() as $key => $value){
			if (!in_array($key, $this->ignoreAttr)) {
				if (in_array($key, $this->ignoreEmptyAttr)){
					if (!$value || empty(trim($value))) continue;
				}
				$contact->addChild($key, $value);
			}
		}

		$dom = dom_import_simplexml($xml)->ownerDocument;
		$dom->formatOutput = true;
		$this->model->log_content = $dom->saveXML();

		return parent::save();
	}

	public static function explodeData($data){
		$res = [];

		foreach ($data as $key => $value){
			$data[$key] = self::prepareData($data, $key);
		}

		foreach ($data['source'] as $source){
			/** @var $source EmergencyContacts */
			/** @var $target EmergencyContacts */
			$target = isset($data['display'][$source->contact_id])?$data['display'][$source->contact_id]:false;
			if (($source->display == 0) && $target){
				$res[] = [
					'contact' => EmergencyContacts::findOne(['contact_id' => $source->contact_id]),
					'actionType' => 'ShowContact'
				];
			}
			if (($source->display == 1) && !$target){
				$res[] = [
					'contact' => EmergencyContacts::findOne(['contact_id' => $source->contact_id]),
					'actionType' => 'HideContact'
				];
			}

			$target = isset($data['notify_cell'][$source->contact_id])?$data['notify_cell'][$source->contact_id]:false;
			if (($source->notify_cell == 0) && $target){
				$res[] = [
					'contact' => EmergencyContacts::findOne(['contact_id' => $source->contact_id]),
					'actionType' => 'NotifyOn',
					'actionData' => [ 'channel' => 'cell' ]
				];
			}
			if (($source->notify_cell == 1) && !$target){
				$res[] = [
					'contact' => EmergencyContacts::findOne(['contact_id' => $source->contact_id]),
					'actionType' => 'NotifyOff',
					'actionData' => [ 'channel' => 'cell' ]
				];
			}

			$target = isset($data['notify_email'][$source->contact_id])?$data['notify_email'][$source->contact_id]:false;
			if (($source->notify_email == 0) && $target){
				$res[] = [
					'contact' => EmergencyContacts::findOne(['contact_id' => $source->contact_id]),
					'actionType' => 'NotifyOn',
					'actionData' => [ 'channel' => 'email' ]
				];
			}
			if (($source->notify_email == 1) && !$target){
				$res[] = [
					'contact' => EmergencyContacts::findOne(['contact_id' => $source->contact_id]),
					'actionType' => 'NotifyOff',
					'actionData' => [ 'channel' => 'email' ]
				];
			}

		}
		return $res;
	}

	public static function prepareData($data, $key){
		$out = [];
		foreach($data[$key] as $one){
			$out[$one->contact_id] = $one;
		}
		return $out;
	}
}