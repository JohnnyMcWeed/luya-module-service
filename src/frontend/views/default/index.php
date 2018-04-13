<?php
/* @var $this yii\web\View */
// TODO: Translate everything
use app\modules\service\frontend\widgets\serviceswidget\ServicesWidget;
?>
<h1>Services</h1>

<?php foreach ($provider as $service): ?>
    <div class="">
        <h1><?= $service->title ?></h1>
        <?= $service->description ?>
    </div>
    <div class="">
        <?php if ($service->isSimilarTo !== []): ?>
            <h4>Similar Services</h4>
            <ul>
                <?php foreach ($service->isSimilarTo as $similarService): ?>
                    <li>
                        <img />
                        <h5><?= $relatedService->title ?></h5>
                        <p><?= $relatedService->teaser_text ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php if ($service->isRelatedTo !== []): ?>
            <h4>Similar Services</h4>
            <ul>
                <?php foreach ($service->isRelatedTo as $relatedService): ?>
                    <li>
                        <img />
                        <h5><?= $relatedService->title ?></h5>
                        <p><?= $relatedService->teaser_text ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

<?php endforeach; ?>
