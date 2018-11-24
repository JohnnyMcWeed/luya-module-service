<?php

namespace johnnymcweed\service\admin\apis;

/**
 * Benefit Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class BenefitController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'johnnymcweed\service\models\Benefit';
}