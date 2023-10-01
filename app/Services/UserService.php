<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $repo;

    public function __construct(UserRepository $userRepository)
    {
        $this->repo = $userRepository;
    }
    public function store($data)
    {
        return $this->repo->store($data);
    }
    public function firstQuery($query)
    {
        return $this->repo->firstQuery($query);
    }
    public function getData($id)
    {
        return $this->repo->getData($id);
    }

}
