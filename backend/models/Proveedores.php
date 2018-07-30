<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "proveedores".
 *
 * @property int $idproveedor
 * @property string $nomproveedor
 * @property string $razonsocial
 * @property string $estatusproveedor
 *
 * @property Licencia[] $licencias
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomproveedor', 'razonsocial','estatusproveedor'], 'string', 'max' => 45],
            [['nomproveedor', 'razonsocial'],'required'],
            [['nomproveedor'],'match', "pattern" => "/^[A-Za-záéíóúñ\s]+/", "message" => "No permitido"],
            [['razonsocial'],'match', "pattern" => "/^[A-Za-záéíóúñ\s.,]+/", "message" => "No permitido"]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproveedor' => 'ID de Proveedor',
            'nomproveedor' => 'Proveedor: ',
            'razonsocial' => 'Razón Social: ',
            'estatusproveedor' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicencias()
    {
        return $this->hasMany(Licencia::className(), ['Proveedores_idproveedor' => 'idproveedor']);
    }
}
