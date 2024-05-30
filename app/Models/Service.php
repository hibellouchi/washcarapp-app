<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    
    public function orderItems(): HasMany
    {
        return $this->HasMany(OrderItems::class);
    }

    public function order(): HasMany
    {
        return $this->HasMany(Order::class);
    }
}
