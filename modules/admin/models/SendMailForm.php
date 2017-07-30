<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;

class SendMailForm extends Model
{
	public $id = 'send-mail-form';

    public $email;
    public $from;
    public $subject = 'Test Email from SaveLifeID Support';
    public $body;

	public $sended = false;

	public function init(){
		parent::init();
		$this->from = getenv('ROBOT_EMAIL');
		$host = Url::to('/', true);
		$this->body = "Test message sent from <a href='{$host}'>{$host}</a> server";
	}
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
	        [ ['from', 'email', 'subject', 'body'], 'required'],
	        /* Поле электронной почты */
	        [['email', 'from'], 'email'],
        ];
    }

	/**
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'email'    => 'Address',
			'from'     => 'From',
			'subject'  => 'Subject',
			'body'     => 'Text',
		];
	}

	public function send()
	{
		/* Проверяем форму на валидацию */
		if ($this->validate()) {
			try {
				Yii::$app->mailer->compose()
				                 ->setFrom( [ $this->from => $this->from ] )
				                 ->setTo( $this->email )
				                 ->setSubject( $this->subject )
				                 ->setHtmlBody( $this->body )
				                 ->send();
				$this->sended = true;
			} catch (\Exception $e){
				$this->addError('overall', $e->getMessage());
				return false;
			}
			return true;
		} else {
			$this->sended = false;
			return false;
		}
	}
}
