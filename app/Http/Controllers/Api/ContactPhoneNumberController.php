<?php

namespace App\Http\Controllers\Api;

use App\Repository\ContactRepository;
use App\Repository\PhoneNumberRepository;
use App\Http\Resources\PhoneNumberResource;

class ContactPhoneNumberController extends Controller
{
    /**
     * Get all phone number of single contact
     *
     * @param  \App\Repository\ContactRepository  $contactRepository
     * @param  \App\Repository\PhoneNumberRepository  $phoneNumberRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(ContactRepository $contactRepository, PhoneNumberRepository $phoneNumberRepository, int $id)
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
            ]));
        }

        $phoneNumbers = $phoneNumberRepository->newQuery()
            ->filterByContact($id)
            ->get();

        $phoneNumberResource = new PhoneNumberResource($phoneNumbers);

        return $phoneNumberResource->collection($phoneNumbers);
    }
}
