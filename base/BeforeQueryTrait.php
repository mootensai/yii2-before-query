<?php

namespace mootensai\yii2-before-query\base;
trait BeforeQueryTrait{

    public static function find() {
        $obj = new static;
        $class = new \ReflectionClass($obj);
        $condition = [];
        foreach ($class->getProperties(\ReflectionProperty::IS_STATIC) as $property) {
            if(strpos($property->getName(),'BEFORE_QUERY') !== false && is_array($property->getValue($obj))){
                $condition = array_merge($condition, $property->getValue($obj));
            }
        }
        return parent::find()->andFilterWhere($condition);
    }
}
