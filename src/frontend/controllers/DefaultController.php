<?php

namespace johnnymcweed\service\frontend\controllers;

use johnnymcweed\service\models\Service;
use luya\news\models\Cat;
use Yii;
use yii\data\ActiveDataProvider;
use luya\web\Controller;

class DefaultController extends Controller
{
    const TYPE_ROOT = 'root';
    const TYPE_SERVICE = 'service';

    /*
     * Default list view
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
            if (!empty($services = Service::find()->where(['like', 'slug', 'root'])->all())) {
                if (count($services) !== 1) {
                    foreach ($services as $serv) {




                        // Todo: Check if it is the right one
                        $parents = $service->parents();

                        $type = self::TYPE_SERVICE;
                        $service = $serv;
                    }
                } else {

                    // Todo: Check if it is the right one
                    $type = self::TYPE_SERVICE;
                    $service = $service[0];
                }


            } else {
                // Todo: Go to 404 page
                $type = null;
                $service = null;
            }
        }

        return $this->render($type, [
            'service' => $service
        ]);
    }
}
