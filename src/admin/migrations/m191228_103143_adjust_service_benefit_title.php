<?php

use yii\db\Migration;

/**
 * Class m191228_103143_adjust_service_benefit_title
 */
class m191228_103143_adjust_service_benefit_title extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('service_benefit', 'title', $this->text());
        $this->alterColumn('service_benefit', 'teaser', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191228_103143_adjust_service_benefit_title cannot be reverted.\n";

        return false;
    }
    */
}
