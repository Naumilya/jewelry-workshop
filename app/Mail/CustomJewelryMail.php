<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomJewelryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->markdown('custom_message')
            ->with('data', $this->data);

        // Attach images as files
        if (isset($this->data['images'])) {
            foreach ($this->data['images'] as $image) {
                $mail->attach($image);
            }
        }

        return $mail;
    }
}
