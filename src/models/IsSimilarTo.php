<?php

namespace johnnymcweed\service\models;

use johnnymcweed\service\admin\Module;
use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Is Similar To.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $service_id
 * @property integer $similar_service_id
 */
class IsSimilarTo extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_is_similar_to';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-issimilarto';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => Module::t('Service'),
            'similar_service_id' => Module::t('Similar Services'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'similar_service_id'], 'required'],
            [['service_id', 'similar_service_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return [''];
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