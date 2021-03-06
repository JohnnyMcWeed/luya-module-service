<?php

namespace johnnymcweed\service\models;

use johnnymcweed\service\admin\Module;
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
            'service_id' => Module::t('Service'),
            'offeritem_id' => Module::t('Offeritem'),
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
    public function ngRestAttributeTypes()
    {
        return [
            'service_id' => 'number',
            'offeritem_id' => 'number',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['service_id', 'offeritem_id']],
            [['create', 'update'], ['service_id', 'offeritem_id']],
            ['delete', false],
        ];
    }
}