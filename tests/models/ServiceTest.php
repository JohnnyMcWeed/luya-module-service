<?php
namespace johnnymcweed\service\tests\models;

use Yii;
use luya\testsuite\traits\MessageFileCompareTrait;
use luya\testsuite\traits\MigrationFileCheckTrait;

class ServiceTest extends \luya\testsuite\cases\WebApplicationTestCase
{
    use MessageFileCompareTrait, MigrationFileCheckTrait;

    public function getConfigArray()
    {
        return [
            'id' => 'servicetest',
            'basePath' => dirname(__DIR__),
            'modules' => [
                'serviceadmin' => 'johnnymcweed\service\admin\Module'
            ],
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'fake'
                ]
            ]
        ];
    }

    public function testMessageFiles()
    {
        $this->compareMessages(Yii::getAlias('@serviceadmin/messages'), 'de-CH');
    }
}