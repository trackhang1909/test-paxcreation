<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return response()->json($users, 200);
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user->save();
        return response()->json($user, 201);
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user, 200);
        }
        catch (ModelNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function update(StoreUserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->fill($request->all());
            $user->save();
            return response()->json($user, 200);
        }
        catch (ModelNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'Delete succeeded'], 200);
        }
        catch (ModelNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function uploadImage(Request $request) {
        $fileName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);

        return response()->json(['image' => $fileName]);
    }
}
