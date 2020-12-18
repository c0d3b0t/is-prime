<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'count'
    ];

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function getCount(): ?int
    {
        return $this->number;
    }
}
