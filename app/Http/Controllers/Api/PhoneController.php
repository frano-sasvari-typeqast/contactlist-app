<?php

namespace App\Http\Controllers\Api;

use App\Repository\PhoneRepository;
use App\Http\Requests\PhoneRequest;
use App\Http\Resources\PhoneResource;

class PhoneController extends Controller
{
    /**
     * Get all phones
     *
     * @param  \App\Repository\PhoneRepository  $phoneRepository
     * @return \Illuminate\Http\Response
     */
    public function index(PhoneRepository $phoneRepository)
    {
        $phones = $phoneRepository->newQuery()->get();

        return new PhoneResource($phones);
    }

    /**
     * Show phone by id
     *
     * @param  \App\Repository\PhoneRepository  $phoneRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PhoneRepository $phoneRepository, $id)
    {
        $phone = $phoneRepository->newQuery()
            ->filterById($id)
            ->loadRelations()
            ->first();

        return new PhoneResource($phone);
    }

    /**
     * Create new phone
     *
     * @param  \App\Http\Requests\PhoneRequest  $request
     * @param  \App\Repository\PhoneRepository  $phoneRepository
     * @return \Illuminate\Http\Response
     */
    public function create(PhoneRequest $request, PhoneRepository $phoneRepository)
    {
        $input = $request->validationData();

        $phone = $phoneRepository->newQuery()
            ->create($input);

        return new PhoneResource($phone);
    }

    /**
     * Update phone by id
     *
     * @param  \App\Http\Requests\PhoneRequest  $request
     * @param  \App\Repository\PhoneRepository  $phoneRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhoneRequest $request, PhoneRepository $phoneRepository, $id)
    {
        $input = $request->validationData();

        $phone = $phoneRepository->newQuery()
            ->filterById($id)
            ->update($input);

        return new PhoneResource($phone);
    }

    /**
     * Delete phone by id
     *
     * @param  \App\Repository\PhoneRepository  $phoneRepository
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(PhoneRepository $phoneRepository, $id)
    {
        $phone = $phoneRepository->newQuery()
            ->filterById($id)
            ->delete();

        return new PhoneResource($phone);
    }
}
