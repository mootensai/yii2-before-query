<?php

namespace mootensai\beforequery\traits;

trait SoftDeleteBoolTrait{
    public static $BEFORE_QUERY_SOFT_DELETE = ['isdelete' => 0];
    
    public function deleteSoft() {
        $this->{$this->BEFORE_QUERY_SOFT_DELETE} = 1;
        return $this->save(false,[$this->BEFORE_QUERY_SOFT_DELETE]);
    }
    
    public static function restore($id,$softDeleteColumn = 'deleted') {
        $model = parent::findOne($id, 1);
        $model->{$softDeleteColumn} = 0;
        $model->save(false,[$softDeleteColumn]);
    }
}
