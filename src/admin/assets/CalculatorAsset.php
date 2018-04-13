<?php

namespace johnnymcweed\service\admin\assets;

use luya\web\Asset;

class CalculatorAsset extends Asset
{
    public $sourcePath = '@serviceadmin/resources';

    public $js = [
        'js/calculator.js',
    ];

    public $depends = [
        'luya\admin\assets\Main'
    ];
}