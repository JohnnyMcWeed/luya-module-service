<?php

namespace johnnymcweed\service\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Servicebenefit.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $service_id
 * @property integer $benefit_id
 */
class Servicebenefit extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_servicebenefit';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-servicebenefit';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => Yii::t('app', 'Service'),
            'benefit_id' => Yii::t('app', 'Benefit'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'benefit_id'], 'required'],
            [['service_id', 'benefit_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'service_id' => [
                'selectModel',
                'modelClass' => Service::class,
                'valueField' => 'id',
                'labelField' => 'title',
            ],
            'benefit_id' => [
                'selectModel',
                'modelClass' => Benefit::class,
                'valueField' => 'id',
                'labelField' => 'title',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['service_id', 'benefit_id']],
            [['create', 'update'], ['service_id', 'benefit_id']],
            ['delete', false],
        ];
    }
}