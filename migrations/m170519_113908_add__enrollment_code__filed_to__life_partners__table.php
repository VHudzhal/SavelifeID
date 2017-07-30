<?php

use yii\db\Migration;

class m170519_113908_add__enrollment_code__filed_to__life_partners__table extends Migration
{
    public function safeUp()
    {
	    $this->execute("
ALTER TABLE `life_partners`
ADD COLUMN `enrollment_code`  int(6) NOT NULL DEFAULT 0 AFTER `auth_pass`;
");
	    $partners = \app\modules\patient\models\Partners::find()->all();
	    foreach ($partners as $partner){
	    	/** @var $partner \app\modules\patient\models\Partners */
	    	$this->generateCode($partner);
	    	$partner->save();
	    }
	    $this->execute("
ALTER TABLE `life_partners`
ADD UNIQUE INDEX (`enrollment_code`) ;
");
    }

    public function safeDown()
    {
    	$this->execute("
ALTER TABLE `life_partners`
DROP COLUMN `enrollment_code`;
");
    }

    public function generateCode(&$partner){
	    $partner->enrollment_code = rand(0, 999999);
	    if (\app\modules\patient\models\Partners::findOne(['enrollment_code' => $partner->enrollment_code])){
	    	$this->generateCode($partner);
	    }
    }
}

