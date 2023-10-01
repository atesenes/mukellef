<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;
use App\Repositories\UserSubscriptionRepository;

class SubscriptionService
{
    protected $subscription_repo;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscription_repo = $subscriptionRepository;
    }
    public function store($data)
    {
        return $this->subscription_repo->store($data);
    }
    public function update($data,$id)
    {
        return $this->subscription_repo->update($data,$id);
    }
    public function add($data)
    {
        return $this->subscription_repo->add($data);
    }
    public function get($id)
    {
        return $this->subscription_repo->get($id);
    }
    public function findAndUpdate($where, $data)
    {
        $record = $this->subscription_repo->firstQuery($where);
        return $this->subscription_repo->update($data,$record->id);
    }
    public function delete($id)
    {
        return $this->subscription_repo->delete($id);
    }
    public function firstQuery($query)
    {
        return $this->subscription_repo->firstQuery($query);
    }
    public function getQuery($query)
    {
        return $this->subscription_repo->getQuery($query);
    }
}
