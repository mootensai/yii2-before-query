<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SoftDeleteBoolTrait
 *
 * @author Yohanes
 */
namespace common\traits;
trait SoftDeleteDateTimeTrait{
    public function deleteSoft($softDeleteColumn = 'deleted'){
        $this->{$softDeleteColumn} = \yii\db\Expression('NOW()');
        return $this->save(false,[$softDeleteColumn]);
    }
    public static function findUndeleted($softDeleteColumn = 'deleted'){
        return parent::find()->andFilterWhere([$softDeleteColumn => 0]);
    }
    public static function findAllUndeleted($condition,$softDeleteColumn = 'deleted') {
        return parent::findAll($condition)->andFilterWhere([$softDeleteColumn => 0]);
    }
    protected static function findByConditionUndeleted($condition, $softDeleteColumn = 'deleted') {
        return parent::findByCondition($condition)->andFilterWhere([$softDeleteColumn => 0]);
    }
    public static function findBySqlUndeleted($sql, $params = array(), $softDeleteColumn = 'deleted') {
        return parent::findBySql($sql, $params)->andFilterWhere([$softDeleteColumn => 0]);
    }
    public static function findOneUndeleted($condition, $softDeleteColumn = 'deleted') {
        return parent::findOne($condition)->andFilterWhere([$softDeleteColumn => 0]);
    }
    public static function restore($id, $softDeleteColumn = 'deleted'){
        $model = parent::findOne($id);
        $model->{$softDeleteColumn} = 0;
        return $model->save(false, [$softDeleteColumn]);
    }
}
