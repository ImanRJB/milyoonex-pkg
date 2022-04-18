<?php

namespace Milyoonex\Repositories;

use Illuminate\Support\Facades\DB;

class MongoBaseRepository
{
    public function getRecord($table, $where = [], $selection = ['*'])
    {
        $selection = $selection == [] ? ['*'] : $selection;

        return DB::connection('mongodb')->table($table)->select($selection)->where($where)->first();
    }

    public function getRecords($table, $where = [], $selection = ['*'])
    {
        $selection = $selection == [] ? ['*'] : $selection;
        return DB::connection('mongodb')->table($table)->select($selection)->where($where)->get();
    }

    public function getPaginate($table, $where = [], $selection = ['*'],$paginate=10)
    {
        $selection = $selection == [] ? ['*'] : $selection;
        return DB::connection('mongodb')->table($table)->select($selection)->where($where)->paginate($paginate);
    }

    public function storeRecord($table, $data)
    {
        return DB::connection('mongodb')->table($table)->insert($data);
    }

    public function updateRecord($table, $where, $data)
    {
        return DB::connection('mongodb')->table($table)->where($where)->update($data);
    }

    public function deleteRecords($table, $where)
    {
        return DB::connection('mongodb')->table($table)->where($where)->delete();
    }

}
