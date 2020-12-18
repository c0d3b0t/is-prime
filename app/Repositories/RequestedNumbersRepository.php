<?php

namespace App\Repositories;

use App\Models\RequestedNumber;

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
    public function update(array $data): int
    {
        return $this->model->where('number', $data['number'])->update($data);
    }

    /**
     * @param int $number
     * @return RequestedNumber|null
     */
    public function getByNumber(int $number): ?RequestedNumber
    {
        return $this->model->where('number', $number)->first();
    }
}
