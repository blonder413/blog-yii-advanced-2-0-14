<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rss_feed".
 *
 * @property integer $id
 * @property string $feed_id
 * @property string $title
 * @property string $description
 * @property string $link
 * @property string $content
 * @property string $author
 * @property string $pubDate
 */
class RssFeed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rss_feed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feed_id', 'title', 'description', 'link', 'content', 'author', 'pubDate'], 'required'],
            [['description', 'content'], 'string'],
            [['feed_id', 'title', 'link', 'author', 'pubDate'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'feed_id' => 'Feed ID',
            'title' => 'Title',
            'description' => 'Description',
            'link' => 'Link',
            'content' => 'Content',
            'author' => 'Author',
            'pubDate' => 'Pub Date',
        ];
    }
}
