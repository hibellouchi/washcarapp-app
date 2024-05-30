<?php

namespace App\Models;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cars extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function customers(): BelongsTo
    {
        return $this->BelongsTo(Customers::class);
    }

    
    public function orderItems(): HasMany
    {
        return $this->HasMany(OrderItems::class);
    }

    public function order(): HasMany
    {
        return $this->HasMany(Order::class);
    }
}
