<?php

namespace johnnymcweed\service\frontend\controllers;

use johnnymcweed\service\models\Service;
use luya\helpers\Url;
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
    }

    public function actionRoots()
    {
        if (!empty($roots = Service::find()->roots()->all())) {
            if (count($roots) == 1) {
                $this->redirect(Url::toRoute(['/service/default/service', 'id' => $roots[0]['id']]));
            }
            return $this->render('roots', [
                'roots' => $roots
            ]);
        }
    }
}
