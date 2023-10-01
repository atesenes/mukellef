<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;
use App\Repositories\UserSubscriptionRepository;

class UserSubscriptionService
{
    protected $repo;

    public function __construct(UserSubscriptionRepository $userSubscriptionRepository)
    {
        $this->repo = $userSubscriptionRepository;
    }
    public function store($data)
    {
        return $this->subscription_repo->store($data);
    }
    public function update($data,$id)
    {
        return $this->subscription_repo->update($data,$id);
    }
    public function add($control,$data)
    {
        return $this->repo->updateOrCreate($control,$data);
    }
    public function findAndUpdate($where, $data)
    {
        $record = $this->repo->firstQuery($where);
        return $this->repo->update($data,$record->id);
    }
    public function delete($id)
    {
        return $this->repo->delete($id);
    }
    public function firstQuery($query)
    {
        return $this->repo->firstQuery($query);
    }
    public function getQuery($query)
    {
        return $this->repo->getQuery($query);
    }
}
