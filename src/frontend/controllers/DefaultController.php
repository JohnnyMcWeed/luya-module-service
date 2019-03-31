<?php

namespace johnnymcweed\service\frontend\controllers;

use johnnymcweed\service\models\Service;
use luya\news\models\Cat;
use Yii;
use yii\data\ActiveDataProvider;
use luya\web\Controller;
use yii\data\Sort;

class DefaultController extends Controller
{
    const TYPE_ROOT = 'root';
    const TYPE_SERVICE = 'service';

    /*
     * Default views
     */
    public function actionIndex($slugs = null)
    {
        if (empty($slugs)) {
            $service = Service::find()->roots()->all();
            if (count($service) !== 1) {
                $type = self::TYPE_ROOT;
            } else {
                $type = self::TYPE_SERVICE;
                $service = $service[0];
            }
        } else {
            $params = explode('/', $slugs);
            if (!empty($services = Service::find()->where(['like', 'slug', $params[count($params)-1]])->all())) {
                if (count($services) !== 1) {
                    foreach ($services as $serv) {
                        if ($this->checkService($serv, $params)) {
                            $type = self::TYPE_SERVICE;
                            $service = $serv;
                            break;
                        }
                    }
                } else {
                    if ($this->checkService($services[0], $params)) {
                        $type = self::TYPE_SERVICE;
                        $service = $services;
                    }
                }
            }
        }

        if (empty($type)) {
            // Todo: Go to 404 page

        } else {
            return $this->render($type, [
                'service' => $service
            ]);
        }
    }

    /**
     * Checks whether it's the correct service
     *
     * Returns true if it is the correct one.
     *
     * @param $service
     * @param $params
     *
     * @return $theService Boolean Whether it's the service or not
     */
    private function checkService($service, $params)
    {
        $theService = false;

        $sort = new Sort([
            'attributes' => [
                'rgt' => SORT_DESC
            ]
        ]);
//        var_dump($params);
//        var_dump($service->parents()->orderBy($sort->orders)->all());

        return $theService;
    }
}
