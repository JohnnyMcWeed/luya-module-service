<?php
/* @var $this yii\web\View */
use johnnymcweed\service\frontend\assets\ServiceAsset;

ServiceAsset::register($this);
?>
<div class="col-sm-9">
    <h1><?= $model->title ?></h1>
    <?= $model->text ?>
    <?php $offers = $model->getOfferItems()->all();
    if ($offers !== []): ?>
        <div class="row">
            <div class="col-xs-12">
                <h3>Offers</h3>
            </div>
            <?php foreach ($offers as $offer): ?>
                <div class="col-sm-3">
                    <?= $offer->title ?><br/>
                    <?php
                    if ($offer->is_discount &&
                        $offer->discount_from < time() &&
                        $offer->discount_until > time() &&
                        $offer->price > $offer->discount_price) {
                        echo $offer->discount_price;
                    } else {
                        echo $offer->price;
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif;
    $bundles = $model->getOfferBundles()->all();
    if ($bundles !== []): ?>
        <div class="row">
            <div class="col-xs-12">
                <h3>Offer Bundles:</h3>
            </div>
            <?php foreach ($bundles as $bundle): ?>
                <div class="col-sm-3">
                    <?= $bundle->title ?><br/>
                    <?php
                    if ($bundle->is_discount &&
                        $bundle->discount_from < time() &&
                        $bundle->discount_until > time() &&
                        $bundle->price > $bundle->discount_price) {
                        echo $bundle->discount_price;
                    } else {
                        echo $bundle->price;
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<div class="col-sm-3">
    <?php
    $mainImage = $model->getImage();
    if ($mainImage !== false): ?>
        <img src="<?= $mainImage->source ?>" class="img-responsive">
    <?php endif; ?>
    <?php $similars = $model->getIsSimilarTo()->all();
    if ($similars !== []): ?>
        <div class="similarServices">
            <h4>Similar Services:</h4>
            <ul class="list-group">
                <?php foreach ($similars as $similarService): ?>
                    <li><a href="" class="list-group-item list-group-item-action"><?= $similarService->title ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif;
    $relateds = $model->getIsRelatedTo()->all();
    if ($relateds !== []): ?>
        <div class="relatedServices">
            <h4>Related Services:</h4>
            <ul class="list-group">
                <?php foreach ($relateds as $relatedService): ?>
                    <li><a href="" class="list-group-item list-group-item-action"><?= $relatedService->title ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
