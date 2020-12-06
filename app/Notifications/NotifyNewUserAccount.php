<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;

class NotifyNewUserAccount extends Notification
{
	use Queueable;

	/**
	 * @var User
	 */
	protected $user;

	/**
	 * @var string
	 */
	protected $password;

	/**
	 * Create a new message instance.
	 *
	 * @param User $user
	 * @param string $password
	 */
	public function __construct(User $user, string $password)
	{
		$this->user     = $user;
		$this->password = $password;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param mixed $notifiable
	 *
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail()
	{
		return (new MailMessage())
			->subject(__('back.users.new_user_notification.opened_account'))
			->markdown('mails.notify_new_user_account', ['user' => $this->user, 'password' => $this->password]);
	}
}
