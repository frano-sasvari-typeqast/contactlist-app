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
        $contactsQueryBuilder = $contactRepository->newQuery();

        if ($this->request->get('keyword')) {
            $contactsQueryBuilder = $contactsQueryBuilder->filterByKeyword($this->request->get('keyword'));
        }

        $contacts = $contactsQueryBuilder->paginate();
        $contacts->appends($this->request->except('page'));

        $contactResource = new ContactResource($contacts);

        return $contactResource->collection($contacts);
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

        if (! $contact) {
            abort(response()->json([
                'meta' => [
                    'error' => true,
                    'code' => 404,
                    'message' => 'Contact with ID "'.$id.'" was not found.'
                ],
            ]), 404);
        }

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
            ->first();

        if (! $contact) {
            abort(response()->json([
                'meta' => [
                    'error' => true,
                    'code' => 404,
                    'message' => 'Contact with ID "'.$id.'" was not found.'
                ],
            ], 404));
        }

        $contact->delete();

        return new ContactResource($contact);
    }
}
