<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    /**
     * FAVORITE ATTRIBUTES
     * $this->attributes['id'] - int - contains the favorite primary key (id)
     * $this->attributes['state'] - boolean - contains the state of favorite
     * $this->attributes['created_at'] - timestamp - contains the favorite creation date
     * $this->attributes['updated_at'] - timestamp - contains the favorite update date
     * $this->product - Product - contains the associated Product
     * $this->user - User - contains the associated User
     */
    protected $fillable = ['user_id', 'product_id'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
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
}
