<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $name
 * @property int $author_id
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author_id'], 'required'],
            [['author_id'], 'integer', 'min' => 0],
            [['name'], 'string', 'max' => 128],
            [['name'], 'filter', 'filter' => function ($value) {
                return mb_convert_case(
                    mb_strtolower(
                        trim(
                            htmlspecialchars($value))),
                    MB_CASE_TITLE);
            }]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author_id' => 'Author ID',
        ];
    }
}
