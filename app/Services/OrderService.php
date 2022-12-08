<?php

namespace App\Services;

use App\Http\Requests\OrderRequest;
use App\Repositories\Order\IOrderRepository;
use Illuminate\Database\Eloquent\Model;

class OrderService
{
    /**
     * @var IOrderRepository
     */
    protected IOrderRepository $orderRepository;

    /**
     * @param IOrderRepository $orderRepository
     */

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param OrderRequest $request
     * @param int $id
     * @return void
     */
    public function create(array $attributes, int $id): void
    {
        $this->orderRepository->create($attributes, $id);
    }


    /**
     * @param $id
     * @return Model
     */
    public function findByIdWithBond($id): Model
    {
        return $this->orderRepository->findByIdWithBond($id);
    }
}
