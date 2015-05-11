# yii2-before-query

Add before query event on Yii 2 models

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require mootensai/yii2-before-query
```

or add

```
"mootensai/yii2-before-query": "dev-master"
```

to the `require` section of your `composer.json` file.


1. Base Trait Before Query
------------------

```php
namespace common\traits\base;
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
```

2. Add new property on model
----------------------------------------------------------

Next, you can add new property on your model like this :

```php
class MyClass extends \yii\db\ActiveRecord{
    use \common\traits\base\BeforeQueryTrait;
    public static $BEFORE_QUERY = ['myColumn' => 'myValue'];
}
```

3. You can create a new trait.
------------------------------------------------------------------------


For example, i've created Soft Delete Boolean Trait :

```php
trait SoftDeleteBoolTrait{
    public static $BEFORE_QUERY_SOFT_DELETE = ['isdeleted' => 0];
    
    public function deleteSoft() {
        $col = key(static::$BEFORE_QUERY_SOFT_DELETE);
        $this->{$col} = 1;
        return $this->save(false,[$col]);
    }
    
    public static function restore($id) {
        $col = key(static::$BEFORE_QUERY_SOFT_DELETE);
        $model = parent::findOne($id, 1);
        $model->{$col} = 0;
        $model->save(false,[$col]);
    }
}
```

Use it on model : 



```php
class MyClass extends \yii\db\ActiveRecord{
    use \mootensai\beforequery\base\BeforeQueryTrait;
    use \mootensai\beforequery\traits\SoftDeleteBoolTrait;
}
```



Soli Deo Gloria
