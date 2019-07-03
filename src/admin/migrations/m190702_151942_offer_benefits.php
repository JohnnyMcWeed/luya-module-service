<?php

use yii\db\Migration;

/**
 * Class m190702_151942_offer_benefits
 */
class m190702_151942_offer_benefits extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('service_offer_item', 'benefits', $this->text());
        $this->addColumn('service_offer_item', 'featured', $this->boolean());
        $this->addColumn('service_offer_bundle', 'benefits', $this->text());
        $this->addColumn('service_offer_bundle', 'featured', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('service_offer_bundle', 'featured');
        $this->dropColumn('service_offer_bundle', 'benefits');
        $this->dropColumn('service_offer_item', 'featured');
        $this->dropColumn('service_offer_item', 'benefits');
    }
}
