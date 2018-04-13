<?php

namespace johnnymcweed\service\frontend\controllers;

use johnnymcweed\service\models\Service;
use Yii;
use yii\data\ActiveDataProvider;

class DefaultController extends \yii\web\Controller
{
    /*
     * Default list view
     */
    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => Service::find()->andWhere(['is_deleted' => false]),
            'sort' => [
                'defaultOrder' => $this->module->serviceDefaultOrder,
            ],
            'pagination' => [
                'route' => $this->module->id,
                'params' => [
                    'page' => Yii::$app->request->get('page')
                ],
                'defaultPageSize' => $this->module->serviceDefaultPageSize
            ]
        ]);
        return $this->render('index', [
            'model' => Service::class,
            'provider' => $provider
        ]);
    }


    /*
     *
     */
    public function actionDetail()
    {
        return $this->render('detail');
    }

    /*
     *
     */
    public function actionCalculator()
    {
        return $this->render('calculator');
    }

}
