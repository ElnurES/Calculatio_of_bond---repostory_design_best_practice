<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class OrderRepository extends BaseRepository implements IOrderRepository
{
    /**
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $attributes
     * @param $bond_id
     * @return void
     */
    public function create(array $attributes, $bond_id): void
    {
        $this->model->query()->create([
            'order_date' => data_get($attributes, 'order_date'),
            'number_received' => data_get($attributes, 'number_received'),
            'bond_id' => $bond_id
        ]);
    }

    /**
     * @param $id
     * @return Model
     */
    public function findByIdWithBond($id): Model
    {
        return Order::with('bond')->findOrFail($id);
    }
}
