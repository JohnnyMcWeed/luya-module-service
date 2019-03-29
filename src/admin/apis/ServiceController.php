<?php

namespace johnnymcweed\service\admin\apis;

use netfant\category\admin\NestedSetApiControllerTrait;

/**
 * Service Controller.
 * 
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev. 
 */
class ServiceController extends \luya\admin\ngrest\base\Api
{
    use NestedSetApiControllerTrait;

    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'johnnymcweed\service\models\Service';
}