<?php

namespace App\Models;

use App\Models\Cars;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function cars(): HasMany
    {
        return $this->HasMany(Cars::class);
    }

    public function orders(): HasMany
    {
        return $this->HasMany(Order::class);
    }

    public function orderItems(): HasMany
    {
        return $this->HasMany(OrderItems::class);
    }

}
