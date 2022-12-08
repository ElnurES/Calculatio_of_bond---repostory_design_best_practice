<?php

namespace App\Repositories\Bond;

use App\Models\Bond;
use App\Repositories\BaseRepository;

class BondRepository extends BaseRepository implements IBondRepository
{

    /**
     * @param Bond $model
     */
    public function __construct(Bond $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @return Bond
     */
    public function findById(int $id): Bond
    {
        return $this->model->findOrFail($id);
    }

}
