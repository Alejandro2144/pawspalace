<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Appointment extends Model
{
    /**
     * APPOINTMENT ATTRIBUTES
     * $this->attributes['id'] - string - contains the appointment primary key (id)
     * $this->attributes['duration'] - int - contains appointment duration
     * $this->attributes['reason'] - string - contains appointment reason
     * $this->attributes['status'] - string - contains appointment status
     * $this->attributes['modality'] - string - contains appointment modality
     * $this->attributes['price'] - int - contains the appointment price
     * $this->attributes['created_at'] - timestamp - contains the appointment created date
     * $this->attributes['updated_at'] - timestamp - contains the appointment update date
     */
    protected $fillable = ['duration', 'reason', 'status', 'modality', 'price'];

    public function getId(): string
    {
        return $this->attributes['id'];
    }

    public function getDuration(): int
    {
        return $this->attributes['duration'];
    }

    public function setDuration(int $duration): void
    {
        $this->attributes['duration'] = $duration;
    }

    public function getReason(): string
    {
        return $this->attributes['reason'];
    }

    public function setReason(string $reason): void
    {
        $this->attributes['reason'] = $reason;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getModality(): string
    {
        return $this->attributes['modality'];
    }

    public function setModality(string $modality): void
    {
        $this->attributes['modality'] = $modality;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public static function validate(Request $request): void
    {
        $request->validate([
            'duration' => 'required|integer|min:10',
            'reason' => 'required|string|max:255',
            'status' => 'required|string',
            'modality' => 'required|string',
            'price' => 'required|numeric|min:10',
        ]);
    }
}
