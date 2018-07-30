<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Proveedores;

/**
 * ProveedoresSearch represents the model behind the search form of `backend\models\Proveedores`.
 */
class ProveedoresSearch extends Proveedores
{
    /**
     * {@inheritdoc}
     */

    public $globalSearch;
    public function rules()
    {
        return [
            [['idproveedor'], 'integer'],
            [['nomproveedor', 'razonsocial','globalSearch','estatusproveedor'], 'safe'],

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


       $query = Proveedores::find()->where(['estatusproveedor' =>'Active']);

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
            'idproveedor' => $this->idproveedor,
          //  'estatusproveedor' => 1,
        ]);




        $query->andFilterWhere(['like', 'nomproveedor', $this->nomproveedor])
       // ->andFilterWhere(['estatusproveedor' => 'Active'])
            ->andFilterWhere(['like', 'razonsocial', $this->razonsocial]);

        return $dataProvider;
    }



        public function searcheliminados($params)
    {


       $query = Proveedores::find()->where(['estatusproveedor' =>'Inactive']);

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
    /*    $query->orFilterWhere([
           // 'idproveedor' => $this->idproveedor,
            'estatusproveedor' => 1,
        ]);

*/


        $query->andFilterWhere(['like', 'nomproveedor', $this->globalSearch])
        ->andFilterWhere([
           // 'idproveedor' => $this->idproveedor,
            'estatusproveedor' => 'Inactive',
        ])
            ->orFilterWhere(['like', 'razonsocial', $this->globalSearch]);

        return $dataProvider;
    }
}
