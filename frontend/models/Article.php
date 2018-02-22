<?php

namespace frontend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property int $number
 * @property string $title
 * @property string $slug
 * @property string $topic
 * @property string $detail
 * @property string $abstract
 * @property string $video
 * @property int $type_id
 * @property string $download
 * @property int $category_id
 * @property string $tags
 * @property int $status
 * @property int $visit_counter
 * @property int $download_counter
 * @property int $course_id
 * @property int $created_by
 * @property string $created_at
 * @property int $updated_by
 * @property string $updated_at
 *
 * @property Categories $category
 * @property Courses $course
 * @property Types $type
 * @property User $createdBy
 * @property User $updatedBy
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'type_id', 'category_id', 'visit_counter', 'download_counter', 'course_id', 'created_by', 'updated_by'], 'integer'],
            [['title', 'slug', 'detail', 'abstract', 'type_id', 'category_id', 'tags', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['detail'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 150],
            [['topic', 'download'], 'string', 'max' => 100],
            [['abstract'], 'string', 'max' => 300],
            [['video', 'tags'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
            [['title'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Number'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'topic' => Yii::t('app', 'Topic'),
            'detail' => Yii::t('app', 'Detail'),
            'abstract' => Yii::t('app', 'Abstract'),
            'video' => Yii::t('app', 'Video'),
            'type_id' => Yii::t('app', 'Type ID'),
            'download' => Yii::t('app', 'Download'),
            'category_id' => Yii::t('app', 'Category ID'),
            'tags' => Yii::t('app', 'Tags'),
            'status' => Yii::t('app', 'Status'),
            'visit_counter' => Yii::t('app', 'Visit Counter'),
            'download_counter' => Yii::t('app', 'Download Counter'),
            'course_id' => Yii::t('app', 'Course ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentsCount()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id'])
                    ->where("status = " . Comment::STATUS_ACTIVE)
                    ->count();
    }
}
