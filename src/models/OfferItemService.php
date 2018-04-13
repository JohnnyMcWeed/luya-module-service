<?php

namespace johnnymcweed\service\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Offer Item Service.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $service_id
 * @property integer $offeritem_id
 */
class OfferItemService extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_offer_item_service';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-offeritemservice';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => Yii::t('app', 'Service ID'),
            'offeritem_id' => Yii::t('app', 'Offeritem ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'offeritem_id'], 'required'],
            [['service_id', 'offeritem_id'], 'integer'],
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