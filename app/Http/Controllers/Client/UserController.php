<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::orderBy('fname')->get();
        return view('client.users.index', $data);
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        return view('client.users.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->fname    = $request['fname'];
        $user->lname    = $request['lname'];

        if(auth()->user()->role == 'Admin') {
            $user->role         = $request['role'];
            $user->status       = $request['status'];
            $user->committee    = $request['committee'];
        }

        if(auth()->user()->role == 'User') {
            $user->contact_number   = $request['contact_number'];
            $user->gender           = $request['gender'];
            $user->birthdate        = $request['birthdate'];
            $user->address          = $request['address'];
            $user->city             = $request['city'];
            $user->country          = $request['country'];
            $user->zip_code         = $request['zip_code'];
            
            if(isset($request['photo']) && $request->has('photo')) {
                $file  = $request->file('photo');
                $photo = time().'.'.$file->getClientOriginalExtension();
    
                $path = Storage::disk('upcloud')->putFileAs(
                    'skapp/uploads/users',
                    $file,
                    $photo,
                    'public'
                );
                
                $user->photo = Storage::disk('upcloud')->url($path);
            }

            if(isset($request['password']) && $request['password'] != null) {
                $user->password     = bcrypt($request['password']);
            }
        }

        $user->save();

        return redirect()->back()->with('success', 'Information has been saved.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(200);
    }
}
