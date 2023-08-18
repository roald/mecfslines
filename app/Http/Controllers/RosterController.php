<?php

namespace App\Http\Controllers;

use App\Http\Requests\RosterRequest;
use App\Models\Roster;
use Carbon\Carbon;

class RosterController extends Controller
{
    public function index()
    {
        $current = Roster::where('ended_at', '>', Carbon::now())->orderBy('weekday', 'asc')->orderBy('start_time', 'asc')->get();
        $archive = Roster::where('ended_at', '<', Carbon::now())->orderBy('started_at', 'asc')->orderBy('ended_at', 'asc')->get();
        return view('rosters.index')->with('current', $current)->with('archive', $archive);
    }

    public function create()
    {
        $roster = new Roster([
            'started_at' => Carbon::now()->startOfWeek(),
        ]);
        return view('rosters.edit')->with('roster', $roster);
    }

    public function store(RosterRequest $request)
    {
        $roster = Roster::create($request->allValidated());
        return redirect()->route('rosters.show', $roster);
    }

    public function show(Roster $roster)
    {
        return view('rosters.show')->with('roster', $roster);
    }

    public function edit(Roster $roster)
    {
        return view('rosters.edit')->with('roster', $roster);
    }

    public function update(RosterRequest $request, Roster $roster)
    {
        $roster->fill($request->allValidated())->save();
        return redirect()->route('rosters.show', $roster);
    }

    public function remove(Roster $roster)
    {
        return view('rosters.remove')->with('roster', $roster);
    }

    public function destroy(Roster $roster)
    {
        $roster->delete();
        return redirect()->route('rosters.index');
    }
}
