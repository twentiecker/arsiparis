<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Lembur;

/**
 * LemburSearch represents the model behind the search form of `backend\models\Lembur`.
 */
class LemburSearch extends Lembur
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'employee_id', 'date', 'task'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        if (Yii::$app->user->identity->username != 'superadmin') {
            $query = Lembur::find()
            ->where(['employee_id' => Yii::$app->user->identity->employee_id]);
        } else {
            $query = Lembur::find();
        }

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'employee_id', $this->employee_id])
        ->andFilterWhere(['like', 'date', $this->date])
        ->andFilterWhere(['like', 'task', $this->task]);

        return $dataProvider;
    }
}
