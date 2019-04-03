<?php

namespace johnnymcweed\service\frontend;

use johnnymcweed\service\models\Service;
use yii\base\BootstrapInterface;
use yii\data\Sort;

/**
 * Service Bootstrap
 *
 *
 *
 * @author    Alexander Schmid <schmid@netfant.ch>
 * @copyright 2019 NetFant Schmid
 * @version   1.0.0
 * @since     1.0.0
 */
class RoutesBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {

//

//
//        $rules = [];
//
//        var_dump($services);


//        return $app;

        if ($app->hasModule('service')) {
            $app->on($app::EVENT_BEFORE_REQUEST, function ($event) {
                if (!$event->sender->request->isConsoleRequest && !$event->sender->request->isAdmin) {

                    $sort = new Sort([
                        'attributes' => [
                            'lft' => [
                                'asc'
                            ]
                        ]
                    ]);
                    $services = Service::find()->asArray()->all();
                    $routes = $this->buildRoute($services);
                    var_dump($routes);
                }
            });
        }
    }

    private function buildRoute($serviceArray)
    {
        $endServiceArray = [];
        if (!empty($serviceArray)) {
            //var_dump($serviceArray[0]['depth']); exit;
            if (!empty($serviceArray[0]['depth']) ||
                isset($serviceArray[0]['depth']) && (int) $serviceArray[0]['depth'] === 0 ) {
                if ($serviceArray[0]['depth'] == 0)
                    $startLevel = 0;
                else
                    $startLevel = $serviceArray[0]['depth'];

                $helperArr = [];
                foreach ($serviceArray as $serv) {
                    if ((int) $serv['depth'] === $startLevel) {
                        if (!empty($helperArr)) {
                            $c = count($endServiceArray);
                            $endServiceArray[$c-1]['children'] = $this->buildRoute($helperArr);
                            $helperArr = [];
                        }
                        $endServiceArray[] = $serv;

                    } elseif ((int) $serv['depth'] > $startLevel) {
                        $helperArr = $serv;
                    }
                }
                if (!empty($helperArr)) {
                    $c = count($endServiceArray);
                    $endServiceArray[$c-1]['children'] = $this->buildRoute($helperArr);
                }
            };

        }
//        var_dump($endServiceArray);
        return $endServiceArray;
    }
}