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
            'pattern' => 'services',
            'route' => 'service/default/roots',
        ]
    ];
}