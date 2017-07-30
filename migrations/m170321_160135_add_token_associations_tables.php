<?php

use yii\db\Migration;

class m170321_160135_add_token_associations_tables extends Migration
{
    public function up()
    {
	    $this->execute("
CREATE TABLE IF NOT EXISTS `life_token_types` (
  `token_type` tinyint(4) NOT NULL COMMENT 'lookup index',
  `text` varchar(25) NOT NULL COMMENT 'text to use when referring to tokens of this type',
  `includes_printed_slid` tinyint(4) NOT NULL COMMENT 'is slid printed on it? (Useful question for registration, whether the ID is available for validation)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lookup table with the different token types available in the system';");    

	    $this->execute("
CREATE TABLE IF NOT EXISTS `life_token_activity` (
  `activity_id` int(11) NOT NULL COMMENT 'key',
  `token_id` varchar(255) NOT NULL COMMENT 'token being acted on',
  `patient_id` int(11) NOT NULL COMMENT 'owner of token',
  `action` tinyint(4) NOT NULL COMMENT 'lookup in life_token_action_lookup to learn what was done',
  `activity_date` datetime NOT NULL COMMENT 'when it happened'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Logs activities associated with a given token.  Owner (patient_id) may change over time, if the token changes hands.';");    

	    $this->execute("
CREATE TABLE IF NOT EXISTS `life_token_action_lookup` (
  `action_id` int(11) NOT NULL COMMENT 'key',
  `action_description` varchar(50) NOT NULL COMMENT 'which action has this id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lookup for actions in life_token_activity';");    

	    $this->execute("
CREATE TABLE IF NOT EXISTS `life_token_associations` (
  `association_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'key',
  `token_id` varchar(255) NOT NULL COMMENT 'internal_id_hash of the token being attached to a patient',
  `token_slid` varchar(50) NOT NULL COMMENT 'slid of the token -- token_id = hash(token_slid)',
  `patient_id` int(11) DEFAULT NULL COMMENT 'patient_id of the patient the token is being attached to, null means token not attached to a patient yet',
  `patient_internal_id` varchar(50) DEFAULT NULL COMMENT 'internal_id of the patient, NULL means device allocated but not attached yet',
  `enrollment` tinyint(4) NOT NULL COMMENT 'if this token is the first for the patient -- the enrollment token, special. Means the slid# of this token is internal_id in patients, and token_id is the internal_id_hash',
  `active` tinyint(4) NOT NULL COMMENT 'set to zero if the token cannot be used to return medical data (inactive)',
  `token_type` tinyint(4) DEFAULT NULL COMMENT 'lookup into the token_types table (where text is found). NULL means Unknown',
  `description` varchar(255) NOT NULL COMMENT 'user-supplied description of the token (replacement purple bracelet)',
  PRIMARY KEY (association_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");    

	    $this->execute("
INSERT INTO `life_token_types` (`token_type`, `text`, `includes_printed_slid`) VALUES
(1, 'card', 1),
(2, 'bracelet', 0);");    

	    $this->execute("
INSERT INTO `life_token_action_lookup` (`action_id`, `action_description`) VALUES
(1, 'Token Enrolled'),
(2, 'Token Attached'),
(3, 'Token Activated'),
(4, 'Token Deactivated'),
(5, 'Token Detached'),
(6, 'Token Scanned');");    

	    $this->execute("
INSERT INTO `life_token_associations` (token_id, token_slid, patient_internal_id, patient_id, enrollment, active, token_type, description)
 SELECT internal_id_hash as token_id, internal_id as token_slid, internal_id as patient_internal_id, patients_id as patient_id, 1 as enrollment, 1 as active, 1 as token_type, \"first card\" as description from life_patients
 WHERE length(internal_id_hash)>0 and length(internal_id) > 0;");
}

    public function down()
    {
	    $this->execute("DROP TABLE life_token_types");    
	    $this->execute("DROP TABLE life_token_activity");    
	    $this->execute("DROP TABLE life_token_action_lookup");    
	    $this->execute("DROP TABLE life_token_associations");    
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
