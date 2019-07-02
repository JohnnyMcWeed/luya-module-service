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
        $this->addColumn('service_offer_item', 'benefits', $this->string());
        $this->addColumn('service_offer_bundle', 'benefits', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('service_offer_bundle', 'benefits');
        $this->dropColumn('service_offer_item', 'benefits');
    }
}
