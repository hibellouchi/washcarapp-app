<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItems extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function employee(): BelongsTo
    {
        return $this->BelongsTo(Employee::class);
    }
    public function service(): BelongsTo
    {
        return $this->BelongsTo(Service::class);
    }
    public function cars(): BelongsTo
    {
        return $this->BelongsTo(Cars::class);
    }

    public function order(): BelongsTo
    {
        return $this->BelongsTo(Order::class);
    }

    public function customers(): BelongsTo
    {
        return $this->BelongsTo(Customers::class);
    }
}
