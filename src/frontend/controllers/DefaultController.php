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
     * @see \luya\cms\frontend\base\Controller
     * @var string
     */
    const LINK_CANONICAL = 'linkCanonical';

    /**
     * @see \luya\cms\frontend\base\Controller
     * @var string og:type key which is used for meta registration. Use this constant in order to override the default implementation.
     */
    const META_OG_TYPE = 'ogType';

    /**
     * @see \luya\cms\frontend\base\Controller
     * @var string og:title key which is used for meta registration. Use this constant in order to override the default implementation.
     */
    const META_OG_TITLE = 'ogTitle';

    /**
     * @see \luya\cms\frontend\base\Controller
     * @var string description meta key which is used for meta registration. Use this constant in order to override the default implementation.
     */
    const META_DESCRIPTION = 'metaDescription';

    /**
     * @see \luya\cms\frontend\base\Controller
     * @var string og:description key which is used for meta registration. Use this constant in order to override the default implementation.
     */
    const META_OG_DESCRIPTION = 'ogDescription';

    /**
     * @see \luya\cms\frontend\base\Controller
     * @var string og:url key which is used for meta registration. Use this constant in order to override the default implementation.
     */
    const META_OG_URL = 'ogUrl';

    /**
     * @todo
     */
    public function actionService($id = null)
    {
        if (!empty($service = Service::findOne(['id' => $id]))) {
            $this->view->title = !empty($service->seo_title) ? $service->seo_title : $service->title;
            $this->view->registerMetaTag(['name' => 'og:title', 'content' => $this->view->title], self::META_OG_TITLE);
            $this->view->registerMetaTag(['name' => 'og:type', 'content' => 'website']);
            $this->view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary']);
            if (!empty($service->seo_description)) {
                $this->view->registerMetaTag(['name' => 'description', 'content' => $service->seo_description]);
                $this->view->registerMetaTag(['name' => 'og:description', 'content' => $service->seo_description], self::META_OG_DESCRIPTION);
            }
            $this->view->registerLinkTag(['rel' => 'canonical', 'href' => Yii::$app->request->absoluteUrl], self::LINK_CANONICAL);
            $this->view->registerMetaTag(['name' => 'og:url', 'content' => Yii::$app->request->absoluteUrl], self::META_OG_URL);
            return $this->render('service', [
                'service' => $service
            ]);
        }
        return false;
    }

    /**
     * @todo
     */
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
