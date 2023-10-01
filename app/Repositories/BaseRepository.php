<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function get($id)
    {
        return $this->model::find($id);
    }
    public function add($data)
    {
        return $this->model::create($data);
    }
    public function update($data,$id)
    {
        return $this->model::find($id)->update($data);
    }
    public function getQuery($query)
    {
        return $this->model::where($query)->get();
    }
    public function firstQuery($query)
    {
        return $this->model::where($query)->first();
    }
    public function updateOrCreate($where, $data)
    {
        return $this->model::updateOrCreate($where, $data);
    }
    public function delete($id)
    {
        $model = $this->model->find($id);
        return $model->delete();
    }
}
