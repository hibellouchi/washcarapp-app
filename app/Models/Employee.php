<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function actives(): HasMany
    {
        return $this->HasMany(Active::class);
    }

    public function salary(): HasMany
    {
        return $this->HasMany(Salary::class);
    }

    
    public function orderItems(): HasMany
    {
        return $this->HasMany(OrderItems::class);
    }

    public function totalPayments(): int
    {
        return $this->orderItems->sum('total')/3;
    }

    public function salaryPayments(): int
    {
        return $this->salary->sum('price');
    }

    public function restPayments(): int
    {
        $pay = $this->orderItems->sum('total')/3;

        $rest = $this->salary->sum('price');

        return $pay - $rest;
    }


    
}
