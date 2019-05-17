<?php
/**
 * View file for block: TeaserBlock 
 *
 * File has been created with `block/create` command. 
 *
 *
 * @var $this \luya\cms\base\PhpBlockView
 */

use johnnymcweed\service\admin\Module;
use johnnymcweed\service\models\Service;

$service = $this->extraValue('service');
if (!empty($service)):
?>
<div class="row">
    <?php if (!empty($service->teaser_image) && !empty($serviceImg = Yii::$app->storage->getImage($service->teaser_image->itemArray['id']))): ?>
        <div class="col-12">
            <img src="<?= $serviceImg->source ?>" class="img-fluid w-100 mb-2" alt="<?= $service->seo_title ?>">
        </div>
    <?php endif; ?>
    <div class="col-12">
        <h3><?= $service->seo_title ?></h3>
    </div>
    <div class="col-12">
        <p><?= $service->teaser_text ?></p>
    </div>
    <div class="col-12">
        <a class="nf-link" href="<?= $service->getServiceUrl() ?>" title="<?= $service->seo_title . ': ' . Module::t('Schnell & Professionell') ?>"><?= $service->title ?></a>
    </div>
</div>
<?php
endif;