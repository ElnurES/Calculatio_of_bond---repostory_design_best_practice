<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderPaymentsResource;
use App\Http\Resources\PaymentDatesResource;
use App\Services\BondService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class BondController extends Controller
{
    use JsonResponseTrait;
    /**
     * @var BondService
     */
    protected BondService $bondService;

    /**
     * @param BondService $bondService
     */
    public function __construct(BondService $bondService)
    {
        $this->bondService = $bondService;
    }
    /**
     * @param $id
     * @return ResourceCollection
     */
    public function bondInterestPaymentDates($id): ResourceCollection
    {
        return PaymentDatesResource::collection($this->bondService->bondInterestPaymentDates($id));
    }
    /**
     * @param OrderRequest $request
     * @param $id
     * @return Response
     */
    public function creatingBondPurchaseOrder(OrderRequest $request, $id): Response
    {
        $this->bondService->createBondOrder($request, $id);

        return $this->success('success');
    }

    /**
     * @param $id
     * @return ResourceCollection
     */
    public function bondOrderInterestPayments($id): ResourceCollection
    {
        return OrderPaymentsResource::collection($this->bondService->bondOrderInterestPayments($id));
    }
}
