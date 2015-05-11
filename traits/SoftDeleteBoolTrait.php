<?php

namespace mootensai\beforequery\traits;

trait SoftDeleteBoolTrait{
//    use base\BeforeQueryTrait;
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

    /**
     * Deletes the table row corresponding to this active record.
     *
     * This method performs the following steps in order:
     *
     * 1. call [[beforeDelete()]]. If the method returns false, it will skip the
     *    rest of the steps;
     * 2. delete the record from the database;
     * 3. call [[afterDelete()]].
     *
     * In the above step 1 and 3, events named [[EVENT_BEFORE_DELETE]] and [[EVENT_AFTER_DELETE]]
     * will be raised by the corresponding methods.
     *
     * @return integer|false the number of rows deleted, or false if the deletion is unsuccessful for some reason.
     * Note that it is possible the number of rows deleted is 0, even though the deletion execution is successful.
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Exception in case delete failed.
     */
//    public function delete()
//    {
//        if (!$this->isTransactional(self::OP_DELETE)) {
//            return $this->deleteInternal();
//        }
//
//        $transaction = static::getDb()->beginTransaction();
//        try {
//            $result = $this->deleteInternal();
//            if ($result === false) {
//                $transaction->rollBack();
//            } else {
//                $transaction->commit();
//            }
//            return $result;
//        } catch (\Exception $e) {
//            $transaction->rollBack();
//            throw $e;
//        }
//    }
    /**
     * Deletes an ActiveRecord without considering transaction.
     * @return integer|false the number of rows deleted, or false if the deletion is unsuccessful for some reason.
     * Note that it is possible the number of rows deleted is 0, even though the deletion execution is successful.
     * @throws StaleObjectException
     */
//    protected function deleteInternal()
//    {
//        if (!$this->beforeDelete()) {
//            return false;
//        }
//
//        // we do not check the return value of deleteAll() because it's possible
//        // the record is already deleted in the database and thus the method will return 0
//        $condition = $this->getOldPrimaryKey(true);
//        $lock = $this->optimisticLock();
//        if ($lock !== null) {
//            $condition[$lock] = $this->$lock;
//        }
//        $result = $this->deleteAll($condition);
//        if ($lock !== null && !$result) {
//            throw new StaleObjectException('The object being deleted is outdated.');
//        }
//        $this->setOldAttributes(null);
//        $this->afterDelete();
//
//        return $result;
//    }
}
