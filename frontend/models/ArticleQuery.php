<?php
namespace frontend\models;

use yii\db\ActiveQuery;

class ArticleQuery extends ActiveQuery
{
    // conditions appended by default (can be skipped)
    public function init()
    {
        $this->andOnCondition(['status' => true]);
        parent::init();
    }

    // ... add customized query methods here ...
/*
    public function active($status = true)
    {
        return $this->andOnCondition(['status' => $status]);
    }
*/
}
