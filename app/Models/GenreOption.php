<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreOption extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
