<?php

namespace johnnymcweed\service\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Servicefaq.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $service_id
 * @property integer $faq_id
 */
class Servicefaq extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_servicefaq';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-servicefaq';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => Yii::t('app', 'Service'),
            'faq_id' => Yii::t('app', 'FAQ'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'faq_id'], 'required'],
            [['service_id', 'faq_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'service_id' => 'number',
            'faq_id' => 'number',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['service_id', 'faq_id']],
            [['create', 'update'], ['service_id', 'faq_id']],
            ['delete', false],
        ];
    }
}