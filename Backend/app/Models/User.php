<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Function
     */

    public function setProfileAttribute($value)
    {
        $attribute_name = "profile";
        $disk = config('backpack.base.root_disk_name');
        $destination_path = "public/uploads/folder_1/folder_2";
        if (empty($value)) {
            /**
             *delete the image from disk
             */
            if (isset($this->{$attribute_name}) && !empty($this->{$attribute_name})) {
                Storage::disk($disk)->delete($this->{$attribute_name});
            }
            /**
             * set null on database column
             */
            $this->attributes[$attribute_name] = null;
        }
        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            /**
             *0. Make the image
             */
            $image = Image::make($value)->encode('jpg', 90);
            /**
             *1. Generate a filename.
             */
            $filename = md5($value.time()).'.jpg';
            /*
            *2. Store the image on disk.
            */
            Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            /**
             *3. Delete the previous image, if there was one.
             */
            if (isset($this->{$attribute_name}) && !empty($this->{$attribute_name})) {
                Storage::disk($disk)->delete($this->{$attribute_name});
            }
            /**
             *4. Save the public path to the database
             *but first, remove "public/" from the path, since we're pointing to it
             *from the root folder; that way, what gets saved in the db
             *is the public URL (everything that comes after the domain name)
             */
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        } elseif (!empty($value)) {
            // if value isn't empty, but it's not an image, assume it's the model value for that attribute.
            $this->attributes[$attribute_name] = $this->{$attribute_name};
        }
    }
}
