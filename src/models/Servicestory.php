<?php

namespace johnnymcweed\service\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Servicestory.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $service_id
 * @property integer $story_id
 */
class Servicestory extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_servicestory';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-servicestory';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => Yii::t('app', 'Service'),
            'story_id' => Yii::t('app', 'Story'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'story_id'], 'required'],
            [['service_id', 'story_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'service_id' => 'number',
            'story_id' => 'number',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['service_id', 'story_id']],
            [['create', 'update'], ['service_id', 'story_id']],
            ['delete', false],
        ];
    }
}