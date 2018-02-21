<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "streamings".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $embed
 * @property string $start
 * @property string $end
 * @property int $created_by
 * @property string $created_at
 * @property int $updated_by
 * @property string $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Streaming extends MyActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'streamings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'start', 'end'], 'required'],
            [['description'], 'string'],
            [['start', 'end', 'created_at', 'updated_at'], 'safe'],
            [
              ['start'], 'compare', 'compareAttribute' => 'end', 'operator' => '<',
              //'when' => function($model){
              //  return $this->start < $this->end;
              //},
              //'whenClient'  => "function (attribute, value) {
              //  return $('#streaming-start').val() < $('#streaming-end').val();
              //}"
            ],
            [['created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['embed'], 'string', 'max' => 255],
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
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'embed' => Yii::t('app', 'Embed'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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
}
