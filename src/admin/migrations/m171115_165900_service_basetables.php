<?php

use yii\db\Migration;

class m171115_165900_service_basetables extends Migration
{
    public function safeUp()
    {
        $this->createTable('service_service', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'teaser_text' => $this->text(),

            'intro' => $this->string(),
            'intro_button' => $this->string(),
            'intro_button_link' => $this->string(),
            'intro_image' => $this->integer(11)->defaultValue(0),

            'text' => $this->text(),

            'slug' => $this->string(),
            'seo_title' => $this->string(),
            'seo_description' => $this->string(),

            'image_list' => $this->text(),
            'file_list' => $this->text(),

            'create_user_id' => $this->integer(11)->defaultValue(0),
            'update_user_id' => $this->integer(11)->defaultValue(0),
            'timestamp_create' => $this->integer(11)->defaultValue(0),
            'timestamp_update' => $this->integer(11)->defaultValue(0),
            'timestamp_display_from' => $this->integer(11)->defaultValue(0),
            'timestamp_display_until' => $this->integer(11)->defaultValue(0),
            'is_deleted' => $this->boolean()->defaultValue(false),
            'is_display_limit' => $this->boolean()->defaultValue(false),
        ]);


        $this->createTable('service_is_related_to', [
            'service_id' => $this->integer(),
            'relation_service_id' => $this->integer(),
        ]);
        $this->addPrimaryKey('pk_service_isRelatedTo', 'service_is_related_to', ['service_id', 'relation_service_id']);
        $this->addForeignKey('fk_isRelatedTo_service', 'service_is_related_to', 'service_id', 'service_service', 'id');
        $this->addForeignKey('fk_isRelatedTo_relationService', 'service_is_related_to', 'relation_service_id', 'service_service', 'id');


        $this->createTable('service_is_similar_to', [
            'service_id' => $this->integer(),
            'similar_service_id' => $this->integer(),
        ]);
        $this->addPrimaryKey('pk_service_isSimilarTo', 'service_is_similar_to', ['service_id', 'similar_service_id']);
        $this->addForeignKey('fk_isRelatedTo_service', 'service_is_similar_to', 'service_id', 'service_service', 'id');
        $this->addForeignKey('fk_isRelatedTo_relationService', 'service_is_similar_to', 'similar_service_id', 'service_service', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('service_is_similar_to');
        $this->dropTable('service_is_related_to');
        $this->dropTable('service_service');
    }
}
