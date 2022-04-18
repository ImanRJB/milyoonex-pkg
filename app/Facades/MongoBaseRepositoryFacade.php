<?php

namespace Milyoonex\Facades;

/**
 * @class \Milyoonex\Facades\BaseRepositoryFacade
 *
 * @method static getRecord($model, $query, $selection = [], $relations = [])
 * @method static getRecords($model, $query = [], $selection = [], $relations = [])
 * @method static getPaginate($model, $query = [], $selection = [], $relations = [],$paginate=0)
 * @method static storeRecord($model, $data)
 * @method static updateRecord(\Illuminate\Database\Eloquent\Model $object, $data)
 * @method static deleteRecords($model, $data)
 *
 * @see \Milyoonex\Repositories\BaseRepository
 */

class MongoBaseRepositoryFacade extends BaseFacade
{
    //
}