<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostMail extends Mailable
{
   use Queueable, SerializesModels;

   /**
    * Create a new message instance.
    */
   public function __construct(protected string $title, protected string $content)
   {
      //
   }

   /**
    * Get the message envelope.
    */
   public function envelope(): Envelope
   {
      return new Envelope(
         subject: env('MAIL_FROM_NAME').': '.$this->title,
      );
   }

   /**
    * Get the message content definition.
    */
   public function content(): Content
   {
      return new Content(
         view: 'mail.postmail',
         with: [
            'title' => $this->title,
            'content' => $this->content,
         ]
      );
   }

   /**
    * Get the attachments for the message.
    *
    * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    */
   public function attachments(): array
   {
      return [];
   }
}
