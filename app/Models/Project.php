<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'description', 'type', 'status', 'link', 'published_at'];

    protected $casts = [
        'published_at' => 'date',
    ];

    public static $stati = ['active', 'draft'];
    public static $types = ['default'];

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
            'name' => $this->title,
            'slug' => $this->slug,
            'type' => 'project',
            'status' => 'active',
        ]);

        $headerBlock = new Block([
            'type' => 'header-image',
            'grant' => 'all',
            'heading' => $this->title,
        ]);
        $detailBlock = new Block([
            'type' => 'project-detail',
            'grant' => 'all',
            'heading' => $this->title,
            'body' => $this->description,
        ]);
        $detailBlock->tags = $this->tags()->where('type', 'person')->get();
        if( !empty($this->link) ) {
            $infoAction = new Action([
                'action' => 'Meer informatie',
                'type' => 'url',
                'target' => $this->link,
                'order' => 1,
            ]);
            $detailBlock->actions = collect([$infoAction]);
        }
        $projectsListBlock = new Block([
            'type' => 'projects-list',
            'grant' => 'all',
            'heading' => 'Meer projecten',
        ]);
        $partnerBlock = new Block([
            'type' => 'partners',
            'grant' => 'all',
            'heading' => 'Partners',
        ]);
        $page->blocks = collect([$headerBlock, $detailBlock, $projectsListBlock, $partnerBlock]);

        return $page;
    }
}
