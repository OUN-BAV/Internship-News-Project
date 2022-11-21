<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $fillable=[
        'category_id',
        'title',
        'content',
        'post_by',
        'thumbnail'
    ];
    protected $casts = [
        'gallery' => 'array'
    ];

    public function profile()
    {
         return $this->morphOne(Profile::class,'imageable');
    }

    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'galleryable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function setGalleryAttribute($value)
    {
        $attributeName = "gallery";
        $disk = "upload";
        $destinationPath = "uploads/posts";
        
        $originalModelValue = $this->getOriginal()[$attributeName] ?? [];
    
        if (! is_array($originalModelValue)) {
            $attributeValue = json_decode($originalModelValue, true) ?? [];
        } else {
            $attributeValue = $originalModelValue;
        }

        $clearFiles = request()->get('clear_'.$attributeName);

        // if a file has been marked for removal,
        // delete it from the disk and from the db
        if ($clearFiles) {
            foreach ($clearFiles as $key => $filename) {
                \Storage::disk($disk)->delete($filename);
                $attributeValue = Arr::where($attributeValue, function ($value, $key) use ($filename) {
                    return $value != $filename;
                });
            }
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if (request()->hasFile($attributeName)) {
            foreach (request()->file($attributeName) as $file) {
                if ($file->isValid()) {
                    // 1. Generate a new file name
                    $fileName = md5($file->getClientOriginalName().
                    random_int(1, 9999).time()).'.'.$file->getClientOriginalExtension();

                    // 2. Move the new file to the correct path
                    $filePath = $file->storeAs($destinationPath, $fileName, $disk);

                    // 3. Add the public path to the database
                    $attributeValue[] = $filePath;
                }
            }
        }

        $this->attributes[$attributeName] = json_encode($attributeValue);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            if (count((array)$obj->photos)) {
                foreach ($obj->photos as $file_path) {
                    \Storage::disk('public_folder')->delete($file_path);
                }
            }
        });
    }
}
