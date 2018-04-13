<?php
namespace app\modules\service\frontend\widgets\serviceswidget;

use luya\base\Widget;

class ServicesWidget extends Widget
{
    public $serviceProvider;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('_services', [
            'provider' => $this->serviceProvider
        ]);
    }
}