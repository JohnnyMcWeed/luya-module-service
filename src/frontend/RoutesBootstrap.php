<?php
namespace johnnymcweed\service\frontend;

use johnnymcweed\service\models\Service;
use luya\helpers\Json;
use yii\base\BootstrapInterface;
use yii\data\Sort;

/**
 * Service Bootstrap
 *
 * @author    Alexander Schmid <alex.schmid@stud.unibas.ch>
 * @version   1.0.0
 * @since     1.0.0
 */
class RoutesBootstrap implements BootstrapInterface
{
    public $rulePrefix = 'services';

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        if ($app->hasModule('service')) {
            $app->on($app::EVENT_BEFORE_REQUEST, function ($event) {
                if (!$event->sender->request->isConsoleRequest && !$event->sender->request->isAdmin) {
                    $services = Service::find()->addOrderBy(['rgt' => SORT_DESC])->asArray()->all();
                    $event->sender->urlManager->addRules(RoutesBootstrap::prepareRules($services, $this->rulePrefix));
                }
            });
        }
    }

    /**
     * Method to prepare the rules
     *
     * @param $serviceArray An array of service items
     * @param null $prefix The prefix for the rule
     *
     * @return array The routes array for the config
     */
    public static function prepareRules($serviceArray, $prefix = null)
    {
        $endServiceArray = [];
        if (!empty($serviceArray)) {
            if (!empty($serviceArray[0]['depth']) ||
                isset($serviceArray[0]['depth']) && (int) $serviceArray[0]['depth'] === 0 ) {
                $startLevel = (int) $serviceArray[0]['depth'];
                $helperPrefix = '';
                $helperArr = [];
                $pattern = '';
                foreach ($serviceArray as $serv) {
                    if ((int) $serv['depth'] > $startLevel) {
                        $helperArr[] = $serv;
                    } elseif ((int) $serv['depth'] === $startLevel) {
                        if (!empty($helperArr)) {
                            $endServiceArray = array_merge($endServiceArray, RoutesBootstrap::prepareRules($helperArr, $helperPrefix));
                            $helperPrefix = '';
                            $helperArr = [];
                        }
                        $langSlug = Json::decode($serv['slug'])[\Yii::$app->composition->getLangShortCode()];
                        $pattern = (empty($prefix)) ? $langSlug : $prefix . '/' . $langSlug;
                        $helperPrefix = $pattern;
                        $endServiceArray[] = [
                            'pattern' => $pattern,
                            'route' => 'service/default/service',
                            'defaults' => [
                                'id' => $serv['id']
                            ],
                        ];
                    }
                }
                if (!empty($helperArr)) {
                    $endServiceArray = array_merge($endServiceArray, RoutesBootstrap::prepareRules($helperArr, $pattern));
                }
            };
        }
        return $endServiceArray;
    }
}