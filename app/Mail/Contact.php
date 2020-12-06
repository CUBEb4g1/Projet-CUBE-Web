<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
	use Queueable, SerializesModels;

	private $content;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(array $content)
	{
		$this->content = $content;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject('[' . __('Contact form') . ']' . ' ' . $this->content['subject'])
			->replyTo($this->content['email'])
			->markdown('mails.contact', ['content' => $this->content]);
	}
}
