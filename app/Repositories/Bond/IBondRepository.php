<?php

namespace App\Repositories\Bond;

use App\Models\Bond;

interface IBondRepository
{
    /**
     * @param int $id
     * @return Bond
     */
    public function findById(int $id): Bond;

}
