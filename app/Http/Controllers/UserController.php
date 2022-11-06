<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function create()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'firstName' => 'required|string|max:255',
                'lastName' =>  'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'gender' => 'required'
            ]
        );

        if($validator->fails())
        {
            $error = $validator->errors()->first();
            return response()->json(['error' => $error], 422);
        }

        $birth_timestamp = mktime(0, 0, 0, request()->month, request()->day, request()->year);
        $birthday = date("Y-m-d H:i:s", $birth_timestamp);

        User::create([
            'surname' => request()->lastName,
            'email' => request()->email,
            'password' => bcrypt(request()->password),
            'gender' => request()->gender,
            'birthday' => $birthday,
            'slug' => md5(request()->firstName . request()->email . request()->lastName),
        ]);

        return response()->json("Thank you for registering, activation link has been sent to your email", 201);


    }

    public function search()
    {
        $param = request()->param;

        $users = User::where(function ($query)  use ($param) {
            $query->where('name', 'like', "%$param%")
                ->orWhere('surname', 'like', "%$param%");
        })->get();

        if ($users->isEmpty())
        {
            return response()->json("User not found", 404);
        }
        else
        {
            return response()->json($users, 200);
        }
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();

        if ($user === null)
        {
            return response()->json("User not found", 404);
        }

        return response()->json($user, 200);
    }

    public function delete()
    {
        $user = User::where('id', request()->id);

        if($user === null)
        {
            return response()->json("User not found", 404);
        }

        $user->delete();

        return response()->json('We are sad that you are leaving :(', 204);
    }

    public function update()
    {

    }
}
