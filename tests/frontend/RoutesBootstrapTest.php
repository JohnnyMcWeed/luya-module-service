<?php

namespace johnnymcweed\service\tests\frontend;

use johnnymcweed\service\frontend\RoutesBootstrap;

/**
 *
 *
 * @author    Alexander Schmid <schmid@netfant.ch>
 * @copyright 2019 NetFant Schmid
 * @version   1.0.0
 * @since     1.0.0
 */
class RoutesBootstrapTest extends \luya\testsuite\cases\WebApplicationTestCase
{
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

    public function testPrepareRulesWithEmptyArray()
    {
        $this->assertEmpty(RoutesBootstrap::prepareRules([]));
    }

    public function testPrepareRulesWithOnlyRoot()
    {
        $arr = [
            [
                'id' => 1,
                'title' => '{"en":"Service"}',
                'tree' => null,
                'lft' => 1,
                'rgt' => 2,
                'depth' => 0,
                'slug' => '{"en":"service"}'
            ]
        ];
        $sub = [
            [
                'pattern' => 'service',
                'route' => 'service/default/service',
                'defaults' => ['id' => 1]
            ]
        ];
        $this->assertArraySubset($sub, RoutesBootstrap::prepareRules($arr));

    }

    public function testPrepareRulesWithChilds()
    {
        $arr = [
            [
                'id' => 1,
                'title' => '{"en":"Service"}',
                'tree' => null,
                'lft' => 1,
                'rgt' => 4,
                'depth' => 0,
                'slug' => '{"en":"service"}'
            ],
            [
                'id' => 2,
                'title' => '{"en":"Service 2"}',
                'tree' => null,
                'lft' => 2,
                'rgt' => 3,
                'depth' => 1,
                'slug' => '{"en":"service-2"}'
            ]
        ];
        $sub = [
            [
                'pattern' => 'service',
                'route' => 'service/default/service',
                'defaults' => ['id' => 1]
            ],
            [
                'pattern' => 'service/service-2',
                'route' => 'service/default/service',
                'defaults' => ['id' => 2]
            ]
        ];
        $this->assertArraySubset($sub, RoutesBootstrap::prepareRules($arr));
    }

    public function testPrepareRulesWithMultipleChilds()
    {
        $arr = [
            [
                'id' => 1,
                'title' => '{"en":"Service"}',
                'tree' => null,
                'lft' => 1,
                'rgt' => 12,
                'depth' => 0,
                'slug' => '{"en":"service"}'
            ],
            [
                'id' => 2,
                'title' => '{"en":"Service 2"}',
                'tree' => null,
                'lft' => 2,
                'rgt' => 5,
                'depth' => 1,
                'slug' => '{"en":"service-2"}'
            ],
            [
                'id' => 3,
                'title' => '{"en":"Service 3"}',
                'tree' => null,
                'lft' => 3,
                'rgt' => 4,
                'depth' => 2,
                'slug' => '{"en":"service-3"}'
            ],
            [
                'id' => 4,
                'title' => '{"en":"Service 4"}',
                'tree' => null,
                'lft' => 6,
                'rgt' => 11,
                'depth' => 1,
                'slug' => '{"en":"service-4"}'
            ],
            [
                'id' => 5,
                'title' => '{"en":"Service 5"}',
                'tree' => null,
                'lft' => 7,
                'rgt' => 10,
                'depth' => 2,
                'slug' => '{"en":"service-5"}'
            ],
            [
                'id' => 6,
                'title' => '{"en":"Service 6"}',
                'tree' => null,
                'lft' => 8,
                'rgt' => 9,
                'depth' => 3,
                'slug' => '{"en":"service-6"}'
            ]
        ];
        $sub = [
            [
                'pattern' => 'service',
                'route' => 'service/default/service',
                'defaults' => ['id' => 1]
            ],
            [
                'pattern' => 'service/service-2',
                'route' => 'service/default/service',
                'defaults' => ['id' => 2]
            ],
            [
                'pattern' => 'service/service-2/service-3',
                'route' => 'service/default/service',
                'defaults' => ['id' => 3]
            ],
            [
                'pattern' => 'service/service-4',
                'route' => 'service/default/service',
                'defaults' => ['id' => 4]
            ],
            [
                'pattern' => 'service/service-4/service-5',
                'route' => 'service/default/service',
                'defaults' => ['id' => 5]
            ],
            [
                'pattern' => 'service/service-4/service-5/service-6',
                'route' => 'service/default/service',
                'defaults' => ['id' => 6]
            ]
        ];
        $this->assertArraySubset($sub, RoutesBootstrap::prepareRules($arr));
    }
}