<?php

use yii\db\Migration;

class m171115_165901_service_offers extends Migration
{
    public function safeUp()
    {
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
    }
}
