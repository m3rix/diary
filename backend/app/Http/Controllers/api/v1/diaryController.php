<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Http\Requests\diaryRequest;
use App\Http\Resources\v1\diaryResource;
use App\Models\diaryModel;
use App\Models\User;

class diaryController extends Controller
{
    public function index() {
        $this->checkAuth();
        return diaryResource::collection(diaryModel::all());
    }

    public function store(diaryRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->checkAuth();
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
        $this->checkAuth();
        return new diaryResource($diary);
    }

    public function listUserPosts(int $user_id)
    {
        $this->checkAuth();
        return diaryModel::where('user_id', $user_id)->get();
    }

    public function destroy(diaryModel $diary): \Illuminate\Http\JsonResponse
    {
        $this->checkAuth();
        $diary->delete();
        return response()->json("Wish deleted");
    }

    private function checkAuth() {
        $loggedInUser = User::where('auth_token', request()->bearerToken())->get();
        if ($loggedInUser->isEmpty()){
            abort(response()->json(['error' => 'Unauthenticated.'], 401));
        } else {
            return true;
        }
    }
}
