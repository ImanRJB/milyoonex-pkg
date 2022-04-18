<?php

namespace Milyoonex\Facades;

/**
 * @class \Milyoonex\Facades\BaseRepositoryFacade
 *
 * @method static getRecord($table, $where = [], $selection = ['*'])
 * @method static getRecords($table, $where = [], $selection = ['*'])
 * @method static getPaginate($table, $where = [], $selection = ['*'],$paginate=10)
 * @method static storeRecord($table, $data)
 * @method static updateRecord($table, $where, $data)
 * @method static deleteRecords($table, $where)
 *
 * @see \Milyoonex\Repositories\BaseRepository
 */

class MongoBaseRepositoryFacade extends BaseFacade
{
    //
}