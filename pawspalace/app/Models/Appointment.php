<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Appointment extends Model
{
    /**
     * APPOINTMENT ATTRIBUTES
     * $this->attributes['id'] - string - contains the appointment primary key (id)
     * $this->attributes['duration'] - int - contains appointment duration
     * $this->attributes['status'] - string - contains appointment status
     * $this->attributes['modality'] - string - contains appointment modality
     * $this->attributes['price'] - int - contains the appointment price
     * $this->attributes['date'] - string - contains the available date for appointments
     * this->attributes['time'] - string - contains the available time for appointments
     * $this->attributes['image'] - string - contains the appointment image
     * $this->items - Collection - contains the associated items
     * $this->attributes['created_at'] - timestamp - contains the appointment created date
     * $this->attributes['updated_at'] - timestamp - contains the appointment update date
     */
    protected $fillable = ['duration', 'date', 'time', 'status', 'modality', 'price'];

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

    public function getDate(): string
    {
        return $this->attributes['date'];
    }

    public function setDate(string $date): void
    {
        $this->attributes['date'] = $date;
    }

    public function getTime(): string
    {
        return $this->attributes['time'];
    }

    public function setTime(string $time): void
    {
        $this->attributes['time'] = $time;
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

    public function getImage(): string
    {
        return $this->attributes['image'];
    }

    public function setImage(string $image): void
    {
        $this->attributes['image'] = $image;
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
            'date' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'status' => 'required|string',
            'modality' => 'required|string',
            'price' => 'required|numeric|min:10',
        ]);
    }
}
