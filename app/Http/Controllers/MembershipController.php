<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipRequest;
use App\Models\Membership;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::orderBy('name', 'asc')->get();
        return view('memberships.index')->with('memberships', $memberships);
    }

    public function create()
    {
        $membership = new Membership();
        return view('memberships.edit')->with('membership', $membership);
    }

    public function store(MembershipRequest $request)
    {
        $membership = Membership::create($request->allValidated());
        return redirect()->route('memberships.show', $membership);
    }

    public function show(Membership $membership)
    {
        return view('memberships.show')->with('membership', $membership);
    }

    public function edit(Membership $membership)
    {
        return view('memberships.edit')->with('membership', $membership);
    }

    public function update(MembershipRequest $request, Membership $membership)
    {
        $membership->fill($request->allValidated())->save();
        return redirect()->route('memberships.show', $membership);
    }

    public function remove(Membership $membership)
    {
        return view('memberships.remove')->with('membership', $membership);
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route('memberships.index');
    }
}
