<?php

namespace App\Services\Contact;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    /**
     * Send contact email
     * @param Contact $contact
     * @return void
     */
    public function sendMail(Contact $contact): void
    {
        Mail::to($contact->email)->send(new ContactMail($contact));
    }
}
