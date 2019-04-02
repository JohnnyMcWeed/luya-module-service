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
    /**
     * @param null $id
     */
    public function actionService($id = null)
    {

        if (!empty($service = Service::findOne(['id' => $id]))) {
            return $this->render('service', [
                'service' => $service
            ]);
        }
        // Todo: 404 page
    }

    public function actionRoots()
    {
        if (!empty($roots = Service::find()->roots()->all())) {
            return $this->render('roots', [
                'roots' => $roots
            ]);
        }
        // Todo: 404 page
    }
}
