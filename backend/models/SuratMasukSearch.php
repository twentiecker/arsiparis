<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SuratMasuk;

/**
 * SuratMasukSearch represents the model behind the search form of `backend\models\SuratMasuk`.
 */
class SuratMasukSearch extends SuratMasuk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['no', 'date', 'sbj', 'origin', 'pj', 'file'], 'safe'],
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
            $query = SuratMasuk::find()
            ->where(['pj' => Yii::$app->user->identity->name]);
        } else {
            $query = SuratMasuk::find();    
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

        $query->andFilterWhere(['like', 'no', $this->no])
        ->andFilterWhere(['like', 'date', $this->date])
        ->andFilterWhere(['like', 'sbj', $this->sbj])
        ->andFilterWhere(['like', 'origin', $this->origin])
        ->andFilterWhere(['like', 'pj', $this->pj])
        ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
