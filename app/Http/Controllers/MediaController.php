<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function show($mediaId)
    {
        $media = Media::find($mediaId);
        $model = $media->model;
        $route = $this->modelRoute($model);
        return redirect()->route($route, $model);
    }

    public function edit($mediaId)
    {
        $media = Media::find($mediaId);
        return view('media.edit')->with('media', $media);
    }

    public function update(Request $request, $mediaId)
    {
        $request->validate(['name' => 'required|min:3']);
        $media = Media::find($mediaId);
        $media->update(['name' => $request->name]);
        return redirect()->route('media.show', $media);
    }

    public function destroy($mediaId)
    {
        $media = Media::find($mediaId);
        $model = $media->model;
        $route = $this->modelRoute($model);

        $media->delete();
        return redirect()->route($route, $model);
    }

    private function modelRoute($model)
    {
        $class = class_basename($model);
        return strtolower($class) .'s.show';
    }
}
