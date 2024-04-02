<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Review extends Model
{
    use HasFactory;

    /**
     * REVIEW ATTRIBUTES
     * $this->attributes['id'] - int - contains the review primary key (id)
     * $this->attributes['comment'] - string - contains the review comment
     * $this->attributes['rating'] - int - contains the review rating
     * $this->attributes['created_at'] - timestamp - contains the review creation date
     * $this->attributes['updated_at'] - timestamp - contains the review update date
     */
    protected $fillable = ['comment', 'rating', 'product_id', 'user_id'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getComment(): string
    {
        return $this->attributes['comment'];
    }

    public function setComment(string $comment): void
    {
        $this->attributes['comment'] = $comment;
    }

    public function getRating(): int
    {
        return $this->attributes['rating'];
    }

    public function setRating(int $rating): void
    {
        $this->attributes['rating'] = $rating;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function validate(Request $request): void
    {
        $request->validate([
            'comment' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'product_id' => [
                Rule::unique('reviews')->where(function ($query) use ($request) {
                    return $query->where('product_id', $request->input('product_id'));
                }),
            ],
            'user_id' => [
                Rule::exists('users', 'id')->where(function ($query) use ($request) {
                    return $query->where('id', $request->input('user_id'));
                }),
            ],
        ]);
    }
}
