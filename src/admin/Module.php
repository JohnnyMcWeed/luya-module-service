<?php

namespace johnnymcweed\service\admin;

// Todo: Add slugs
// Todo: Add SEO
// Todo: Add "cart"

/**
 * Service Admin Module.
 *
 * File has been created with `module/create` command on LUYA version 1.0.0-dev. 
 */
class Module extends \luya\admin\base\Module
{
    public $apis = [
        'api-service-service' => 'app\modules\service\admin\apis\ServiceController',
        'api-service-isrelatedto' => 'app\modules\service\admin\apis\IsRelatedToController',
        'api-service-issimilarto' => 'app\modules\service\admin\apis\IsSimilarToController',

        'api-service-offeritem' => 'app\modules\service\admin\apis\OfferItemController',
        'api-service-offerbundle' => 'app\modules\service\admin\apis\OfferBundleController',
        'api-service-offerbundleofferitem' => 'app\modules\service\admin\apis\OfferBundleOfferItemController',
        'api-service-offeritemservice' => 'app\modules\service\admin\apis\OfferItemServiceController',
        'api-service-offerbundleservice' => 'app\modules\service\admin\apis\OfferBundleServiceController',
    ];

    public function getMenu()
    {
        return (new \luya\admin\components\AdminMenuBuilder($this))
            ->node(self::t('Service'), 'extension')
            ->group(self::t('Administrate'))
            ->itemApi(self::t('Service'), 'serviceadmin/service/index', 'label', 'api-service-service')
            ->itemApi(self::t('Is Related To'), 'serviceadmin/is-related-to/index', 'label', 'api-service-isrelatedto', ['hiddenInMenu' => true])
            ->itemApi(self::t('Is Similar To'), 'serviceadmin/is-similar-to/index', 'label', 'api-service-issimilarto', ['hiddenInMenu' => true])
            ->itemApi(self::t('Offer Item'), 'serviceadmin/offer-item/index', 'label', 'api-service-offeritem')
            ->itemApi(self::t('Offer Bundle'), 'serviceadmin/offer-bundle/index', 'label', 'api-service-offerbundle')
            ->itemApi(self::t('Offer Bundle Offer Item'), 'serviceadmin/offer-bundle-offer-item/index', 'label', 'api-service-offerbundleofferitem', ['hiddenInMenu' => true])
            ->itemApi(self::t('OfferItemService'), 'serviceadmin/offer-item-service/index', 'label', 'api-service-offeritemservice', ['hiddenInMenu' => true])
            ->itemApi(self::t('OfferBundleService'), 'serviceadmin/offer-bundle-service/index', 'label', 'api-service-offerbundleservice', ['hiddenInMenu' => true])
            ->itemRoute(self::t('Calculator'), 'serviceadmin/calculator/index', 'label');
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

    public function getAdminAssets()
    {
        return [
            'app\modules\service\admin\assets\CalculatorAsset'
        ];
    }
}