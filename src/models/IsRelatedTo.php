<?php

namespace johnnymcweed\service\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Is Related To.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $service_id
 * @property integer $relation_service_id
 */
class IsRelatedTo extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_is_related_to';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-isrelatedto';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => Yii::t('app', 'Service ID'),
            'relation_service_id' => Yii::t('app', 'Relation Service ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'relation_service_id'], 'required'],
            [['service_id', 'relation_service_id'], 'integer'],
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