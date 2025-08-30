<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TemporaryPasswordMail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * @var string
	 */
	public $tempPassword;

	/**
	 * @var \App\Models\User
	 */
	public $user;

	/**
	 * Create a new message instance.
	 *
	 * @param string $tempPassword
	 * @param \App\Models\User $user
	 */
	public function __construct(string $tempPassword, $user)
	{
		$this->tempPassword = $tempPassword;
		$this->user = $user;
	}

	/**
	 * Build the message.
	 */
	public function build()
	{
		return $this->subject('Your temporary password')
					->view('emails.temporary-password')
					->with([
						'tempPassword' => $this->tempPassword,
						'user' => $this->user,
					]);
	}
}
