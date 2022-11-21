<?php
namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Request;

trait UserTrait {
    public function updateProfile(Request $request){
        $user=User::find($request->id);
        $user->profile=$request->profile;
        $user->save();
    }
}