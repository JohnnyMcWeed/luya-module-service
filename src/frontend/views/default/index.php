<?php
/* @var $this yii\web\View */
// TODO: Translate everything
use app\modules\service\frontend\widgets\serviceswidget\ServicesWidget;
?>
<h1>Services</h1>

<?php foreach ($provider->models as $service): ?>
    <div class="row">
        <div class="col-sm-4">
            <?php if ($service->getImage() !== false): ?>
                <img src="<?= $service->getImage()->applyFilter(\luya\admin\filters\MediumCrop::identifier())->source; ?>" class="img-responsive" />
            <?php endif; ?>
        </div>
        <div class="col-sm-8">
            <h1><?= $service->title ?></h1>
            <?= $service->teaser_text ?>
            <?php
            $cheapestOffer = $service->getCheapestOffer();
            if ($cheapestOffer !== [] && $cheapestOffer['price'] !== null): ?>
            <div class="prices">
                Price starting from:
                <?php
                if ($cheapestOffer['is_discount'] &&
                    $cheapestOffer['discount_from'] < time() &&
                    $cheapestOffer['discount_until'] > time() &&
                    $cheapestOffer['price'] > $cheapestOffer['discount_price']) {
                    echo $cheapestOffer['discount_price'];
                } else {
                    echo $cheapestOffer['price'];
                } ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
