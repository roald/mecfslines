<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Models\Page;
use App\Models\Project;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('published_at', 'desc')->paginate(20);
        return view('projects.index')->with('projects', $projects);
    }

    public function create()
    {
        $project = new Project(['published_at' => Carbon::now()]);
        return view('projects.edit')->with('project', $project);
    }

    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->allValidated());
        if( $request->hasFile('media') ) $project->addMediaFromRequest('media')->toMediaCollection('media');
        return redirect()->route('projects.show', $project);
    }

    public function show(Project $project)
    {
        return view('projects.show')->with('project', $project);
    }

    public function edit(Project $project)
    {
        return view('projects.edit')->with('project', $project);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->fill($request->allValidated())->save();
        if( $request->has('remove_media') ) $project->getFirstMedia('media')->delete();
        if( $request->hasFile('media') ) $project->addMediaFromRequest('media')->toMediaCollection('media');
        return redirect()->route('projects.show', $project);
    }

    public function remove(Project $project)
    {
        return view('projects.remove')->with('project', $project);
    }

    public function destroy(Project $project)
    {
        $project->forceDelete();
        return redirect()->route('projects.index');
    }

    public function createBlock(Project $project)
    {
        if( is_null($project->page) ) {
            $page = Page::create([
                'title' => $project->title,
                'slug' => 'project_'. $project->id,
                'order' => 1,
                'type' => 'project',
            ]);
            $page->project()->save($project);
            $project->refresh();
        }

        return redirect()->route('pages.blocks.create', $project->page);
    }

    public function tagging(Request $request, Project $project)
    {
        $request->validate(['tag_id' => 'required|exists:tags,id']);
        if( $request->method() == 'POST' ) $project->tags()->attach($request->tag_id);
        elseif( $request->method() == 'DELETE' ) $project->tags()->detach($request->tag_id);
        return redirect()->route('projects.show', $project);
    }
}
