<?php

namespace johnnymcweed\service\admin\controllers;


use app\modules\category\admin\controllers\NestedSetControllerTrait;

/**
 * Service Controller.
 * 
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev. 
 */
class ServiceController extends \luya\admin\ngrest\base\Controller
{
    use NestedSetControllerTrait;

    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'johnnymcweed\service\models\Service';
}