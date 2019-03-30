<?php

namespace johnnymcweed\service\models;

use johnnymcweed\service\admin\Module;
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
            'service_id' => Module::t('Service'),
            'story_id' => Module::t('Story'),
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
            'service_id' => [
                'selectModel',
                'modelClass' => Service::class,
                'valueField' => 'id',
                'labelField' => 'title',
            ],
            'story_id' => [
                'selectModel',
                'modelClass' => Story::class,
                'valueField' => 'id',
                'labelField' => 'title',
            ],
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