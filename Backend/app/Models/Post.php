<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Profile;
use App\Models\Category;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use UploadTrait;
    protected $fillable=[
        'category_id',
        'title',
        'content',
        'post_by',
        'thumbnail'
    ];
    protected $casts = [
        'created_at'  => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
    protected $appends = ['UserName'];
    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'galleryable');
    }

    public function user(){
        return $this->belongsTo(User::class, 'post_by', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setThumbnailAttribute() {
        $this->attributes['thumbnail'] = $this->base64Upload(request()->thumbnail);
    }
    public function getUserNameAttribute(){
        return optional($this->user)->name;
    }
}
