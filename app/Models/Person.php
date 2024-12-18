<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Person extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name', 'slug', 'role', 'order', 'information'];

    public function multimedia()
    {
        return $this->morphOne(Multimedia::class, 'model');
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
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

    public function buildPage()
    {
        $page = new Page([
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => 'person',
            'status' => 'active',
        ]);

        $headerBlock = new Block([
            'type' => 'header-image',
            'grant' => 'all',
            'heading' => $this->name,
        ]);
        $detailBlock = new Block([
            'type' => 'person-info',
            'grant' => 'all',
            'heading' => $this->name,
            'body' => $this->information,
        ]);
        $detailBlock->tags = $this->tags()->where('type', 'person')->get();
        $peopleBlock = new Block([
            'type' => 'people-list',
            'grant' => 'all',
            'heading' => 'Meer leden',
        ]);
        $partnerBlock = new Block([
            'type' => 'partners',
            'grant' => 'all',
            'heading' => 'Partners',
        ]);
        $page->blocks = collect([$headerBlock, $detailBlock, $peopleBlock, $partnerBlock]);

        return $page;
    }

    public function shortInformation()
    {
        if( $this->tags()->where('type', 'person')->count() > 0 ) {
            $tag = $this->tags()->where('type', 'person')->first();
            return $tag->description;
        }
        return $this->information;
    }
}
