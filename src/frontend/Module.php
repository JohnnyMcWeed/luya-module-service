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

    /*
     * The default item order in list view
     */
    public $serviceDefaultOrder = [
        'title' => SORT_ASC
    ];

    /*
     * The default number of services listed on one page
     */
    public $serviceDefaultPageSize = 10;

    /**
     * The routes for this module
     * @var array
     */
    public $urlRules = [
        ['pattern' => 'service/offer-calculator', 'route' => 'service/default/offer-calculator', 'composition' => [
            'en' => 'service/offer-calculator',
            'de' => 'leistung/preisrechner',
            'fr' => 'service/calculateur-d-offre'
        ]],
        ['pattern' => 'service/<slug:[A-Za-z0-9-_.]+>', 'route' => 'service/default/category', 'composition' => [
            'de' => 'leistung/<slug:[A-Za-z0-9-_.]+>',
            'fr' => 'service/<slug:[A-Za-z0-9-_.]+>'
        ]],
        ['pattern' => 'service/<slug:[A-Za-z0-9-_.]+>', 'route' => 'service/default/detail', 'composition' => [
            'de' => 'leistung/<slug:[A-Za-z0-9-_.]+>',
            'fr' => 'service/<slug:[A-Za-z0-9-_.]+>'
        ]],
        ['pattern' => 'service', 'route' => 'service/default/index', 'composition' => [
            'en' => 'service',
            'de' => 'leistung',
            'fr' => 'service'
        ]]


        //['pattern' => 'services/', 'route' => 'service/default/services'],
        //['pattern' => 'services/offer-calculator', 'route' => 'service/default/offer-calculator'],
        //['pattern' => 'service/<id:\d+>/<title:[a-zA-Z0-9\-]+>/', 'route' => 'service/default/service'],
    ];
}