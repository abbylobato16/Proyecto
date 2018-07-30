<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Producto;

/**
 * ProductoSearch represents the model behind the search form of `backend\models\Producto`.
 */
class ProductoSearch extends Producto
{

        public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProducto'], 'integer'],
            [['nombresw', 'descripcion', 'version', 'estatusProducto','clave','globalSearch'], 'safe'],
            
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
        $query = Producto::find()->where(['estatusProducto' =>'Active']);

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
            'idProducto' => $this->idProducto,
        ]);


        $query->andFilterWhere(['like', 'nombresw', $this->nombresw])
        // ->andFilterWhere(['estatusProducto' => 'Inactive'])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'version', $this->version])
             ->andFilterWhere(['like', 'clave', $this->clave]);
        /*$query->andFilterWhere(['like', 'nombresw', $this->globalSearch])
         ->andFilterWhere([
           // 'idproveedor' => $this->idproveedor,
            'estatusProducto' => 'Active',
        ])
            ->andFilterWhere(['like', 'descripcion', $this->globalSearch])
            ->orFilterWhere(['like', 'version', $this->globalSearch])
             ->orFilterWhere(['like', 'clave', $this->globalSearch]);
            */

        return $dataProvider;
    }
     public function searcheliminados($params)
    {
        $query = Producto::find()->where(['estatusProducto' =>'Inactive']);

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
            'idProducto' => $this->idProducto,
        ]);

/*
        $query->andFilterWhere(['like', 'nombresw', $this->nombresw])
        // ->andFilterWhere(['estatusProducto' => 'Inactive'])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'version', $this->version])
             ->andFilterWhere(['like', 'clave', $this->clave]);*/
        $query->andFilterWhere(['like', 'nombresw', $this->globalSearch])
         ->andFilterWhere([
           // 'idproveedor' => $this->idproveedor,
            'estatusProducto' => 'Inactive',
        ])
            ->orFilterWhere(['like', 'descripcion', $this->globalSearch])
            ->orFilterWhere(['like', 'version', $this->globalSearch])
             ->orFilterWhere(['like', 'clave', $this->globalSearch]);
           

        return $dataProvider;
    }
}
