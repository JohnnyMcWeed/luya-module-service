<?php

namespace johnnymcweed\service\models;

use johnnymcweed\service\admin\Module;
use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Offer Bundle Offer Item.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $offerBundle_id
 * @property integer $offerItem_id
 */
class OfferBundleOfferItem extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_offer_bundle_offer_item';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-offerbundleofferitem';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'offerBundle_id' => Module::t('Offer Bundle'),
            'offerItem_id' => Module::t('Offer Item'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offerBundle_id', 'offerItem_id'], 'required'],
            [['offerBundle_id', 'offerItem_id'], 'integer'],
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