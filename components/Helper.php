<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 15.03.17
 * Time: 14:16
 */

namespace app\components;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Helper {

	public static function array_divide($array, $chunks_count = 2){
		$empty = array_fill(0, $chunks_count, []);
		$chunk_size = ceil(count($array)/$chunks_count);
		if ($chunk_size > 0){
			$result = array_chunk($array, $chunk_size, true);
			$result = array_merge($result, $empty);
		} else {
			$result = $empty;
		}
		return $result;
	}
	
	public static function getStates(){
		return [
			"" => '',
            "AL" => "Alabama",
            "AK" => "Alaska",
            "AZ" => "Arizona",
            "AR" => "Arkansas",
            "CA" => "California",
            "CO" => "Colorado",
            "CT" => "Connecticut",
            "DE" => "Delaware",
            "DC" => "District Of Columbia",
            "FL" => "Florida",
            "GA" => "Georgia",
            "HI" => "Hawaii",
            "ID" => "Idaho",
            "IL" => "Illinois",
            "IN" => "Indiana",
            "IA" => "Iowa",
            "KS" => "Kansas",
            "KY" => "Kentucky",
            "LA" => "Louisiana",
            "ME" => "Maine",
            "MD" => "Maryland",
            "MA" => "Massachusetts",
            "MI" => "Michigan",
            "MN" => "Minnesota",
            "MS" => "Mississippi",
            "MO" => "Missouri",
            "MT" => "Montana",
            "NE" => "Nebraska",
            "NV" => "Nevada",
            "NH" => "New Hampshire",
            "NJ" => "New Jersey",
            "NM" => "New Mexico",
            "NY" => "New York",
            "NC" => "North Carolina",
            "ND" => "North Dakota",
            "OH" => "Ohio",
            "OK" => "Oklahoma",
            "OR" => "Oregon",
            "PA" => "Pennsylvania",
            "RI" => "Rhode Island",
            "SC" => "South Carolina",
            "SD" => "South Dakota",
            "TN" => "Tennessee",
            "TX" => "Texas",
            "UT" => "Utah",
            "VT" => "Vermont",
            "VA" => "Virginia",
            "WA" => "Washington",
            "WV" => "West Virginia",
            "WI" => "Wisconsin",
            "WY" => "Wyoming"
		];
	}

	public static function array_diff_assoc_recursive($array1, $array2) {
		$array1 = ArrayHelper::toArray($array1);
		$array2 = ArrayHelper::toArray($array2);
		$difference=array();
		foreach($array1 as $key => $value) {
			if( is_array($value) ) {
				if( !isset($array2[$key]) || !is_array($array2[$key]) ) {
					$difference[$key] = $value;
				} else {
					$new_diff = self::array_diff_assoc_recursive($value, $array2[$key]);
					if( !empty($new_diff) )
						$difference[$key] = $new_diff;
				}
			} else if( !array_key_exists($key,$array2) || $array2[$key] !== $value ) {
				$difference[$key] = $value;
			}
		}
		return $difference;
	}

	public static function eyeInput($name, $value, $data = []){
		$options = [
			'checked' => 0,
			'titleChecked' => 'Click to prevent this entry from being included in your emergency profile; otherwise, it will appear',
			'titleUnChecked' => 'Click to select this entry to be included in your emergency profile; otherwise, it will not appear.',
			'label' => '',
			'id' => 'eye-'.preg_replace('~[^A-Za-z0-9]~','',$name).'-'.$value.'-'.uniqid(),
			'clearfix' => true,
			'wrapper_class' => 'buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title',
			'eye_class' => ''
		];
		$options = array_merge($options, $data);
		extract($options);
		/**
		 * @var $checked string
		 * @var $titleChecked string
		 * @var $titleUnChecked string
		 * @var $label string
		 * @var $id string
		 * @var $wrapper_class string
		 * @var $eye_class string
		 * @var $clearfix boolean
		 */

        $html = "<span class='{$wrapper_class}' data-title-checked='".Html::encode($titleChecked)."' data-title-unchecked='".Html::encode($titleUnChecked)."'>";
        $html .= \yii\bootstrap\Html::hiddenInput($name, 0);
		$html .= \yii\bootstrap\Html::checkbox($name, $checked, ['value' => $value, 'id'=> $id]);
		$html .= \yii\bootstrap\Html::label('', $id, ['class' => $eye_class]);
		$html .= '</span>';
		$html .= $label     ?   \yii\bootstrap\Html::label($label, $id, ['class' => 'item-name'])   : "";
		$html .= $clearfix  ?   '<div class="clearfix"></div>'                                      : '';
		return $html;
	}

	public static function checkBox($name, $value, $data = []){
		$options = [
			'checked' => 0,
			'label' => '',
			'id' => 'cb-'.preg_replace('~[^A-Za-z0-9]~','',$name).'-'.$value.'-'.uniqid()
		];
		$options = array_merge($options, $data);
		extract($options);
		/**
		 * @var $checked string
		 * @var $label string
		 * @var $id string
		 */
		$html = '';
		$html .= \yii\bootstrap\Html::hiddenInput($name, 0);
		$html .= \yii\bootstrap\Html::checkbox($name, $checked, ['value' => $value, 'id'=> $id]);
		$html .= \yii\bootstrap\Html::label('', $id);
		if ($label){
			$html .= \yii\bootstrap\Html::label($label, $id);
		}

		return $html;
	}

	public static function getS3BucketRoot(){
		return trim(getenv('BUCKET_IMAGE_ROOT'), '/').'/';
	}

	public static function showError($message){
		echo("<div class='alert alert-danger'>{$message}</div>");
	}
}