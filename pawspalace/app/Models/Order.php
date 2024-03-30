<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['total'] - string - contains the order name
     * $this->attributes['user_id'] - int - contains the referenced user id
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     * $this->user - User - contains the associated User
     * $this->items - Collection - contains the associated items
     * $this->appointment - Collection - contains the associated appointment
     */
    public function getId()
    {
        return $this->attributes['id'];
    }

    public function getTotal(): string
    {
        return $this->attributes['total'];
    }

    public function setTotal(string $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function setItems(Collection $items): void
    {
        $this->items = $items;
    }

    public function appointment(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getAppointment(): Collection
    {
        return $this->appointment;
    }

    public function setAppointment(Collection $appointment): void
    {
        $this->appointment = $appointment;
    }

    public static function validate($request)
    {
        $request->validate([
            'total' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);
    }
}