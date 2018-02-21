<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class have the behaviors method.
 * This method set det de values for created_by, created_at, updated_by, updated_at automatically
 * @author blonder413
 */

namespace backend\models;
use \yii\db\Expression;
use \yii\behaviors\BlameableBehavior;
use \yii\db\ActiveRecord;

use Yii;

class MyActiveRecord extends ActiveRecord {
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
}
