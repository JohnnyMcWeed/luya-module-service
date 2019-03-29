<?php

use yii\db\Migration;

/**
 * Class m190106_130746_base_service_faq_and_stories_tables
 */
class m190106_130746_base_service_faq_and_stories_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('service_faq', [
            'id' => $this->primaryKey(),
            'question' => $this->string()->notNull(),
            'answer' => $this->text()->notNull(),
            'featured' => $this->boolean(),
        ]);
        $this->createTable('service_servicefaq', [
            'service_id' => $this->integer()->notNull(),
            'faq_id' => $this->integer()->notNull(),
        ]);
        $this->createTable('service_story', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'story' => $this->text()->notNull()
        ]);
        $this->createTable('service_serviceStory', [
            'service_id' => $this->integer()->notNull(),
            'story_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('service_serviceStory');
        $this->dropTable('service_story');
        $this->dropTable('service_servicefaq');
        $this->dropTable('service_faq');
    }
}
