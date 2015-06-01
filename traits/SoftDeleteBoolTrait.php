<?php
/**
 * SoftDeleteBoolTrait
 * Flag the deleted row with 1(true).
 * Search the deleted column with 0.
 * The deleted column must 'deleted', 
 * if you want to change this, change the property & default argument for $softDeleteColumn to your need
 *
 * @author Yohanes Candrajaya <moo.tensai@gmail.com>
 * @since 1.0
 */
namespace mootensai\beforequery\traits;

trait SoftDeleteBoolTrait{
    public static $BEFORE_QUERY_SOFT_DELETE = ['deleted' => 0];
    
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
