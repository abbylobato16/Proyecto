<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sitios;

/**
 * SitiosSearch represents the model behind the search form of `backend\models\Sitios`.
 */
class SitiosSearch extends Sitios
{


    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSitio'], 'integer'],
            [['nombreSitio', 'url', 'username', 'passwords', 'email','globalSearch'], 'safe'],
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
        $query = Sitios::find()->where(['estatusSitios' =>'Active']);

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
        $query->orFilterWhere([
            'idSitio' => $this->idSitio,
        ]);



         $query->andFilterWhere(['like', 'nombreSitio', $this->nombreSitio])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'passwords', $this->passwords])
            ->andFilterWhere(['like', 'email', $this->email]);
/* globalsearch
        $query->andFilterWhere(['like', 'nombreSitio', $this->globalSearch])
            ->orFilterWhere(['like', 'url', $this->globalSearch])
            ->orFilterWhere(['like', 'username', $this->globalSearch])
            ->orFilterWhere(['like', 'passwords', $this->globalSearch])
            ->orFilterWhere(['like', 'email', $this->globalSearch]);
*/
        return $dataProvider;
    }


    public function searcheliminados($params)
    {
        $query = Sitios::find()->where(['estatusSitios' =>'Inactive']);

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
            'idSitio' => $this->idSitio,
        ]);

        $query->andFilterWhere(['like', 'nombreSitio', $this->nombreSitio])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'passwords', $this->passwords])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
