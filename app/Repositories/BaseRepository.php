<?php

namespace Milyoonex\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository extends Repository
{
    public function module($module = null)
    {
        if(! is_null($module)) {
            $this->modelNameSpace = '\\Milyoonex\\' . ucfirst(preg_replace('/\s+/', '', $module)) . '\\Models\\';
        }
        return $this;
    }

    public function getRecord($model, $query, $selection = ['*'], $relations = [])
    {
        $selection = $selection == [] ? ['*'] : $selection;
        $model = (! is_null($this->modelNameSpace)) ? $this->modelNameSpace . $model : '\\App\\Models\\' . $model;
        return $model::select($selection)->with($relations)->where($query)->first();
    }

    public function getRecords($model, $query = [], $selection = ['*'], $relations = [])
    {
        $selection = $selection == [] ? ['*'] : $selection;
        $model = (! is_null($this->modelNameSpace)) ? $this->modelNameSpace . $model : '\\App\\Models\\' . $model;
        return $model::select($selection)->with($relations)->where($query)->get();
    }

    public function getPaginate($model, $query = [], $selection = ['*'], $relations = [],$paginate=10)
    {
        $selection = $selection == [] ? ['*'] : $selection;
        $model = (! is_null($this->modelNameSpace)) ? $this->modelNameSpace . $model : '\\App\\Models\\' . $model;
        return $model::select($selection)->with($relations)->where($query)->paginate($paginate);
    }

    public function storeRecord($model, $data)
    {
        $model = (! is_null($this->modelNameSpace)) ? $this->modelNameSpace . $model : '\\App\\Models\\' . $model;
        return $model::create($data);
    }

    public function storeRelationRecord($relation, $data)
    {
        return $relation->create($data);
    }

    public function updateRecord(Model $object, $data)
    {
        $object->update($data);
        return $object;
    }

    public function forceStoreRecord($model, $data)
    {
        $model = (! is_null($this->modelNameSpace)) ? $this->modelNameSpace . $model : '\\App\\Models\\' . $model;
        $model = new $model;
        foreach($data as $key => $value) {
            $model->$key = $value;
        }
        $model->save();
        return $model;
    }

    public function forceStoreRelationRecord($relation, $data)
    {
        $model = get_class($relation->getRelated());
        $model = new $model;

        $foreign_key = explode('.', array_values((array)$relation)[0]);
        $foreign_key = end($foreign_key);

        $model->$foreign_key = $relation->getParent()->id;

        foreach($data as $key => $value) {
            $model->$key = $value;
        }
        $model->save();
        return $model;
    }

    public function forceUpdateRecord(Model $object, $data)
    {
        foreach($data as $key => $value) {
            $object->$key = $value;
        }
        $object->save();
        return $object;
    }

    public function deleteRecord(Model $object)
    {
        return $object->delete();
    }

    public function deleteRecords($model, $data = [])
    {
        $model = (! is_null($this->modelNameSpace)) ? $this->modelNameSpace . $model : '\\App\\Models\\' . $model;
        return $model::where($data)->delete();
    }

    public function forceDeleteRecord(Model $object)
    {
        return $object->forceDelete();
    }

    public function forceDeleteRecords($model, $data = [])
    {
        $model = (! is_null($this->modelNameSpace)) ? $this->modelNameSpace . $model : '\\App\\Models\\' . $model;
        return $model::where($data)->forceDelete();
    }

    public function restoreRecord(Model $object)
    {
        return $object->restore();
    }

    public function restoreRecords($model, $data = [])
    {
        $model = (! is_null($this->modelNameSpace)) ? $this->modelNameSpace . $model : '\\App\\Models\\' . $model;
        return $model::where($data)->restore();
    }
}
