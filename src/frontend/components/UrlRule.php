<?php
namespace johnnymcweed\service\frontend\components;

use Yii;
use johnnymcweed\service\models\Service;
use yii\data\Sort;

/**
 *
 *
 * @author    Alexander Schmid <schmid@netfant.ch>
 * @copyright 2019 NetFant Schmid
 * @version   1.0.0
 * @since     1.0.0
 */
class UrlRule extends \luya\web\UrlRule
{
//    const ROUTE_SERVICE = 'service/default/service';
//    const ROUTE_ROOTS = 'service/default/roots';
//
//    /**
//     * @inheritDoc
//     */
//    public function parseRequest($manager, $request)
//    {
//        if ($this->mode === self::CREATION_ONLY) {
//            return false;
//        }
//
//        if (!empty($this->verb) && !in_array($request->getMethod(), $this->verb, true)) {
//            return false;
//        }
//
//        $suffix = (string) ($this->suffix === null ? $manager->suffix : $this->suffix);
//        $pathInfo = $request->getPathInfo();
//        $normalized = false;
//        if ($this->hasNormalizer($manager)) {
//            $pathInfo = $this->getNormalizer($manager)->normalizePathInfo($pathInfo, $suffix, $normalized);
//        }
//        if ($suffix !== '' && $pathInfo !== '') {
//            $n = strlen($suffix);
//            if (substr_compare($pathInfo, $suffix, -$n, $n) === 0) {
//                $pathInfo = substr($pathInfo, 0, -$n);
//                if ($pathInfo === '') {
//                    // suffix alone is not allowed
//                    return false;
//                }
//            } else {
//                return false;
//            }
//        }
//
//        if ($this->host !== null) {
//            $pathInfo = strtolower($request->getHostInfo()) . ($pathInfo === '' ? '' : '/' . $pathInfo);
//        }
//
//        $slugs = explode('/', $pathInfo);
//
//        var_dump($slugs); exit;
//
//        if (!empty($slugs) && !empty($slugs[0])) {
//            $services = Service::find()->where(['like', 'slug', $slugs[count($slugs)-1]])->all();
//            if (!empty($services)) {
//                if (count($services) !== 1) {
//                    foreach ($services as $service) {
//                        if (self::checkService($service, $slugs)) {
//                            $route = self::ROUTE_SERVICE;
//                            $params = [
//                                'id' => $service->id
//                            ];
//                            break;
//                        }
//                    }
//                } else {
//                    if (!empty($this->checkService($services[0], $slugs))) {
//                        $route = self::ROUTE_SERVICE;
//                        $params = [
//                            'id' => $services[0]->id
//                        ];
//                    } else
//                        return false;
//                }
//            } else {
//                return false;
//            }
//        } else {
//            if (true) { // Todo: Check
//                $services = Service::find()->roots()->all();
//                $nrServ = count($services);
//                if ($nrServ == 0) {
//                    // Todo: Redirect to 404 Page
//                    return false;
//
//                } else if ($nrServ == 1) {
//                    $route = self::ROUTE_SERVICE;
//                    $params = [
//                        'id' => $services[0]->id
//                    ];
//                } else {
//                    $route = 'service/default/roots';
//                    $params = [];
//                }
//            } else {
//                return false;
//            }
//        }
//
//        if (empty($route)) {
//            return false;
//        }
//
//        Yii::debug("Request parsed with URL rule: {$this->name}", __METHOD__);
//
//        if ($normalized) {
//            // pathInfo was changed by normalizer - we need also normalize route
//            return $this->getNormalizer($manager)->normalizeRoute([$route, $params]);
//        }
//
//        return [$route, $params];
//    }
//
//    /**
//     * @inheritDoc
//     */
//    public function createUrl($manager, $route, $params)
//    {
//        //print_r(parent::createUrl($manager, $route, $params));
//        if ($this->mode === self::PARSING_ONLY) {
//            $this->createStatus = self::CREATE_STATUS_PARSING_ONLY;
//            return false;
//        }
//        if ($route == self::ROUTE_SERVICE) {
//            if (!empty($params['id'])) {
//                if (!empty($service = Service::findOne(['id' => $params['id']]))) {
//                    $url = '';
//                    $parents = $service->parents()->orderBy([
//                        'rgt' => SORT_DESC,
//                    ])->all();
//                    foreach ($parents as $parent) {
//                        $url .= '/'.$parent->slug;
//                    }
//                } else {
//                    $this->createStatus = self::CREATE_STATUS_PARAMS_MISMATCH;
//                    return false;
//                }
//            } else {
//                // Todo Go to roots...
//            }
//            $url .= '/'.$service->slug;
//
//            if ($url !== '') {
//                $url .= ($this->suffix === null ? $manager->suffix : $this->suffix);
//            }
//            $this->createStatus = self::CREATE_STATUS_SUCCESS;
//            return $url;
//        }
//        return parent::createUrl($manager, $route, $params); // TODO: Change the autogenerated stub
//    }
//
//
//    /**
//     * @param $service
//     * @param $slugs
//     *
//     * @return bool
//     */
//    protected static function checkService($service, $slugs)
//    {
//        $parents = $service->parents()->all();
//        array_pop($slugs);
//        $i = 0;
//        if (count($slugs) === count($parents)) {
//            foreach ($slugs as $slug) {
//                if ($slug !== $parents[$i]->slug)
//                    return false;
//                $i++;
//            }
//            return true;
//        }
//        return false;
//    }
}