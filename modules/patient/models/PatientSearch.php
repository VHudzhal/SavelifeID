<?php

namespace app\modules\patient\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\patient\models\Patient;

/**
 * PatientSearch represents the model behind the search form of `app\modules\patient\models\Patient`.
 */
class PatientSearch extends Patient
{
	public $onlyBy = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patients_id', 'site_user_id', 'self_registered', 'is_admin', 'height', 'weight', 'partner_id', 'practice_id', 'alerts_allowed', 'notification_updates', 'notification_scanned', 'notification_by_email', 'notification_by_cell', 'clinical_transaction_received', 'answer_allergies', 'answer_conditions', 'answer_medications', 'answer_procedures', 'answer_vaccinations', 'answer_hospital', 'answer_physician', 'answer_emergency_contacts', 'answer_insurance', 'answer_advance_directives', 'answer_ekg', 'answer_other_documents', 'answer_device', 'answer_comments', 'answer_summary', 'display_address', 'display_allergies', 'display_conditions', 'display_medications', 'display_medical_history', 'display_procedures', 'display_vaccinations', 'display_hospital', 'display_physician', 'display_emergency_contacts', 'display_insurance', 'display_advance_directives', 'display_ekg', 'display_other_documents', 'display_device', 'display_comments', 'display_by_default', 'display_emr_emergency_summary', 'answer_emergency_summary', 'answer_emergency_summary_practice', 'display_emergency_summary'], 'integer'],
            [['internal_id', 'umr_session_id', 'salt', 'password', 'internal_id_hash', 'status', 'email', 'first_name', 'last_name', 'middle_initial', 'comm_life_token', 'cell_phone', 'gender', 'date_of_birth', 'picture', 'billing_name', 'address_1', 'address_2', 'city', 'state', 'zip', 'height_units', 'weight_units', 'date_created', 'last_updated', 'device_dependencies', 'comments', 'token', 'expiration_date', 'stripe_customer', 'stripe_subscription_id', 'stripe_subscription_type', 'emr_emergency_summary', 'completed_registration_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Patient::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!$this->onlyBy) {
	        // grid filtering conditions
	        $query->andFilterWhere([
		        'patients_id' => $this->patients_id,
		        'site_user_id' => $this->site_user_id,
		        'self_registered' => $this->self_registered,
		        'is_admin' => $this->is_admin,
		        'date_of_birth' => $this->date_of_birth,
		        'height' => $this->height,
		        'weight' => $this->weight,
		        'date_created' => $this->date_created,
		        'last_updated' => $this->last_updated,
		        'partner_id' => $this->partner_id,
		        'practice_id' => $this->practice_id,
		        'alerts_allowed' => $this->alerts_allowed,
		        'notification_updates' => $this->notification_updates,
		        'notification_scanned' => $this->notification_scanned,
		        'notification_by_email' => $this->notification_by_email,
		        'notification_by_cell' => $this->notification_by_cell,
		        'clinical_transaction_received' => $this->clinical_transaction_received,
		        'expiration_date' => $this->expiration_date,
		        'answer_allergies' => $this->answer_allergies,
		        'answer_conditions' => $this->answer_conditions,
		        'answer_medications' => $this->answer_medications,
		        'answer_procedures' => $this->answer_procedures,
		        'answer_vaccinations' => $this->answer_vaccinations,
		        'answer_hospital' => $this->answer_hospital,
		        'answer_physician' => $this->answer_physician,
		        'answer_emergency_contacts' => $this->answer_emergency_contacts,
		        'answer_insurance' => $this->answer_insurance,
		        'answer_advance_directives' => $this->answer_advance_directives,
		        'answer_ekg' => $this->answer_ekg,
		        'answer_other_documents' => $this->answer_other_documents,
		        'answer_device' => $this->answer_device,
		        'answer_comments' => $this->answer_comments,
		        'answer_summary' => $this->answer_summary,
		        'display_address' => $this->display_address,
		        'display_allergies' => $this->display_allergies,
		        'display_conditions' => $this->display_conditions,
		        'display_medications' => $this->display_medications,
		        'display_medical_history' => $this->display_medical_history,
		        'display_procedures' => $this->display_procedures,
		        'display_vaccinations' => $this->display_vaccinations,
		        'display_hospital' => $this->display_hospital,
		        'display_physician' => $this->display_physician,
		        'display_emergency_contacts' => $this->display_emergency_contacts,
		        'display_insurance' => $this->display_insurance,
		        'display_advance_directives' => $this->display_advance_directives,
		        'display_ekg' => $this->display_ekg,
		        'display_other_documents' => $this->display_other_documents,
		        'display_device' => $this->display_device,
		        'display_comments' => $this->display_comments,
		        'display_by_default' => $this->display_by_default,
		        'display_emr_emergency_summary' => $this->display_emr_emergency_summary,
		        'answer_emergency_summary' => $this->answer_emergency_summary,
		        'answer_emergency_summary_practice' => $this->answer_emergency_summary_practice,
		        'display_emergency_summary' => $this->display_emergency_summary,
		        'completed_registration_date' => $this->completed_registration_date,
	        ]);

	        $query->andFilterWhere(['like', 'internal_id', $this->internal_id])
	              ->andFilterWhere(['like', 'umr_session_id', $this->umr_session_id])
	              ->andFilterWhere(['like', 'salt', $this->salt])
	              ->andFilterWhere(['like', 'password', $this->password])
	              ->andFilterWhere(['like', 'status', $this->status])
	              ->andFilterWhere(['like', 'email', $this->email])
	              ->andFilterWhere(['like', 'first_name', $this->first_name])
	              ->andFilterWhere(['like', 'last_name', $this->last_name])
	              ->andFilterWhere(['like', 'middle_initial', $this->middle_initial])
	              ->andFilterWhere(['like', 'comm_life_token', $this->comm_life_token])
	              ->andFilterWhere(['like', 'cell_phone', $this->cell_phone])
	              ->andFilterWhere(['like', 'gender', $this->gender])
	              ->andFilterWhere(['like', 'picture', $this->picture])
	              ->andFilterWhere(['like', 'billing_name', $this->billing_name])
	              ->andFilterWhere(['like', 'address_1', $this->address_1])
	              ->andFilterWhere(['like', 'address_2', $this->address_2])
	              ->andFilterWhere(['like', 'city', $this->city])
	              ->andFilterWhere(['like', 'state', $this->state])
	              ->andFilterWhere(['like', 'zip', $this->zip])
	              ->andFilterWhere(['like', 'height_units', $this->height_units])
	              ->andFilterWhere(['like', 'weight_units', $this->weight_units])
	              ->andFilterWhere(['like', 'device_dependencies', $this->device_dependencies])
	              ->andFilterWhere(['like', 'comments', $this->comments])
	              ->andFilterWhere(['like', 'token', $this->token])
	              ->andFilterWhere(['like', 'stripe_customer', $this->stripe_customer])
	              ->andFilterWhere(['like', 'stripe_subscription_id', $this->stripe_subscription_id])
	              ->andFilterWhere(['like', 'stripe_subscription_type', $this->stripe_subscription_type])
	              ->andFilterWhere(['like', 'emr_emergency_summary', $this->emr_emergency_summary]);

	        if ($this->internal_id_hash){
		        $query->leftJoin("life_token_associations lka", "lka.patient_id = life_patients.patients_id");
		        $query->andFilterWhere(['lka.token_id' => $this->internal_id_hash]);
	        }
        } else {
        	if ($this->onlyBy == 'internal_id') { $query->andFilterWhere(['like', 'internal_id', $this->internal_id]); }
        	if ($this->onlyBy == 'email') { $query->andFilterWhere(['like', 'email', $this->email]); }
        	if ($this->onlyBy == 'cell_phone') { $query->andFilterWhere(['like', 'email', $this->cell_phone]); }
        	if ($this->onlyBy == 'stripe_customer') { $query->andFilterWhere(['like', 'stripe_customer', $this->stripe_customer]); }
        	if ($this->onlyBy == 'stripe_subscription_type') { $query->andFilterWhere(['like', 'stripe_subscription_type', $this->stripe_subscription_type]); }
        	if ($this->onlyBy == 'internal_id_hash') {
		        if ($this->internal_id_hash){
			        $query->leftJoin("life_token_associations lka", "lka.patient_id = life_patients.patients_id");
			        $query->andFilterWhere(['lka.token_id' => $this->internal_id_hash]);
		        }
        	}
        }


        return $dataProvider;
    }
}
