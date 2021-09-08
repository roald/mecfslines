<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use App\Http\Requests\Form\ContactRequest;
use App\Mail\ContactConfirmation;
use App\Mail\ContactMessage;
use App\Models\Page;
use Auth;

class FormController extends Controller
{
    public function contact(ContactRequest $request, Page $page)
    {
        if( $redirect = $this->checks($page) ) return $redirect;
    
        // Send the message via email to the contact address with reply-to to sender
        Mail::send(new ContactMessage($request));

        // Send a confirmation message to the sender
        Mail::send(new ContactConfirmation($request));

        // Set notification for message sent
        return redirect()->route('web.page', $page)->with('status', __('Message has been sent!'));
    }

    private function checks(Page $page)
    {
        if( $page == 'concept' && !(Auth::check() && Auth::user()->isAdmin()) ) abort(404);
        if( $page == 'user' && !Auth::check() ) return redirect()->route('login');
    }
}
