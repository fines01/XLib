<?php

namespace App\Traits;

use App\Models\TitleUser;
use Illuminate\Support\Facades\Auth;

trait GetUser 
{
 /**
    * Get authenticated User
    * @return 
    */
    public function getAuthUser()
    {
     //$authUser = User::find(Auth::id());
     return auth()->user()->id; //
    }
}

//user-types: owner/lender, borrower etc.