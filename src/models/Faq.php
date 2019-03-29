<?php
namespace johnnymcweed\service\models;

use johnnymcweed\service\admin\Module;
use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Faq.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property text $question
 * @property text $answer
 * @property tinyint $featured
 */
class Faq extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['question', 'answer'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_faq';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-service-faq';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'question' => Module::t('Question'),
            'answer' => Module::t('Answer'),
            'featured' => Module::t('Featured'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'answer'], 'required'],
            [['question', 'answer'], 'string'],
            [['featured'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['question', 'answer'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'question' => 'text',
            'answer' => 'textarea',
            'featured' => 'toggleStatus',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['question', 'featured']],
            [['create', 'update'], ['question', 'answer', 'featured']],
            ['delete', true],
        ];
    }
}