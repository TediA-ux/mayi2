<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Post extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',

    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($post) {
            $post->slug = $post->generateSlug($post->title);
            $post->save();
        });
    }
    private function generateSlug($title)
    {
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::whereTitle($title)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}