<?php

namespace johnnymcweed\service\admin\controllers;

use luya\admin\base\Controller;

class CalculatorController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'data' => [], // Data to assign into the view file `index`.
        ]);
    }
}