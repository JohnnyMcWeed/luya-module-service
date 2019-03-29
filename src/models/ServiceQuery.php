<?php
namespace johnnymcweed\service\models;

use luya\admin\ngrest\base\NgRestActiveQuery;
use creocoder\nestedsets\NestedSetsQueryBehavior;

/**
 *
 *
 * @author Alexander Schmid <schmid@netfant.ch>
 * @since  1.0.0
 */
class ServiceQuery extends NgRestActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::class,
        ];
    }
}