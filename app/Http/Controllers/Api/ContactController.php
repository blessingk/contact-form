<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Contact\{StoreContactRequest, UpdateContactRequest};
use App\Http\Resources\Contact\ContactResource;
use App\Models\Contact;
use App\Repositories\Contact\ContactRepository;
use App\Services\Contact\ContactService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;
    /**
     * @var ContactService
     */
    private $contactService;

    public function __construct(
        ContactRepository $contactRepository,
        ContactService $contactService
    )
    {
        $this->contactRepository = $contactRepository;
        $this->contactService    = $contactService;
    }

    /**
     * Get all contacts
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return ContactResource::collection($this->contactRepository->search($request));
    }

    /**
     * Store new contact
     * @param StoreContactRequest $request
     * @return ContactResource
     */
    public function store(StoreContactRequest $request): ContactResource
    {
        $contact = $this->contactRepository->store($request->all());
        $this->contactService->sendMail($contact);
        return new ContactResource($contact);
    }

    /**
     * Get single contact
     * @param Contact $contact
     * @return ContactResource
     */
    public function show(Contact $contact): ContactResource
    {
        return new ContactResource($contact);
    }

    /**
     * Update contact
     * @param UpdateContactRequest $request
     * @param Contact $contact
     * @return Response
     */
    public function update(UpdateContactRequest $request, Contact $contact): Response
    {
        $this->contactRepository->update($contact, $request->all());
        return response($contact, Response::HTTP_ACCEPTED);
    }

    /**
     * Delete contact
     * @param Contact $contact
     * @return Response
     */
    public function destroy(Contact $contact): Response
    {
        $this->contactRepository->delete($contact);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
