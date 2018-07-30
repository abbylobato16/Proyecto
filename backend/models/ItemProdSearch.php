<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ItemProd;

/**
 * ItemProdSearch represents the model behind the search form of `backend\models\ItemProd`.
 */
class ItemProdSearch extends ItemProd
{

    public $nombreswfk;
    public $descripcionfk;
    public $clavefk;

    //public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idItem_Prod', 'Cantidad'], 'integer'],
            [['Precio','Importe','nombreswfk','descripcionfk','clavefk'], 'safe'],
            [['Vencimiento','globalSearch', 'Producto_idProducto', 'Compras_idCompra','estatusItemProd','estatusNotificacion'], 'safe'],
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
        $query = ItemProd::find()->where(['estatusItemProd' =>'Active']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        //ordenar los atributos de mayor a menor o viseversa
        $dataProvider->sort->attributes['clavefk'] =
            [
            'asc' => ['producto.clave' => SORT_ASC], // TABLE_NAME.COLUMN_NAME
            'desc' => ['producto.clave' => SORT_DESC],
            ];
        $dataProvider->sort->attributes['nombreswfk'] =
            [
            'asc' => ['producto.nombresw' => SORT_ASC], // TABLE_NAME.COLUMN_NAME
            'desc' => ['producto.nombresw' => SORT_DESC],
            ];
        $dataProvider->sort->attributes['descripcionfk'] =
            [
            'asc' => ['producto.descripcion' => SORT_ASC], // TABLE_NAME.COLUMN_NAME
            'desc' => ['producto.descripcion' => SORT_DESC],
            ];

            
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->joinWith('productoIdProducto');
        $query->joinWith('comprasIdCompra');
        // grid filtering conditions
       /* $query->andFilterWhere([
            'idItem_Prod' => $this->idItem_Prod,
           // 'estatusItemProd' =>'Active',
        ]);
*/

        $query->andFilterWhere(['like', 'compras.NoFactura', $this->Compras_idCompra])
    ->andFilterWhere(['like', 'Cantidad', $this->Cantidad])
    ->andFilterWhere(['like', 'Precio', $this->Precio])
    ->andFilterWhere(['like', 'Importe', $this->Importe])
    ->andFilterWhere(['like', 'Vencimiento', $this->Vencimiento])
    ->andFilterWhere(['like', 'producto.nombresw', $this->nombreswfk])
    ->andFilterWhere(['like', 'producto.clave', $this->clavefk])
    ->andFilterWhere(['like', 'producto.descripcion', $this->descripcionfk])
     ->andWhere(['estatusItemProd' =>'Active']);
   

/*$query->andFilterWhere(['like', 'Cantidad', $this->globalSearch])
    ->orFilterWhere(['like', 'Precio', $this->globalSearch])
    ->orFilterWhere(['like', 'Importe', $this->globalSearch])
    ->orFilterWhere(['like', 'Vencimiento', $this->globalSearch])
    ->orFilterWhere(['like', 'compras.NoFactura', $this->globalSearch])
    ->orFilterWhere(['like', 'producto.nombresw', $this->globalSearch])
    ->orFilterWhere(['like', 'producto.clave', $this->globalSearch])
    ->orFilterWhere(['like', 'producto.descripcion', $this->globalSearch])
     ->andWhere(['estatusItemProd' =>'Active']);*/
        return$dataProvider;
    }


    public function searches($params)
    {
        $query = ItemProd::find()->where(['Compras_idCompra'=>$params,'estatusItemProd' => 'Active']);

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
        /*$query->andFilterWhere([
            'idItem_Prod' => $this->globalSearch,
            'Cantidad' => $this->globalSearch,
            'Precio' => $this->globalSearch,
            'Vencimiento' => $this->globalSearch,
            'Producto_idProducto' => $this->globalSearch,
            'Compras_idCompra' => $this->globalSearch,
        ]);*/



        $query->andFilterWhere(['like', 'compras.NoFactura', $this->Compras_idCompra])
    ->andFilterWhere(['like', 'Cantidad', $this->Cantidad])
    ->andFilterWhere(['like', 'Precio', $this->Precio])
    ->andFilterWhere(['like', 'Importe', $this->Importe])
    ->andFilterWhere(['like', 'Vencimiento', $this->Vencimiento])
    ->andFilterWhere(['like', 'producto.nombresw', $this->nombreswfk])
    ->andFilterWhere(['like', 'producto.clave', $this->clavefk])
    ->andFilterWhere(['like', 'producto.descripcion', $this->descripcionfk])
     ->andWhere(['estatusItemProd' =>'Active']);

        return $dataProvider;
    }
}
