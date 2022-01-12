<?php

namespace App\Services\Contact;

use App\Models\Contact;

class ContactService
{
    /**
     * @var Contact
     */
    private $contact;

    /**
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function sendMail()
    {

    }
}
