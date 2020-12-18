<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedNumber extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'number',
        'count',
        'is_prime'
    ];

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }
}
