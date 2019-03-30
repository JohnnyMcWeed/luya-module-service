<?php

namespace johnnymcweed\service\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Story.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property text $title
 * @property text $story
 */
class Story extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['title', 'story'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_story';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-story';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'story' => Yii::t('app', 'Story'),
//            'image_id' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['image_id'], 'integer'],
            [['title', 'story'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'title' => 'text',
            'story' => 'textarea',
//            'image_id' => [
//                'image',
//                'imageItem' => true,
//                'filter' => false
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['title', 'story']],
            [['create', 'update'], ['title', 'story']],
            ['delete', false],
        ];
    }
}