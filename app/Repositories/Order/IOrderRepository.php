<?php

namespace App\Repositories\Order;

use Illuminate\Database\Eloquent\Model;

interface IOrderRepository
{
    /**
     * @param array $attributes
     * @param $bond_id
     * @return void
     */
    public function create(array $attributes, $bond_id): void ;

    /**
     * @param $id
     * @return Model
     */
    public function findByIdWithBond($id): Model;
}
