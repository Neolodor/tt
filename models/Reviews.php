<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $book_id
 * @property string $body
 * @property string $author_name review author name
 * @property string $created
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'body', 'author_name'], 'required'],
            [['book_id'], 'integer'],
            [['body'], 'string'],
            [['body'], 'filter', 'filter' => function ($value) { return trim(htmlspecialchars($value)); }],
            [['created'], 'safe'],
            [['author_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'body' => 'Body',
            'author_name' => 'Author Name',
            'created' => 'Created',
        ];
    }
}
