<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function destroy($id)
    {
        $id     = auth()->user()->id;
        $user   = User::find($id);
        Storage::disk('upcloud')->delete('skapp/uploads/users/'.basename($user->photo));
        $user->photo = null;
        $user->save();

        return response()->json(200);
    }
}
