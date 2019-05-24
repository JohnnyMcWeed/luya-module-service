<?php

namespace johnnymcweed\service\frontend\blocks;

use johnnymcweed\service\admin\Module;
use johnnymcweed\service\models\Service;
use luya\cms\base\PhpBlock;
use luya\cms\frontend\blockgroups\ProjectGroup;
use luya\cms\helpers\BlockHelper;

/**
 * Teaser Block.
 *
 * File has been created with `block/create` command. 
 */
class TeaserBlock extends PhpBlock
{
    /**
     * @var string The module where this block belongs to in order to find the view files.
     */
    public $module = 'service';

    /**
     * @var bool Choose whether a block can be cached trough the caching component. Be carefull with caching container blocks.
     */
    public $cacheEnabled = true;
    
    /**
     * @var int The cache lifetime for this block in seconds (3600 = 1 hour), only affects when cacheEnabled is true
     */
    public $cacheExpiration = 3600;

    /**
     * @inheritDoc
     */
    public function blockGroup()
    {
        return ProjectGroup::class;
    }

    /**
     * @inheritDoc
     */
    public function name()
    {
        return 'Teaser Block';
    }
    
    /**
     * @inheritDoc
     */
    public function icon()
    {
        return 'extension'; // see the list of icons on: https://design.google.com/icons/
    }
 
    /**
     * @inheritDoc
     */
    public function config()
    {
        return [
            'vars' => [
                [
                    'var' => 'service',
                    'label' => Module::t('Service'),
                    'type' => self::TYPE_SELECT,
                    'options' => $this->getServices()
                ]
            ],
            'cfgs' => [
                [
                    'var' => 'showImage',
                    'label' => 'Show image',
                    'type' => self::TYPE_RADIO,
                    'options' => [["value" => true, "label" => "Yes"],["value" => false, "label" => "No"]]
                ],
                [
                    'var' => 'showTitle',
                    'label' => 'Show image',
                    'type' => self::TYPE_RADIO,
                    'options' => [["value" => true, "label" => "Yes"],["value" => false, "label" => "No"]]
                ],
                [
                    'var' => 'showText',
                    'label' => 'Show image',
                    'type' => self::TYPE_RADIO,
                    'options' => [["value" => true, "label" => "Yes"],["value" => false, "label" => "No"]]
                ],
                [
                    'var' => 'showLink',
                    'label' => 'Show image',
                    'type' => self::TYPE_RADIO,
                    'options' => [["value" => true, "label" => "Yes"],["value" => false, "label" => "No"]]
                ],

            ]
        ];
    }

    public function getServices()
    {
        $services = [];
        foreach (Service::find()->select(['id','seo_title'])->all() as $service) {
            $services[] = [
                'value' => (int) $service->id,
                'label' => $service->seo_title
            ];
        }
        return $services;
    }

    public function getService()
    {
        return Service::findOne($this->getVarValue('service'));
    }

    public function extraVars()
    {
        return [
            'service' => $this->getService()
        ];
    }

    /**
     * {@inheritDoc} 
     *
    */
    public function admin()
    {
        return '<h5 class="mb-3">Teaser Block</h5>' .
            '<table class="table table-bordered">' .
            '</table>';
    }
}