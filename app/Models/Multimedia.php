<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Multimedia extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['type', 'name', 'order'];

    protected $casts = [
        'parameters' => 'array',
    ];

    public static $types = ['image', 'video'];
    public static $mimetypes = [
        'image/jpeg' => 'image',
        'image/png' => 'image',
        'video/mp4' => 'video',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public static function build($request, $model)
    {
        $request->validate([
            'media' => 'required|max:'. (env('TALC_MEDIA_AMAZON', false) ? 512000 : 5120) .'|mimetypes:'. join(',', array_keys(Multimedia::$mimetypes)),
        ]);
        
        $type = 'image';
        if( $request->hasFile('media') ) $type = Multimedia::$mimetypes[$request->media->getMimeType()];

        $multimedia = $model->multimedia()->create([
            'type' => $type,
            'order' => $model->multimedia()->max('order') + 1,
        ]);

        if( $request->hasFile('media') ) $multimedia->upload($request);

        return $multimedia;
    }

    public function upload($request)
    {
        $request->validate([
            'media' => 'required|max:'. (env('TALC_MEDIA_AMAZON', false) ? 512000 : 5120) .'|mimetypes:'. join(',', array_keys(Multimedia::$mimetypes)),
        ]);
        
        if( $request->hasFile('media') ) {
            // Store smaller files (less than 5 MB) locally
            $disk = 'media';
            if( $request->media->getSize() > (5 * 1024 * 1024) ) $disk = 's3';
            $this->addMediaFromRequest('media')->toMediaCollection($this->type, $disk);

            // Set new name to multimedia after upload
            $this->name = $this->getFirstMedia($this->type)->name;
            $this->save();
        }
    }

    public function imageUrl($size = 'thumb')
    {
        if( $this->hasMedia($this->type) ) {
            return $this->getFirstMediaUrl($this->type, $size);
        }
        return false;
    }

    public function mimetype()
    {
        if( !in_array($this->type, ['image', 'video']) ) return false;
        if( !$this->hasMedia($this->type) ) return false;
        return $this->getFirstMedia($this->type)->mime_type;
    }
    
    public function fileName()
    {
        if( !in_array($this->type, ['image', 'video']) ) return '';
        if( !$this->hasMedia($this->type) ) return '';
        return $this->getFirstMedia($this->type)->file_name;
    }

    public function posterImage()
    {
        return false;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')->width('400')->height('400')->keepOriginalImageFormat();
                $this->addMediaConversion('large')->width('1000')->height('1000')->keepOriginalImageFormat();
            });

        $this->addMediaCollection('video')
            ->acceptsMimeTypes(['video/mp4'])
            ->singleFile();
    }
}
