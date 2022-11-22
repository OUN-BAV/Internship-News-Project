<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';
    protected $guarded = ['id'];

    protected $fillable = [
        'url',
        'mime_type',
        'galleryable_id',
        'galleryable_type'
    ]; 

    public function galleryable()
    {
        return $this->morphTo(Post::class);
    }
}
