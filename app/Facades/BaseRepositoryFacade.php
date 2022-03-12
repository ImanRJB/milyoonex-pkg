<?php

namespace Milyoonex\Facades;

/**
 * @class \Milyoonex\Facades\BaseRepositoryFacade
 *
 * @method static module($module = null)
 * @method static getRecord($model, $query, $selection = [], $relations = [])
 * @method static getRecords($model, $query = [], $selection = [], $relations = [])
 * @method static getPaginate($model, $query = [], $selection = [], $relations = [],$paginate=0)
 * @method static storeRecord($model, $data)
 * @method static storeRelationRecord($relation, $data)
 * @method static forceStoreRelationRecord($relation, $data)
 * @method static updateRecord(\Illuminate\Database\Eloquent\Model $object, $data)
 * @method static forceStoreRecord($model, $data)
 * @method static forceUpdateRecord(\Illuminate\Database\Eloquent\Model $object, $data)
 * @method static deleteRecord(\Illuminate\Database\Eloquent\Model $object)
 * @method static deleteRecords($model, $data)
 * @method static forceDeleteRecord(\Illuminate\Database\Eloquent\Model $object)
 * @method static forceDeleteRecords($model, $data)
 * @method static restoreRecord(\Illuminate\Database\Eloquent\Model $object)
 * @method static restoreRecords($model, $data)
 *
 * @see \Milyoonex\Repositories\BaseRepository
 */

class BaseRepositoryFacade extends BaseFacade
{
    //
}