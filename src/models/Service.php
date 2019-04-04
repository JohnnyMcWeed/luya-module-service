<?php
namespace johnnymcweed\service\models;

use johnnymcweed\service\frontend\components\UrlRule;
use luya\admin\traits\SortableTrait;
use netfant\category\models\NestedSetActiveQuery;
use netfant\category\models\NestedSetModelBehavior;
use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\CheckboxRelationActiveQuery;
use luya\helpers\Inflector;
use luya\helpers\Url;
use johnnymcweed\service\admin\Module;

/**
 * Service.
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
    public $benefits = [],
        $offerItems = [],
        $offerBundles = [],
        $stories = [],
        $faq = [],
        $isSimilarTo = [],
        $isRelatedTo = [];

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
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'tree' => [
                'class' => NestedSetModelBehavior::class
            ]
        ]);
    }

    /**
     * @inheritDoc
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }


    public static function find()
    {
        return new NestedSetActiveQuery(get_called_class());
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

    /**
     * Event triggers before update
     */
    public function eventBeforeUpdate()
    {
        $this->update_user_id = Yii::$app->adminuser->getId();
        $this->timestamp_update = time();
    }

    /**
     * Event triggers before insert
     */
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
            'id' => Yii::t('app', 'ID'),
            'title' => Module::t( 'Title'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'depth' => Yii::t('app', 'Depth'),
            'operation' => Yii::t('app', 'Operation'),
            'operationItem' => Yii::t('app', 'Item'),
            'teaser_text' => Module::t('Teaser Text'),
            'teaser_image' => Module::t('Teaser Image'),
            'slug' => Module::t('Slug'),
            'seo_title' => Module::t('Title'),
            'seo_description' => Module::t('Description'),
            'intro' => Module::t('Intro'),
            'intro_button' => Module::t('Intro Button'),
            'intro_button_link' => Module::t('Intro Button Link'),
            'intro_image' => Module::t('Intro Image'),
            'text' => Module::t('Description'),
            'benefits' => Module::t('Benefits'),
            'offerItemsCount' => Module::t('Items'),
            'offerBundlesCount' => Module::t('Bundles'),
            'stories' => Module::t('Stories'),
            'image_id' => Module::t( 'Image'),
            'logo_id' => Module::t( 'Logo'),
            'image_list' => Module::t( 'Images'),
            'file_list' => Module::t( 'Files'),
            'timestamp_create' => Module::t( 'Created'),
            'timestamp_display_from' => Module::t( 'Display From'),
            'timestamp_display_until' => Module::t( 'Display Until'),
            'is_display_limit' => Module::t( 'Is Display Limit'),
            'faq' => Module::t('FAQ\'s')
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'teaser_text', 'text', 'intro', 'intro_button', 'intro_button_link',  'slug', 'seo_title', 'seo_description', 'image_list', 'file_list', 'operation'], 'string'],
            [['create_user_id', 'update_user_id', 'timestamp_create', 'timestamp_update', 'timestamp_display_from', 'timestamp_display_until', 'operationItem'], 'integer'],
            [['intro_image', 'teaser_image', 'offerItems', 'offerBundles', 'isSimilarTo', 'isRelatedTo', 'stories', 'benefits', 'faq'], 'safe'],
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
            'id' => 'number',
            'title' => 'text',
            'text' => 'html',
            'teaser_text' => 'textarea',
            'lft' => 'number',
            'rgt' => 'number',
            'depth' => 'number',
            'slug' => ['slug', 'listener' => 'title'],
            'seo_title' => 'text',
            'seo_description' => 'textarea',
            'intro' => 'textarea',
            'intro_button' => 'text',
            'intro_button_link' => 'link',
            'intro_image' =>[
                'image',
                'imageItem' => true,
                'filter' => false
            ],
            'teaser_image' =>[
                'image',
                'imageItem' => true,
                'filter' => false
            ],
            'image_list' => 'imageArray',
            'file_list' => 'fileArray',
            'timestamp_create' => 'datetime',
            'timestamp_update' => 'date',
            'timestamp_display_from' => 'date',
            'timestamp_display_until' => 'date',
            'is_display_limit' => 'toggleStatus',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeGroups()
    {
        return [
            [['operation', 'operationItem'], 'Category', 'collapsed' => true],
            [['slug', 'seo_title', 'seo_description'], Module::t('SEO'), 'collapsed' => true],
            [['teaser_text', 'teaser_image'], 'Teaser', 'collapsed' => true],
            [['intro', 'intro_button', 'intro_button_link', 'intro_image'], Module::t('Intro'), 'collapsed' => true],
            [['text'], Module::t('Description'), 'collapsed' => true],
            [['benefits'], Module::t('Benetifs'), 'collapsed' => true],
            [['offerItems', 'offerBundles'], Module::t('Offers'), 'collapsed' => true],
            [['stories'], Module::t('Stories'), 'collapsed' => true],
            [['faq'], Module::t('FAQs'), 'collapsed' => true],
            [['isSimilarTo', 'isRelatedTo'], Module::t('Service Relations'), 'collapsed'=> true ],
            [['image_list', 'file_list'], Module::t('Media'), 'collapsed' => true],
            [['timestamp_create', 'timestamp_display_from', 'timestamp_display_until', 'is_display_limit'], Module::t('Time'), 'collapsed' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['title', 'lft', 'rgt', 'depth', 'offerItemsCount', 'offerBundlesCount']],
            [['create', 'update'], ['title', 'operation', 'operationItem', 'intro', 'intro_button', 'intro_button_link', 'intro_image', 'text', 'teaser_text', 'teaser_image', 'slug', 'seo_title', 'seo_description', 'image_list', 'file_list', 'isRelatedTo', 'isSimilarTo', 'timestamp_display_from', 'benefits', 'timestamp_display_until', 'is_display_limit', 'offerItems', 'offerBundles', 'stories', 'faq']],
            ['delete', true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'operation',
            'operationItem',
            'benefits',
            'offerItemsCount',
            'offerBundlesCount',
            'offerItems',
            'offerBundles',
            'stories',
            'faq',
            'isRelatedTo',
            'isSimilarTo',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestExtraAttributeTypes()
    {
        return [
            'operation' => [
                'selectArray',
                'data' => [
                    NestedSetModelBehavior::OPERATION_MAKE_ROOT => 'Make root',
                    NestedSetModelBehavior::OPERATION_PREPEND_TO => 'Prepend to',
                    NestedSetModelBehavior::OPERATION_APPEND_TO => 'Append to',
                    NestedSetModelBehavior::OPERATION_INSERT_BEFORE => 'Insert before',
                    NestedSetModelBehavior::OPERATION_INSERT_AFTER => 'Insert after',
                ]
            ],
            'operationItem' => [
                'selectModel',
                'modelClass' => Service::class,
                'valueField' => 'id',
                'labelField' => 'title',
            ],

            'benefits' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getBenefits(),
                'labelField' => ['title']
            ],
            'offerItemsCount' => 'number',
            'offerBundlesCount' => 'number',
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
            'stories' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getStories(),
                'labelField' => ['id', 'title']
            ],
            'isRelatedTo' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getRelated(),
                'labelField' => ['title']
            ],
            'isSimilarTo' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getSimilar(),
                'labelField' => ['title']
            ],
            'faq' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getFaq(),
                'labelField' => ['question']
            ]
        ];
    }

    /**
     * Get the service's main image
     *
     * @return bool|\luya\admin\image\Item
     */
    public function getImage()
    {
        return Yii::$app->storage->getImage($this->image_id);
    }

    /**
     * Get the service detail url
     *
     * @return string
     */
    public function getServiceUrl()
    {
        return Url::toRoute(['/service/default/service', 'id' => $this->id]);
    }

    /**
     * Get the roots url
     *
     * This url lists all roots
     *
     * @return string
     */
    public function getRootsUrl()
    {
        return Url::to(['service/default/roots']);
    }

    /**
     * Get the service's benefits
     *
     * @return $this
     */
    public function getBenefits()
    {
        return $this->hasMany(Benefit::class, ['id' => 'benefit_id'])->viaTable(Servicebenefit::tableName(), ['service_id' => 'id']);
    }

    public function getStories()
    {
        return $this->hasMany(Story::class, ['id' => 'story_id'])->viaTable(Servicestory::tableName(), ['service_id' => 'id']);
    }

    /**
     * Get the service's offer items
     *
     * @return $this
     */
    public function getOfferItems()
    {
        return $this->hasMany(OfferItem::class, ['id' => 'offeritem_id'])->viaTable(OfferItemService::tableName(), ['service_id' => 'id']);
    }

    /**
     * Return the number of offer items connected to that service
     *
     * @return int|string
     */
    public function getOfferItemsCount()
    {
        return $this->hasMany(OfferItemService::class, ['service_id' => 'id'])->count();
    }

    /**
     * Get the service's offer bundles
     *
     * @return $this
     */
    public function getOfferBundles()
    {
        return $this->hasMany(OfferBundle::class, ['id' => 'offerbundle_id'])->viaTable(OfferBundleService::tableName(), ['service_id' => 'id']);
    }

    /**
     * Return the number of offer bundles connected to that service
     *
     * @return int|string
     */
    public function getOfferBundlesCount()
    {
        return $this->hasMany(OfferBundleService::class, ['service_id' => 'id'])->count();
    }

    /**
     * Get services similar to the actual one
     *
     * @return $this
     */
    public function getSimilar()
    {
        return $this->hasMany(Service::class, ['id' => 'similar_service_id'])->viaTable( IsSimilarTo::tableName(), ['service_id' => 'id']);
    }

    /**
     * Get services related to the actual one
     *
     * @return $this
     */
    public function getRelated()
    {
        return $this->hasMany(Service::class, ['id' => 'relation_service_id'])->viaTable( IsRelatedTo::tableName(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaq()
    {
        return $this->hasMany(Faq::class, ['id' => 'faq_id'])->viaTable(Servicefaq::tableName(), ['service_id' => 'id']);
    }

    /**
     * Get the cheapest offer connected to a service
     *
     * @return array|bool
     */
    public function getCheapestOffer() {
        $offers = $this->getOfferItems()->asArray()->all();
        if ($offers !== []) {
            return $this->findMinPriceOffer($offers);
        } else {
            return false;
        }
    }

    /**
     * Find the cheapest offer in an array
     *
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