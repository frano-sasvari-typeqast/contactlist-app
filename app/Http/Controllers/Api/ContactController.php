<?php

namespace App\Http\Controllers\Api;

use App\Repository\ContactRepository;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;

class ContactController extends Controller
{
    /**
     * Get all contacts
     *
     * @param  \App\Repository\ContactRepository  $contactRepository
     * @return \Illuminate\Http\Response
     */
    public function index(ContactRepository $contactRepository)
    {
        $contacts = $contactRepository->newQuery()
            ->get();

        return new ContactResource($contacts);
    }

    /**
     * Show contact by id
     *
     * @param  \App\Repository\ContactRepository  $contactRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ContactRepository $contactRepository, $id)
    {
        $contact = $contactRepository->newQuery()
            ->filterById($id)
            ->loadRelations()
            ->first();

        dd($contact);

        return new ContactResource($contact);
    }

    /**
     * Create new contact
     *
     * @param  \App\Http\Requests\ContactRequest  $request
     * @param  \App\Repository\ContactRepository  $contactRepository
     * @return \Illuminate\Http\Response
     */
    public function create(ContactRequest $request, ContactRepository $contactRepository)
    {
        $input = $request->validationData();

        $contact = $contactRepository->newQuery()
            ->create($input);

        return new ContactResource($contact);
    }

    /**
     * Update contact by id
     *
     * @param  \App\Http\Requests\ContactRequest  $request
     * @param  \App\Repository\ContactRepository  $contactRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, ContactRepository $contactRepository, $id)
    {
        $input = $request->validationData();

        $contact = $contactRepository->newQuery()
            ->filterById($id)
            ->update($input);

        return new ContactResource($contact);
    }

    /**
     * Delete contact by id
     *
     * @param  \App\Repository\ContactRepository  $contactRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(ContactRepository $contactRepository, $id)
    {
        $contact = $contactRepository->newQuery()
            ->filterById($id)
            ->delete();

        return new ContactResource($contact);
    }
}
