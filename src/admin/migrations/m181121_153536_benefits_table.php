<?php

use yii\db\Migration;

/**
 * Class m181121_153536_benefits_table
 */
class m181121_153536_benefits_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('service_benefit', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'teaser' => $this->string(),
            'image_id' => $this->integer(11)->defaultValue(0),
        ]);

        $this->createTable('service_servicebenefit', [
            'service_id' => $this->integer(),
            'benefit_id' => $this->integer(),
        ]);

        $this->addPrimaryKey('pk_servicebenefit', 'service_servicebenefit', ['service_id', 'benefit_id']);
        $this->addForeignKey('fk_servicebenefit_service', 'service_servicebenefit', 'service_id', 'service_service', 'id');
        $this->addForeignKey('fk_servicebenefit_benefit', 'service_servicebenefit', 'benefit_id', 'service_benefit', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_servicebenefit', 'service_servicebenefit');
        $this->dropForeignKey('fk_servicebenefit', 'service_servicebenefit');
        $this->dropTable('service_servicebenefit');
        $this->dropTable('service_benefit');
    }
}
