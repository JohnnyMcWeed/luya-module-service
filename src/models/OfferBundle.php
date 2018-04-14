<?php

namespace johnnymcweed\service\models;

use johnnymcweed\service\admin\Module;
use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Offer Bundle.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property string $title
 * @property text $description
 * @property float $price
 */
class OfferBundle extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['title', 'description'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_offer_bundle';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-offerbundle';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_INSERT, [$this, 'eventBeforeInsert']);
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'eventBeforeUpdate']);
    }
    public function eventBeforeUpdate()
    {
        $this->update_user_id = Yii::$app->adminuser->getId();
        $this->timestamp_update = time();
    }

    public function eventBeforeInsert()
    {
        $this->create_user_id = Yii::$app->adminuser->getId();
        $this->update_user_id = Yii::$app->adminuser->getId();
        $this->timestamp_update = time();
        if (empty($this->timestamp_create)) {
            $this->timestamp_create = time();
        }
        if (empty($this->timestamp_display_from)) {
            $this->timestamp_display_from = time();
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'title' => Module::t('Title'),
            'description' => Module::t('Description'),
            'price' => Module::t('Price'),
            'discount_price' => Module::t('Discount price'),
            'discount_from' => Module::t('Discount price from'),
            'discount_until' => Module::t('Discount price until'),
            'is_discount' => Module::t('Is discount'),
            'timestamp_create' => Module::t( 'Created'),
            'timestamp_display_from' => Module::t( 'Display From'),
            'timestamp_display_until' => Module::t( 'Display Until'),
            'is_display_limit' => Module::t( 'Is Display Limit'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['create_user_id', 'update_user_id', 'timestamp_create',
                'timestamp_update', 'timestamp_display_from', 'timestamp_display_until', 'discount_from', 'discount_until'], 'integer'],
            [['price', 'discount_price',], 'number'],
            [['is_discount', 'is_display_limit'], 'boolean'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['title', 'description'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'title' => 'text',
            'description' => 'textarea',
            'price' => 'decimal',
            'discount_price' => 'decimal',
            'discount_from' => 'datetime',
            'discount_until' => 'datetime',
            'is_discount' => 'toggleStatus',
            'is_display_limit' => 'toggleStatus',
            'timestamp_display_from' => 'datetime',
            'timestamp_display_until' => 'datetime',
        ];
    }

    public function ngRestAttributeGroups()
    {
        return [
            [['price', 'discount_price', 'discount_from', 'discount_until', 'is_discount'], Module::t('Price'), 'collapsed' => true],
            [['timestamp_create', 'timestamp_display_from', 'timestamp_display_until', 'is_display_limit'], Module::t('Time'), 'collapsed' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['title', 'description', 'price']],
            [['create', 'update'], ['title', 'description', 'price', 'discount_price', 'discount_from', 'discount_until',
                'is_discount', 'timestamp_display_from', 'timestamp_display_until', 'is_display_limit']],
            ['delete', false],
        ];
    }
}