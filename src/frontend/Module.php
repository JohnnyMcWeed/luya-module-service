<?php

namespace johnnymcweed\service\frontend;

/**
 * Service Admin Module.
 *
 * File has been created with `module/create` command on LUYA version 1.0.0-dev. 
 */
class Module extends \luya\base\Module
{
    /**
     * If true, views will be looked up in the @app/views folder.
     * @var bool
     */
    public $useAppViewPath = true;

    public $slugField = 'slug';

    /**
     * The default item order in list view
     */
//    public $serviceDefaultOrder = [
//        'title' => SORT_ASC
//    ];

    /**
     * The default number of services listed on one page
     */
//    public $serviceDefaultPageSize = 10;

    /**
     * The routes for this module
     * @var array
     */
    public $urlRules = [
        [
            'pattern' => 'service',
            'route' => 'service/default/index',
            'composition' => [
                'en' => 'service',
                'de' => 'leistung',
                'fr' => 'service'
            ]
        ],
        [
            'pattern' => 'service/<slugs:.*>/',
            'route' => 'service/default/index',
            'encodeParams' => false,
            'composition' => [
                'en' => 'service/<slugs:.*>/',
                'de' => 'leistung/<slugs:.*>/',
                'fr' => 'service/<slugs:.*>/'
            ]
        ],

//        [
//            'pattern' => 'service/<slug:[a-zA-Z0-9\-]+>/',
//            'route' => 'service/default/detail',
//            'composition' => [
//                'en' => 'service/<id:\d+>/<slug:[a-zA-Z0-9\-]+>/',
//                'de' => 'leistung/<id:\d+>/<slug:[a-zA-Z0-9\-]+>/',
//                'fr' => 'service/<id:\d+>/<slug:[a-zA-Z0-9\-]+>/'
//            ]
//        ],

//        [
//            'pattern' => 'service/offer-calculator',
//            'route' => 'service/default/calculator',
//            'composition' => [
//                'en' => 'service/calculation',
//                'de' => 'leistung/rechner',
//                'fr' => 'service'
//            ]
//        ],
//        [
//            'pattern' => 'service/cart',
//            'route' => 'service/cart/index',
//            'composition' => [
//                'en' => 'service/calculation',
//                'de' => 'leistung/korb',
//                'fr' => 'service'
//            ]
//        ],
    ];
}