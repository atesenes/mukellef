<?php

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    protected $repo;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->repo = $transactionRepository;
    }
    public function add($data)
    {
        return $this->repo->add($data);
    }
    public function getQuery($query)
    {
        return $this->repo->getQuery($query);
    }

}
