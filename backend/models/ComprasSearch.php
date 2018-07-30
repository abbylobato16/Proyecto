<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Compras;

/**
 * ComprasSearch represents the model behind the search form of `backend\models\Compras`.
 */
class ComprasSearch extends Compras
{


      public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCompra'], 'integer'],
            [['Fecha', 'Titular', 'Mantenimiento','Proveedores_idproveedor', 'estatusCompra','globalSearch','image_src_filename','NoFactura'], 'safe'],
            [['PrecioTotal'], 'safe'],
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
        $query = Compras::find()->where(['estatusCompra' =>'Active']);

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



        $query->joinWith('proveedoresIdproveedor');
         //grid filtering conditions
        /*$query->andFilterWhere([
            'idCompra' => $this->idCompra,
            'NoFactura' => $this->NoFactura,
            'Fecha' => $this->Fecha,
            'PrecioTotal' => $this->PrecioTotal,
        ]);

*/
        $query->andFilterWhere(['like', 'Titular', $this->Titular])
           ->andFilterWhere(['like', 'Mantenimiento', $this->Mantenimiento])
            ->andFilterWhere(['like', 'NoFactura', $this->NoFactura])
            ->andFilterWhere(['like', 'Fecha', $this->Fecha])
            ->andFilterWhere(['like', 'PrecioTotal', $this->PrecioTotal])
            ->andFilterWhere(['like', 'image_src_filename', $this->image_src_filename])
            ->andFilterWhere(['like','proveedores.nomproveedor', $this->Proveedores_idproveedor]);
             //->andWhere(['estatusCompra' => 'Active']);
       /* $query->andFilterWhere(['like', 'Titular', $this->globalSearch])
           ->orFilterWhere(['like', 'Mantenimiento', $this->globalSearch])
            ->orFilterWhere(['like', 'NoFactura', $this->globalSearch])
            ->orFilterWhere(['like', 'Fecha', $this->globalSearch])
            ->orFilterWhere(['like', 'PrecioTotal', $this->globalSearch])
            ->orFilterWhere(['like', 'image_src_filename', $this->globalSearch])
            ->orFilterWhere(['like','proveedores.nomproveedor', $this->globalSearch])
             ->andWhere(['estatusCompra' => 'Active']);*/
            

        return $dataProvider;
    }

 public function searches($params)
    {
        $query = Compras::find()->where(['estatusCompra' =>'Active','idCompra'=>$params]);

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
        /*$query->andFilterWhere([
            'idCompra' => $this->idCompra,
            'NoFactura' => $this->NoFactura,
            'Fecha' => $this->Fecha,
            'PrecioTotal' => $this->PrecioTotal,
        ]);
*/
      /*  $query->andFilterWhere(['like', 'Titular', $this->globalSearch])
        ->andFilterWhere([
           // 'idproveedor' => $this->idproveedor,
            'estatusCompra' => 'Active',
        ])
            ->andFilterWhere(['like', 'Mantenimiento', $this->globalSearch])
            ->orFilterWhere(['like', 'NoFactura', $this->globalSearch])
            ->orFilterWhere(['like', 'Fecha', $this->globalSearch])
            ->orFilterWhere(['like', 'PrecioTotal', $this->globalSearch]);
*/
        return $dataProvider;
    }
     public function searcheliminados($params)
    {
        $query = Compras::find()->where(['estatusCompra' =>'Inactive']);

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
     /*   $query->andFilterWhere([
            'idCompra' => $this->idCompra,
            'NoFactura' => $this->NoFactura,
            'Fecha' => $this->Fecha,
            'PrecioTotal' => $this->PrecioTotal,
        ]);
*/
       /* $query->andFilterWhere(['like', 'Titular', $this->Titular])
            ->orFilterWhere(['like', 'Mantenimiento', $this->Mantenimiento])
            ->orFilterWhere(['like', 'estatusCompra', $this->estatusCompra]);
*/
        return $dataProvider;
    }
}
