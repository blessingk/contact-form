<?php

namespace App\Repositories\Contact;

use App\Models\Contact;

class ContactRepository
{
    /**
     * @var Contact
     */
    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->contact->all();
    }

    /**
     * @param int $contactId
     * @return Contact
     */
    public function get(int $contactId): Contact
    {
        return $this->contact->find($contactId);
    }

    /**
     * @param array $contactData
     * @return mixed
     */
    public function store(array $contactData)
    {
        return $this->contact->create($contactData);
    }

    /**
     * @param Contact $contact
     * @param array $contactData
     * @return bool
     */
    public function update(Contact $contact, array $contactData)
    {
        return $contact->update($contactData);
    }

    /**
     * @param Contact $contact
     * @return bool|null
     */
    public function delete(Contact $contact)
    {
        return $contact->delete();
    }
}
