<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Http\Requests\diaryRequest;
use App\Http\Resources\v1\diaryResource;
use App\Models\diaryModel;

class diaryController extends Controller
{
    public function index() {
        return diaryResource::collection(diaryModel::all());
    }

    public function store(diaryRequest $request): \Illuminate\Http\JsonResponse
    {
        diaryModel::create($request->validated());
        return response()->json("Wish added");
    }

    public function update(diaryRequest $request, diaryModel $diary): \Illuminate\Http\JsonResponse
    {
        $diary->update($request->validated());
        return response()->json("Wish updated");
    }

    public function show(diaryModel $diary): diaryResource
    {
        return new diaryResource($diary);
    }

    public function listUserPosts(int $user_id)
    {
        return diaryModel::where('user_id', $user_id)->get();

    }

    public function destroy(diaryModel $diary): \Illuminate\Http\JsonResponse
    {
        $diary->delete();
        return response()->json("Wish deleted");
    }
}
