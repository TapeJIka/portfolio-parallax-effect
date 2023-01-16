<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessageRequest;
use App\Http\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use MongoDB\Driver\Exception\ConnectionTimeoutException;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ContactMessageResource::collection(ContactMessage::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ContactMessageResource
     */
    public function store(ContactMessageRequest $request)
    {
        $message = ContactMessage::create($request->validated());

        return new ContactMessageResource($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ContactMessageResource
     */
    public function show($id)
    {
        return new ContactMessageResource(ContactMessage::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return ContactMessageResource
     */
    public function update(ContactMessageRequest $request, $id)
    {
        ContactMessage::find($id)->update($request->validated());
        return new ContactMessageResource(ContactMessage::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return ContactMessageResource
     */
    public function destroy($id)
    {
        $message = ContactMessage::find($id);
        $message->delete();
        return new ContactMessageResource($message);
    }
}
