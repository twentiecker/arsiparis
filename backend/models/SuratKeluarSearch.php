<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SuratKeluar;

/**
 * SuratKeluarSearch represents the model behind the search form of `backend\models\SuratKeluar`.
 */
class SuratKeluarSearch extends SuratKeluar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'no'], 'integer'],
            [['date', 'sbj', 'obj', 'pj', 'file'], 'safe'],
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
            $query = SuratKeluar::find()
            ->where(['pj' => Yii::$app->user->identity->name]);
        } else {
            $query = SuratKeluar::find();
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
            'no' => $this->no,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
        ->andFilterWhere(['like', 'sbj', $this->sbj])
        ->andFilterWhere(['like', 'obj', $this->obj])
        ->andFilterWhere(['like', 'pj', $this->pj])
        ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
