<?php

namespace App\Repositories;

interface OrderStateRepositoryInterface
{
    public function all();

    public function find($id);
}
