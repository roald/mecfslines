<?php

namespace App\Http\Controllers;

use App\Http\Requests\MultimediaRequest;
use App\Models\Multimedia;

class MultimediaController extends Controller
{
    public function show(Multimedia $multimedia)
    {
        return $this->modelRoute($multimedia->model);
    }

    public function edit(Multimedia $multimedia)
    {
        return view('multimedia.edit')->with('multimedia', $multimedia);
    }

    public function update(MultimediaRequest $request, Multimedia $multimedia)
    {
        $multimedia->fill($request->allValidated())->save();
        return redirect()->route('multimedia.show', $multimedia);
    }

    public function destroy(Multimedia $multimedia)
    {
        $model = $multimedia->model;
        $multimedia->delete();
        return $this->modelRoute($model);
    }

    public function stream(Multimedia $multimedia)
    {
        if( !$multimedia->hasMedia('video') ) abort(404);

        $video = $multimedia->getFirstMedia('video');
        return response()->file($video->getPath(), ['Content-Type' => $video->mime_type]);
    }

    private function modelRoute($model)
    {
        $class = class_basename($model);
        if( $class == 'Block' ) {
            return redirect()->route('blocks.show', $model);
        }
        abort(404);
    }
}
