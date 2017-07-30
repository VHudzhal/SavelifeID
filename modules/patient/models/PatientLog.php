<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_patients".
 *
 * @property int $patients_id
 * @property string $internal_id
 * @property int $site_user_id
 * @property int $self_registered
 * @property string $umr_session_id
 * @property string $salt
 * @property string $password
 * @property string $internal_id_hash
 * @property string $status
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_initial
 * @property string $comm_life_token
 * @property string $cell_phone
 * @property string $gender
 * @property string $date_of_birth
 * @property string $picture
 * @property string $billing_name
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $height
 * @property string $height_units
 * @property string $weight
 * @property string $weight_units
 * @property string $date_created
 * @property string $last_updated
 * @property int $partner_id
 * @property int $practice_id
 * @property int $alerts_allowed
 * @property int $notification_updates
 * @property int $notification_scanned
 * @property int $notification_by_email
 * @property int $notification_by_cell
 * @property string $device_dependencies
 * @property string $comments
 * @property string $token
 * @property int $clinical_transaction_received
 * @property string $expiration_date
 * @property string $stripe_customer
 * @property string $stripe_subscription_id
 * @property string $stripe_subscription_type
 * @property int $answer_allergies
 * @property int $answer_conditions
 * @property int $answer_medications
 * @property int $answer_procedures
 * @property int $answer_vaccinations
 * @property int $answer_hospital
 * @property int $answer_physician
 * @property int $answer_emergency_contacts
 * @property int $answer_insurance
 * @property int $answer_advance_directives
 * @property int $answer_ekg
 * @property int $answer_other_documents
 * @property int $answer_device
 * @property int $answer_comments
 * @property int $answer_summary
 * @property int $display_address
 * @property int $display_allergies
 * @property int $display_conditions
 * @property int $display_medications
 * @property int $display_procedures
 * @property int $display_vaccinations
 * @property int $display_hospital
 * @property int $display_physician
 * @property int $display_emergency_contacts
 * @property int $display_insurance
 * @property int $display_advance_directives
 * @property int $display_ekg
 * @property int $display_other_documents
 * @property int $display_medical_history
 * @property int $display_device
 * @property int $display_comments
 * @property int $display_by_default
 * @property string $emr_emergency_summary
 * @property int $display_emr_emergency_summary
 * @property int $answer_emergency_summary
 * @property int $answer_emergency_summary_practice
 * @property int $display_emergency_summary
 * @property string $completed_registration_date
 */
class PatientLog extends Patient
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_patients_log';
    }
}
