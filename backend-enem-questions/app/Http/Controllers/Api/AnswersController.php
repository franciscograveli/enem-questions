<?php

namespace App\Http\Controllers\Api;

use App\Models\Answers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswersRequest;
use App\Http\Resources\AnswersResource;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answers = Answers::all();
        return AnswersResource::collection($answers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnswersRequest $request)
    {
       $answer = StoreAnswersRequest::create($request->validated());
       return new AnswersResource($answer);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAnswersRequest $request, Answers $answers)
    {
        $answers->update($request->validated());
        return new AnswersResource($answers);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answers $answers)
    {
        $answers->delete();
        return response(null,204);
    }
}
