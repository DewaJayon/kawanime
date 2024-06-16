<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Anime extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    const STATUS_ONGOING    = 'Ongoing';
    const STATUS_FINISHED   = 'Finished';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function episode()
    {
        return $this->hasMany(Episode::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function genreOption()
    {
        return $this->hasMany(GenreOption::class);
    }
}
