<?php

namespace app\modules\patient\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\patient\models\Practices;

/**
 * PracticesSearch represents the model behind the search form of `app\modules\patient\models\Practices`.
 */
class PracticesSearch extends Practices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['practice_id', 'enrollment_code', 'partner_id', 'demo'], 'integer'],
            [['practice_name', 'practice_umr_id', 'auth_user', 'auth_pass'], 'safe'],
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
        $query = Practices::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'practice_id' => $this->practice_id,
            'enrollment_code' => $this->enrollment_code,
            'partner_id' => $this->partner_id,
            'demo' => $this->demo,
        ]);

        $query->andFilterWhere(['like', 'practice_name', $this->practice_name])
            ->andFilterWhere(['like', 'practice_umr_id', $this->practice_umr_id])
            ->andFilterWhere(['like', 'auth_user', $this->auth_user])
            ->andFilterWhere(['like', 'auth_pass', $this->auth_pass]);

        return $dataProvider;
    }
}
