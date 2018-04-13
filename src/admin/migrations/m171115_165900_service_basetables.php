<?php

use yii\db\Migration;

class m171115_165900_service_basetables extends Migration
{
    public function safeUp()
    {
        $this->createTable('service_service', [
            'id' => $this->primaryKey(),
            'title' => $this->text()->notNull(),
            'text' => $this->text(),
            'teaser_text' => $this->text(),
            'parent_id' => $this->integer(11)->defaultValue(0),

            'slug' => $this->string(),
            'seo_title' => $this->string(),
            'seo_description' => $this->string(),

            'logo_id' => $this->integer(11)->defaultValue(0),
            'image_id' => $this->integer(11)->defaultValue(0),
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

        $this->createTable('service_is_similar_to', [
            'service_id' => $this->integer(),
            'similar_service_id' => $this->integer(),
        ]);
        $this->addPrimaryKey('pk_service_isSimilarTo', 'service_is_similar_to', ['service_id', 'similar_service_id']);


        $this->createTable('service_offer_item', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),

            'price' => $this->float(),
            'discount_price' => $this->float(),
            'discount_from' => $this->integer(11)->defaultValue(0),
            'discount_until' => $this->integer(11)->defaultValue(0),
            'is_discount' => $this->boolean()->defaultValue(false),

            'create_user_id' => $this->integer(11)->defaultValue(0),
            'update_user_id' => $this->integer(11)->defaultValue(0),

            'timestamp_create' => $this->integer(11)->defaultValue(0),
            'timestamp_update' => $this->integer(11)->defaultValue(0),
            'timestamp_display_from' => $this->integer(11)->defaultValue(0),
            'timestamp_display_until' => $this->integer(11)->defaultValue(0),

            'is_deleted' => $this->boolean()->defaultValue(false),
            'is_display_limit' => $this->boolean()->defaultValue(false),
        ]);

        $this->createTable('service_offer_bundle', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),

            'price' => $this->float(),
            'discount_price' => $this->float(),
            'discount_from' => $this->integer(11)->defaultValue(0),
            'discount_until' => $this->integer(11)->defaultValue(0),
            'is_discount' => $this->boolean()->defaultValue(false),

            'create_user_id' => $this->integer(11)->defaultValue(0),
            'update_user_id' => $this->integer(11)->defaultValue(0),

            'timestamp_create' => $this->integer(11)->defaultValue(0),
            'timestamp_update' => $this->integer(11)->defaultValue(0),
            'timestamp_display_from' => $this->integer(11)->defaultValue(0),
            'timestamp_display_until' => $this->integer(11)->defaultValue(0),

            'is_deleted' => $this->boolean()->defaultValue(false),
            'is_display_limit' => $this->boolean()->defaultValue(false),
        ]);

        $this->createTable('service_offer_bundle_offer_item', [
            'offerBundle_id' => $this->integer(),
            'offerItem_id' => $this->integer(),
            'amount' => $this->float(),
        ]);
        $this->addPrimaryKey('pk_service_offerBundle_offerItem', 'service_offer_bundle_offer_item', ['offerBundle_id', 'offerItem_id']);

        $this->createTable('service_offer_item_service', [
            'service_id' => $this->integer(),
            'offeritem_id' => $this->integer()
        ]);
        $this->addPrimaryKey('pk_service_offer_item_service', 'service_offer_item_service', ['service_id', 'offeritem_id']);

        $this->createTable('service_offer_bundle_service', [
            'service_id' => $this->integer(),
            'offerbundle_id' => $this->integer()
        ]);
        $this->addPrimaryKey('pk_service_offer_bundle_service', 'service_offer_bundle_service', ['service_id', 'offerbundle_id']);
    }

    public function safeDown()
    {
        $this->dropTable('service_offer_bundle_service');
        $this->dropTable('service_offer_item_service');
        $this->dropTable('service_offer_bundle_offer_item');
        $this->dropTable('service_offer_bundle');
        $this->dropTable('service_offer_item');

        $this->dropTable('service_is_similar_to');
        $this->dropTable('service_is_related_to');
        $this->dropTable('service_service');
    }
}
