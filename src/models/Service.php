<?php

namespace johnnymcweed\service\models;

use johnnymcweed\service\admin\Module;
use luya\admin\ngrest\plugins\CheckboxRelationActiveQuery;
use luya\helpers\Inflector;
use luya\helpers\Url;
use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Service.
 * 
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev. 
 *
 * @property integer $id
 * @property text $title
 * @property text $text
 * @property integer $cat_id
 * @property integer $image_id
 * @property integer $logo_id
 * @property text $image_list
 * @property text $file_list
 * @property integer $create_user_id
 * @property integer $update_user_id
 * @property integer $timestamp_create
 * @property integer $timestamp_update
 * @property integer $timestamp_display_from
 * @property integer $timestamp_display_until
 * @property smallint $is_deleted
 * @property smallint $is_display_limit
 */
class Service extends NgRestModel
{
    public $offerItems = [];
    public $offerBundles = [];
    public $isSimilarTo = [];
    public $isRelatedTo = [];

    // Todo: Make isSimilarTo, isRelatedTo work

    /**
     * @inheritdoc
     */
    public $i18n = ['title', 'text', 'teaser_text', 'slug', 'seo_title', 'seo_description'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_service';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-service';
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
            'title' => Module::t( 'Title'),
            'parent_id' => Module::t('Parent'),
            'text' => Module::t('Description'),
            'teaser_text' => Module::t('Teaser Text'),
            'slug' => Module::t('Slug'),
            'seo_title' => Module::t('Title'),
            'seo_description' => Module::t('Description'),
            'image_id' => Module::t( 'Image'),
            'logo_id' => Module::t( 'Logo'),
            'image_list' => Module::t( 'Images'),
            'file_list' => Module::t( 'Files'),
            'timestamp_create' => Module::t( 'Created'),
            'timestamp_display_from' => Module::t( 'Display From'),
            'timestamp_display_until' => Module::t( 'Display Until'),
            'is_display_limit' => Module::t( 'Is Display Limit'),
            'offerItemsCount' => Module::t('Items'),
            'offerBundlesCount' => Module::t('Bundles')
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'teaser_text', 'slug', 'seo_title', 'seo_description', 'image_list', 'file_list'], 'string'],
            [['parent_id', 'create_user_id', 'update_user_id', 'timestamp_create',
                'timestamp_update', 'timestamp_display_from', 'timestamp_display_until'], 'integer'],
            [['logo_id', 'image_id', 'offerItems', 'offerBundles', 'isSimilarTo', 'isRelatedTo'], 'safe'],
            [['is_display_limit'], 'boolean'],
            [['title'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['title', 'text', 'teaser_text'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'title' => 'text',
            'text' => 'textarea',
            'teaser_text' => 'textarea',
            'parent_id' => [
                'selectModel',
                'modelClass' => Service::class,
                'valueField' => 'id',
                'labelField' => 'title'
            ],
            'slug' => 'slug',
            'seo_title' => 'text',
            'seo_description' => 'textarea',
            'image_id' => 'image',
            'logo_id' => 'image',
            'image_list' => 'imageArray',
            'file_list' => 'fileArray',
            'timestamp_create' => 'datetime',
            'timestamp_update' => 'date',
            'timestamp_display_from' => 'date',
            'timestamp_display_until' => 'date',
            'is_display_limit' => 'toggleStatus',
            'offerItems' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getOfferItems(),
                'labelField' => ['title', 'price']
            ],
            'offerBundles' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getOfferBundles(),
                'labelField' => ['title', 'price']
            ],
            'isRelatedTo' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getIsRelatedTo(),
                'labelField' => ['title']
            ],
            'isSimilarTo' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getIsSimilarTo(),
                'labelField' => ['title']
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeGroups()
    {
        return [
            [['isSimilarTo', 'isRelatedTo', 'parent_id'], Module::t('Service Relations'), 'collapsed'=> true ],
            [['slug', 'seo_title', 'seo_description'], Module::t('SEO'), 'collapsed' => true],
            [['logo_id', 'image_id', 'image_list', 'file_list'], Module::t('Media'), 'collapsed' => true],
            [['offerItems', 'offerBundles'], Module::t('Offers'), 'collapsed' => true],
            [['timestamp_create', 'timestamp_display_from', 'timestamp_display_until', 'is_display_limit'], Module::t('Time'), 'collapsed' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['title', 'offerItemsCount', 'offerBundlesCount', 'parent_id']],
            [['create', 'update'], ['title', 'text', 'teaser_text', 'parent_id', 'slug', 'seo_title', 'seo_description',
                'image_id', 'logo_id', 'image_list', 'file_list', 'timestamp_create', 'isRelatedTo', 'isSimilarTo',
                'timestamp_display_from', 'timestamp_display_until', 'is_display_limit', 'offerItems', 'offerBundles']],
            ['delete', false],
        ];
    }

    public function extraFields()
    {
        return [
            'offerItemsCount',
            'offerBundlesCount',
        ];
    }

    public function ngRestExtraAttributeTypes()
    {
        return [
            'offerItemsCount' => 'number',
            'offerBundlesCount' => 'number',
        ];
    }

    public function getImage()
    {
        return Yii::$app->storage->getImage($this->image_id);
    }

    /**
     * Get the service url
     *
     * @return string
     */
    public function getServiceUrl()
    {
        return Url::toRoute(['/service/default/service', 'id' => $this->id, 'title' => Inflector::slug($this->title)]);
    }

    public function getOfferItems() {
        return $this->hasMany(OfferItem::class, ['id' => 'offeritem_id'])->viaTable('service_offer_item_service', ['service_id' => 'id']);
    }

    public function getOfferItemsCount() {
        return $this->hasMany(OfferItemService::class, ['service_id' => 'id'])->count();
    }

    public function getOfferBundles() {
        return $this->hasMany(OfferBundle::class, ['id' => 'offerbundle_id'])->viaTable('service_offer_bundle_service', ['service_id' => 'id']);
    }

    public function getOfferBundlesCount() {
        return $this->hasMany(OfferBundleService::class, ['service_id' => 'id'])->count();
    }

    public function getIsSimilarTo() {
        return $this->hasMany(Service::class, ['id' => 'similar_service_id'])->viaTable('service_is_similar_to', ['service_id' => 'id']);
    }

    public function getIsRelatedTo() {
        return $this->hasMany(Service::class, ['id' => 'relation_service_id'])->viaTable('service_is_related_to', ['service_id' => 'id']);
    }

    public function getCheapestOffer() {
        $offers = $this->getOfferItems()->asArray()->all();
        if ($offers !== []) {
            $minPriceOffer = $this->findMinPriceOffer($offers);
        } else {
            $minPriceOffer = [];
        }
        return $minPriceOffer;
    }

    /**
     * @param $arr OfferItem
     * @return bool
     */
    private function findMinPriceOffer($arr) {
        $minPriceItem = [];
        foreach ($arr as $offer) {
            if ($offer['is_discount'] &&
                $offer['discount_from'] < time() &&
                $offer['discount_until'] > time() &&
                $offer['price'] > $offer['discount_price']) {
                if ( $minPriceItem === [] ) {
                    $minPriceItem = [$offer['id'], $offer['discount_price']];
                } elseif ($minPriceItem[1] > $offer['discount_price']) {
                    $minPriceItem = [$offer['id'], $offer['discount_price']];
                }
            } else {
                if ( $minPriceItem === [] ) {
                    $minPriceItem = [$offer['id'], $offer['price']];
                } elseif ($minPriceItem[1] > $offer['price']) {
                    $minPriceItem = [$offer['id'], $offer['price']];
                }
            }
        }
        foreach ($arr as $offer) {
            if ($offer['id'] === $minPriceItem[0]) {
                return $offer;
            }
        }
        return false;
    }
}