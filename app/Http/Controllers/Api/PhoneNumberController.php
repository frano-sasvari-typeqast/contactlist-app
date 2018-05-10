<?php

namespace App\Http\Controllers\Api;

use App\Repository\PhoneNumberRepository;
use App\Http\Requests\PhoneNumberRequest;
use App\Http\Resources\PhoneNumberResource;

class PhoneNumberController extends Controller
{
    /**
     * Show phone by id
     *
     * @param  \App\Repository\PhoneNumberRepository  $phoneNumberRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PhoneNumberRepository $phoneNumberRepository, $id)
    {
        $phoneNumber = $phoneNumberRepository->newQuery()
            ->filterById($id)
            ->loadRelations()
            ->first();

        if (! $phoneNumber) {
            abort(response()->json([
                'meta' => [
                    'error' => true,
                    'code' => 404,
                    'message' => 'Phone number with ID "'.$id.'" was not found.'
                ],
            ]), 404);
        }

        return new PhoneNumberResource($phoneNumber);
    }

    /**
     * Create new phone
     *
     * @param  \App\Http\Requests\PhoneNumberRequest  $request
     * @param  \App\Repository\PhoneNumberRepository  $phoneNumberRepository
     * @return \Illuminate\Http\Response
     */
    public function create(PhoneNumberRequest $request, PhoneNumberRepository $phoneNumberRepository)
    {
        $input = $request->validationData();

        $phoneNumber = $phoneNumberRepository->newQuery()
            ->create($input);

        return new PhoneNumberResource($phoneNumber);
    }

    /**
     * Update phone by id
     *
     * @param  \App\Http\Requests\PhoneNumberRequest  $request
     * @param  \App\Repository\PhoneNumberRepository  $phoneNumberRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhoneNumberRequest $request, PhoneNumberRepository $phoneNumberRepository, $id)
    {
        $input = $request->validationData();

        $phone = $phoneNumberRepository->newQuery()
            ->filterById($id)
            ->update($input);

        return new PhoneNumberResource($phone);
    }

    /**
     * Delete phone by id
     *
     * @param  \App\Repository\PhoneNumberRepository  $phoneNumberRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(PhoneNumberRepository $phoneNumberRepository, $id)
    {
        $phoneNumber = $phoneNumberRepository->newQuery()
            ->filterById($id)
            ->first();

        if (! $phoneNumber) {
            abort(response()->json([
                'meta' => [
                    'error' => true,
                    'code' => 404,
                    'message' => 'Phone number with ID "'.$id.'" was not found.'
                ],
            ], 404));
        }

        $phoneNumber->delete();

        return new PhoneNumberResource($phoneNumber);
    }
}
