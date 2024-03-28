<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

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
    protected $fillable = ['comment', 'rating'];

    public static function validateReview(array $data): void
    {
        $validator = validator($data, [
            'comment' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getComment(): string
    {
        return $this->attributes['comment'];
    }

    public function setComment($comment): void
    {
        $this->attributes['comment'] = $comment;
    }

    public function getRating(): int
    {
        return $this->attributes['rating'];
    }

    public function setRating($rating): void
    {
        $this->attributes['rating'] = $rating;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at']->format('Y-m-d H:i:s');
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at']->format('Y-m-d H:i:s');
    }
}