<?php
namespace App\Repositories;

use DB;
use Log;

class Repository
{
    protected $model;

    public function select($select='*')
    {
        return $this->model->select($select);
    }

    public function with($with=[])
    {
        return $this->model->with($with);
    }

    public function all() {
        return $this->model->all();
    }

    public function get() {
        return $this->model->get();
    }

    public function paginate($paginate) {
        return $this->model->paginate($paginate);
    }

    public function count() {
        return $this->model->count();
    }

    public function find($id) {
        return $this->model->findOrFail($id);
    }

    public function create($inputs)
    {
//        DB::beginTransaction();
//        try {
            $record = $this->model->create($inputs);
//            DB::commit();
            return $record;
//        } catch (\Illuminate\Database\QueryException $e) {
//            DB::rollback();
//            return false;
//        }
    }

    public function insert($data)
    {
        DB::beginTransaction();
        try {
            $this->model->insert($data);
            DB::commit();
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            Log::debug($e);
            DB::rollback();
            return false;
        }
    }

    public function update($id, $data)
    {
        DB::beginTransaction();
        try {
            $record = $this->model->findOrFail($id);
            $record->fill($data)->save();
            DB::commit();
            return $record;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            $this->model->findOrFail($id)->delete();
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }

    public function findByField($field, $value = null, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->first($columns);
    }

    public function where($field, $operator=null, $value) {
        return $this->model->where($field, $operator, $value);
    }

    public function whereIn($field, $value=[]) {
        return $this->model->whereIn($field, $value);
    }

    public function orderby($field, $type='desc')
    {
        return $this->model->orderby($field, $type);
    }

    public function pluck($field, $key)
    {
        return $this->model->pluck($field, $key);
    }

    public function firstOrCreate($attributes){
        return $this->model->firstOrCreate($attributes);
    }

    public function changeStatus($id, $field='is_active')
    {
        DB::beginTransaction();
        try{
            $record = $this->model->findOrFail($id);
            $record->$field == 0 ? $record->fill([$field => 1])->save() : $record->fill([$field => 0])->save();
            DB::commit();
            return $record;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    function getContents($str, $startDelimiter, $endDelimiter)
    {
        $contents = array();
        $startDelimiterLength = strlen($startDelimiter);
        $endDelimiterLength = strlen($endDelimiter);
        $startFrom = $contentStart = $contentEnd = 0;
        while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
            $contentStart += $startDelimiterLength;
            $contentEnd = strpos($str, $endDelimiter, $contentStart);
            if (false === $contentEnd) {
                break;
            }
            $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
            $startFrom = $contentEnd + $endDelimiterLength;
        }
        return $contents;
    }

}