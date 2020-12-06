<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Contact as MailContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
	/**
	 * Afficher le formulaire de contact
	 */
	public function form()
	{
		return view('front.contact');
	}

	/**
	 * Envoyer le formulaire de contanct
	 */
	public function send(Request $request)
	{
		$this->middleware('throttle:1,5');

		$request->validate([
			'name'    => 'required|min:3|max:255',
			'email'   => 'required|email|max:255',
			'subject' => 'required|min:5|max:255',
			'message' => 'required|min:40',
		], [], ['subject' => lcfirst(__('Mail object'))]);

		Mail::to(config('mail_app.default'))->send(new MailContact($request->all()));

		return redirect()->route('contact')
			->with('emailSent', __('front.contact.sent_notif'));
	}
}
