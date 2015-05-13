<?php

namespace mootensai\beforequery\traits;

use yii\db\Expression;
trait SoftDeleteDateTimeTrait{
    public static $BEFORE_QUERY_SOFT_DELETE = ['isdelete' => 0];
    
    public function deleteSoft() {
        $this->{$this->BEFORE_QUERY_SOFT_DELETE} = new Expression('NOW()');
        return $this->save(false,[$this->BEFORE_QUERY_SOFT_DELETE]);
    }
    
    public static function restore($id,$softDeleteColumn = 'deleted') {
        $model = parent::findOne($id, 1);
        $model->{$softDeleteColumn} = new Expression('NULL');
        $model->save(false,[$softDeleteColumn]);
    }
}
