<?php

namespace Milyoonex\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected $modelNameSpace = null;

    abstract public function module($module = null);

    abstract public function getRecord($model, $query, $selection = ['*'], $relations = []);

    abstract public function getRecords($model, $query = [], $selection = ['*'], $relations = []);

    abstract public function getPaginate($model, $query = [], $selection = ['*'], $relations = [], $paginate = 10);

    abstract public function storeRecord($model, $data);

    abstract public function storeRelationRecord($relation, $data);

    abstract public function updateRecord(Model $object, $data);

    abstract public function forceStoreRecord($model, $data);

    abstract public function forceStoreRelationRecord($relation, $data);

    abstract public function forceUpdateRecord(Model $object, $data);

    abstract public function deleteRecord(Model $object);

    abstract public function deleteRecords($model, $data);

    abstract public function forceDeleteRecord(Model $object);

    abstract public function forceDeleteRecords($model, $data);

    abstract public function restoreRecord(Model $object);

    abstract public function restoreRecords($model, $data);
}
