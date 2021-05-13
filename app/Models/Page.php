<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Page extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HasMediaTrait;

    protected $fillable = ['title', 'slug', 'description', 'order', 'menu', 'status', 'type'];

    public static $stati = ['active', 'concept', 'user'];

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function event()
    {
        return $this->hasOne(Event::class);
    }

    public function multimedia()
    {
        return $this->morphOne(Multimedia::class, 'model');
    }

    public function parent()
    {
        return $this->belongsTo(Page::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    public function tag()
    {
        return $this->hasOne(Tag::class);
    }

    public function title()
    {
        if( $this->type == 'page' ) return $this->title;
        elseif( $this->type == 'event' ) return $this->event->title;
        elseif( $this->type == 'product' ) return $this->product->name;
        elseif( $this->type == 'project' ) return $this->project->title;
        else return $this->title;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('media')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')->width('400')->height('400');
                $this->addMediaConversion('large')->width('1000')->height('1000');
            });
    }
}
