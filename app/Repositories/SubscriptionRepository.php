<?php

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository extends BaseRepository
{
    protected $model;

    public function __construct(Subscription $subscription)
    {
        $this->model = $subscription;
    }
    public function store($data)
    {
        return $this->model::create($data);
    }
    public function update($data,$id)
    {
        return $this->model::find($id)->update($data);
    }
}
