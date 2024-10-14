<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Language;
use App\Enums\Rating;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    /**
     * The relationships that should be deleted when the movie is deleted.
     *
     * @var array<string>
     */
    protected array $cascadeDeletes = ['screenings'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
        'rating',
        'language',
        'poster',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rating' => Rating::class,
            'language' => Language::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */
    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = ['poster_url'];

    /**
     * Get the full url for the movie poster.
     */
    protected function posterUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->poster
                ? Storage::disk('poster')->url($this->poster)
                : asset('assets/images/default-poster.png'),
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Custom functions
    |--------------------------------------------------------------------------
    */
}
