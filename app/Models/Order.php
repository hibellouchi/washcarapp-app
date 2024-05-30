<?php

namespace App\Models;

use App\Models\Customers;
use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function orderItems(): HasMany
    {
        return $this->HasMany(OrderItems::class);
    }
    public function customers(): BelongsTo
    {
        return $this->BelongsTo(Customers::class);
    }
    public function cars(): BelongsTo
    {
        return $this->BelongsTo(Cars::class);
    }
    public function service(): BelongsTo
    {
        return $this->BelongsTo(Service::class);
    }

    public function totalPayments(): int
    {
        return $this->orderItems->sum('total');
    }
}
