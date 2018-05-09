<?php

namespace App\Http\Controllers\Api;

use App\Repository\PhoneNumberRepository;
use App\Http\Requests\PhoneNumberRequest;
use App\Http\Resources\PhoneNumberResource;

class PhoneNumberController extends Controller
{
    /**
     * Get all phones
     *
     * @param  \App\Repository\PhoneNumberRepository  $phoneNumberRepository
     * @return \Illuminate\Http\Response
     */
    public function index(PhoneNumberRepository $phoneNumberRepository)
    {
        $phoneNumbers = $phoneNumberRepository->newQuery()->get();

        return new PhoneNumberResource($phoneNumbers);
    }

    /**
     * Show phone by id
     *
     * @param  \App\Repository\PhoneNumberRepository  $phoneNumberRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PhoneNumberRepository $phoneNumberRepository, $id)
    {
        $phone = $phoneNumberRepository->newQuery()
            ->filterById($id)
            ->loadRelations()
            ->first();

        return new PhoneNumberResource($phone);
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

        $phone = $phoneNumberRepository->newQuery()
            ->create($input);

        return new PhoneNumberResource($phone);
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
        $phone = $phoneNumberRepository->newQuery()
            ->filterById($id)
            ->delete();

        return new PhoneNumberResource($phone);
    }
}
