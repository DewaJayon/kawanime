<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
