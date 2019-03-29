<?php

namespace johnnymcweed\service\admin\apis;

/**
 * Story Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class StoryController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'johnnymcweed\service\models\Story';
}