<?php

namespace App\Repositories\Contact;

use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

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
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function search(Request $request): LengthAwarePaginator
    {
        $query = $this->contact::query();

        if ($request->search) {
            $query = $query->where(
                    function($query) use ($request) {
                        return $query
                            ->where("contacts.name", "LIKE", "%$request->search%")
                            ->orWhere("contacts.email", "LIKE", "%$request->search%")
                            ->orWhere("contacts.gender", "LIKE", "%$request->search%")
                            ->orWhere("contacts.content", "LIKE", "%$request->search%");
                    }
                );
        }

        if ($request->gender) {
            $query = $query->whereGender($request->gender);
        }
        return $query->paginate(10);
    }

    /**
     * @return Contact[]
     */
    public function getAll()
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
     * @return Contact
     */
    public function store(array $contactData): Contact
    {
        return $this->contact->create($contactData);
    }

    /**
     * @param Contact $contact
     * @param array $contactData
     * @return Contact
     */
    public function update(Contact $contact, array $contactData): Contact
    {
        $contact->update($contactData);
        return $contact;
    }

    /**
     * @param Contact $contact
     * @return bool|null
     */
    public function delete(Contact $contact): ?bool
    {
        return $contact->delete();
    }
}
