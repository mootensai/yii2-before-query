<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace common\traits\base;
trait BeforeQueryTrait{
    use \yii\db\ActiveRelationTrait;

    public static function find() {
        $class = new \ReflectionClass(new static);
        $condition = [];
        $obj = new static;
        foreach ($class->getProperties() as $property) {
            if(strpos($property->getName(),'BEFORE_QUERY') !== false && is_array($property->getValue($obj)) && $property->isStatic())
                $condition = array_merge($condition, $property->getValue($obj));
        }
        return parent::find()->andFilterWhere($condition);
    }
    
//    public static function findAll($condition) {
//        return static::findByCondition($condition)->all();
//    }
//    
//    protected static function findByCondition($condition){
//        $query = static::find();
//
//        if (!ArrayHelper::isAssociative($condition)) {
//            // query by primary key
//            $primaryKey = static::primaryKey();
//            if (isset($primaryKey[0])) {
//                $condition = [$primaryKey[0] => $condition];
//            } else {
//                throw new InvalidConfigException('"' . get_called_class() . '" must have a primary key.');
//            }
//        }
//
//        return $query->andWhere($condition);
//    }
//    
//    public static function findBySql($sql, $params = array()) {
//        
//        $query = static::find();
//        $query->sql = $sql;
//
//        return $query->params($params);
//    }
//    
//    public static function findOne($condition) {
//        return static::findByCondition($condition)->one();
//    }
}