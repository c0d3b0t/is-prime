<?php

namespace App\Repositories;

use App\Models\RequestedNumber;
use App\Services\NumbersRange;
use Illuminate\Support\Collection;

class RequestedNumbersRepository
{
    /**
     * @var RequestedNumber
     */
    private RequestedNumber $model;

    /**
     * RequestedNumbersRepository constructor.
     * @param RequestedNumber $model
     */
    public function __construct(RequestedNumber $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $number
     * @return RequestedNumber|null
     */
    public function getByNumber(int $number): ?RequestedNumber
    {
        return $this->model->where('number', $number)->first();
    }

    /**
     * @param array $data
     * @return RequestedNumber
     */
    public function store(array $data): RequestedNumber
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @return int
     */
    public function updateByNumber(array $data): int
    {
        return $this->model->where('number', $data['number'])->update($data);
    }

    /**
     * @param NumbersRange $range
     * @param bool $hasPrimesOnly
     * @return Collection
     */
    public function getByRange(NumbersRange $range, bool $hasPrimesOnly = false): Collection
    {
        $query = $this->model
            ->where('number', '>=', $range->getFrom())
            ->where('number', '<=', $range->getTo());

        if($hasPrimesOnly)
        {
            $query = $query->where('is_prime', true);
        }

        return $query->orderBy('number', 'ASC')
            ->get();
    }
}
