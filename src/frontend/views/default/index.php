<?php
/* @var $this yii\web\View */
// TODO: Translate everything
use luya\admin\filters\SmallCrop;

?>
<h1>Services</h1>
<div class="row">
    <?php foreach ($provider->models as $service): ?>
        <div class="col-4">
            <div class="card">
                <?php if ($service->getImage() !== false): ?>
                    <img src="<?= $service->getImage()->applyFilter(SmallCrop::identifier())->source; ?>" class="card-img-top" />
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $service->title ?>
                    </h5>
                    <p class="card-text"><?= $service->teaser_text ?></p>
                    <a href="<?= $service->getDetailUrl() ?>" class="btn btn-primary"><?= $service->title ?></a>
                </div>
                <?php
                $cheapestOffer = $service->getCheapestOffer();
                if ($cheapestOffer !== false): ?>
                    <div class="card-footer">
                        <small class="text-muted">
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
                        </small>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php // Todo: Add Json-Ld-Markup ?>
    <?php endforeach; ?>
</div>