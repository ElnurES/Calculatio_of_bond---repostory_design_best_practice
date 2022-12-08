<?php

namespace App\Services;

use App\Http\Requests\OrderRequest;
use App\Models\Bond;
use App\Repositories\Bond\IBondRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BondService
{
    /**
     * @var IBondRepository
     */
    protected IBondRepository $bondRepository;

    /**
     * @var OrderService
     */
    protected OrderService $orderService;

    /**
     * @param IBondRepository $bondRepository
     */

    public function __construct(IBondRepository $bondRepository,OrderService $orderService)
    {
        $this->bondRepository = $bondRepository;
        $this->orderService = $orderService;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function bondInterestPaymentDates(int $id): Collection
    {
        $bond = $this->bondRepository->findById($id);

        $periodicDays = $this->calculationOfPeriods($bond);

        $issueDays = carbonParseDate($bond->issue_date)->addDays($periodicDays);

        $issueDate = carbonParseDate($bond->issue_date);

        $weekOfDays = collect($issueDate->monthsUntil($issueDays))->filter(function ($date) {
            if (carbonParseDate($date)->isSaturday()) {
                $date->addDays(2);
            } elseif (carbonParseDate($date)->isSunday()) {
                $date->addDays(1);
            }
            return $date;
        })->map(function ($date) {
            return ['date' => $date->format('Y-m-d')];
        });

        return $weekOfDays;
    }

    /**
     * @param OrderRequest $request
     * @param int $id
     * @return void
     */
    public function createBondOrder(OrderRequest $request, int $id): void
    {
        $this->orderService->create($request->validated(), $id);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function bondOrderInterestPayments(int $id): Collection
    {
        $order = $this->orderService->findByIdWithBond($id);
        $bondInterestPaymentDates = $this->bondInterestPaymentDates($order->bond->id);
        $bondPayments = [];
        $bondOrderInterestPayments = $bondInterestPaymentDates->map(function ($element, $key) use ($order, $bondInterestPaymentDates, $bondPayments) {
            $bondPayments['date'] = $element['date'];
            $elementDate = carbonParseDate($element['date']);
            if ($key == 0) {
                $orderDate = carbonParseDate($order->order_date);
                $bondPayments['amount'] = $this->accruedInterest($order, $elementDate->diffInDays($orderDate));
            }
            if ($key != 0 && $key < count($bondInterestPaymentDates) - 1) {
                $bondPaymentDate = carbonParseDate($bondInterestPaymentDates[$key + 1]['date']);
                $bondPayments['amount'] = $this->accruedInterest($order, $elementDate->diffInDays($bondPaymentDate));
            }

            return $bondPayments;
        })->filter(function ($element) {
            return isset($element['amount']);
        });

        return $bondOrderInterestPayments;
    }


    /**
     * @param Model $model
     * @param $numberOfDaysPast
     * @return string
     */
    public function accruedInterest(Model $model, $numberOfDaysPast): string
    {
        return number_format(($model->bond->nominal_price / 100 * $model->bond->frequency_of_payment_coupons) / $model->bond->interest_calculation_period * $numberOfDaysPast * $model->number_received, 2);
    }

    /**
     * @param Bond $bond
     * @return float|int|void
     */
    private function calculationOfPeriods(Bond $bond)
    {
        switch ($bond->interest_calculation_period) {
            case 360:
                return 12 / $bond->frequency_of_payment_coupons * 30;
            case 364:
                return 364 / $bond->frequency_of_payment_coupons;
            case 365:
                return 12 / $bond->frequency_of_payment_coupons;
        }
    }

}
