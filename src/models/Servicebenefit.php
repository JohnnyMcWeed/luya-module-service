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
            'service_id' => Yii::t('app', 'Service ID'),
            'benefit_id' => Yii::t('app', 'Benefit ID'),
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
            [['service_id', 'benefit_id'], 'unique', 'targetAttribute' => ['service_id', 'benefit_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['']],
            [['create', 'update'], ['']],
            ['delete', false],
        ];
    }
}