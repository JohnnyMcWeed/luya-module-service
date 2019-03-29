<?php
namespace johnnymcweed\service\admin;

/**
 * Service Admin Module.
 *
 * File has been created with `module/create` command on LUYA version 1.0.0-dev. 
 */
class Module extends \luya\admin\base\Module
{

    public $apis = [
        'api-service-service' => 'johnnymcweed\service\admin\apis\ServiceController',
        'api-service-isrelatedto' => 'johnnymcweed\service\admin\apis\IsRelatedToController',
        'api-service-issimilarto' => 'johnnymcweed\service\admin\apis\IsSimilarToController',

        'api-service-offeritem' => 'johnnymcweed\service\admin\apis\OfferItemController',
        'api-service-offerbundle' => 'johnnymcweed\service\admin\apis\OfferBundleController',
        'api-service-offerbundleofferitem' => 'johnnymcweed\service\admin\apis\OfferBundleOfferItemController',
        'api-service-offeritemservice' => 'johnnymcweed\service\admin\apis\OfferItemServiceController',
        'api-service-offerbundleservice' => 'johnnymcweed\service\admin\apis\OfferBundleServiceController',

        'api-service-benefit' => 'johnnymcweed\service\admin\apis\BenefitController',
        'api-service-servicebenefit' => 'johnnymcweed\service\admin\apis\ServicebenefitController',

        'api-service-faq' => 'johnnymcweed\service\admin\apis\FaqController',
        'api-service-servicefaq' => 'johnnymcweed\service\admin\apis\ServicefaqController',
        'api-service-story' => 'johnnymcweed\service\admin\apis\StoryController',
        'api-service-servicestory' => 'johnnymcweed\service\admin\apis\ServicestoryController',
    ];

    /**
     * @return array|\luya\admin\components\AdminMenuBuilder|\luya\admin\components\AdminMenuBuilderInterface
     */
    public function getMenu()
    {
        return (new \luya\admin\components\AdminMenuBuilder($this))
            ->node(self::t('Service'), 'store_mall_directory')
            ->group(self::t('Administrate'))
            ->itemApi(self::t('Service'), 'serviceadmin/service/index', 'transfer_within_a_station', 'api-service-service')
            ->itemApi(self::t('Is Related To'), 'serviceadmin/is-related-to/index', 'label', 'api-service-isrelatedto', ['hiddenInMenu' => true])
            ->itemApi(self::t('Is Similar To'), 'serviceadmin/is-similar-to/index', 'label', 'api-service-issimilarto', ['hiddenInMenu' => true])
            ->itemApi(self::t('Offer Item'), 'serviceadmin/offer-item/index', 'shop', 'api-service-offeritem')
            ->itemApi(self::t('Offer Bundle'), 'serviceadmin/offer-bundle/index', 'shop_two', 'api-service-offerbundle')
            ->itemApi(self::t('Offer Bundle Offer Item'), 'serviceadmin/offer-bundle-offer-item/index', 'label', 'api-service-offerbundleofferitem', ['hiddenInMenu' => true])
            ->itemApi(self::t('OfferItemService'), 'serviceadmin/offer-item-service/index', 'label', 'api-service-offeritemservice', ['hiddenInMenu' => true])
            ->itemApi(self::t('OfferBundleService'), 'serviceadmin/offer-bundle-service/index', 'label', 'api-service-offerbundleservice', ['hiddenInMenu' => true])
            ->itemApi(self::t('Benefit'), 'serviceadmin/benefit/index', 'filter_vintage', 'api-service-benefit')
            ->itemApi(self::t('Servicebenefit'), 'serviceadmin/servicebenefit/index', 'label', 'api-service-servicebenefit', ['hiddenInMenu' => true])
            ->itemApi(self::t('Faq'), 'serviceadmin/faq/index', 'question_answer', 'api-service-faq')
            ->itemApi(self::t('Faq'), 'serviceadmin/servicefaq/index', 'label', 'api-service-servicefaq', ['hiddenInMenu' => true])
            ->itemApi(self::t('Story'), 'serviceadmin/story/index', 'speaker_notes', 'api-service-story')
            ->itemApi(self::t('Servicestory'), 'serviceadmin/servicestory/index', 'label', 'api-service-servicestory', ['hiddenInMenu' => true])
            ->itemRoute(self::t('Calculator'), 'serviceadmin/calculator/index', 'format_list_numbered');
    }


    public static function onLoad()
    {
        self::registerTranslation('serviceadmin', '@serviceadmin/messages', [
            'serviceadmin' => 'serviceadmin.php',
        ]);
    }

    /**
     * Translat news messages.
     *
     * @param string $message
     * @param array $params
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('serviceadmin', $message, $params);
    }
}