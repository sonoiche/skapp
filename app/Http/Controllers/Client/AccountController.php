<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        return view('client.account.index');
    }

    public function store(Request $request)
    {
        $id     = auth()->user()->id;
        $user   = User::find($id);
        $user->fname    = $request['fname'];
        $user->lname    = $request['lname'];
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

        $user->save();

        return redirect()->back()->with('success', 'Information has been saved.');
    }
}
