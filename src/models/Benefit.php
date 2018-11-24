<?php

namespace johnnymcweed\service\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Benefit.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property string $title
 * @property string $teaser
 * @property integer $image_id
 */
class Benefit extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['title', 'teaser'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_benefit';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-benefit';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'teaser' => Yii::t('app', 'Teaser'),
            'image_id' => Yii::t('app', 'Image ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id'], 'integer'],
            [['title', 'teaser'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'title' => 'text',
            'teaser' => 'text',
            'image_id' => 'number',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['title', 'teaser', 'image_id']],
            [['create', 'update'], ['title', 'teaser', 'image_id']],
            ['delete', false],
        ];
    }
}