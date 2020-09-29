<?php

namespace App\Http\Controllers;

use F9Web\LaravelDeletable\Exceptions\NoneDeletableModel;
use App\Models\User;

class UserController extends Controller
{
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        try {
            $user->delete();
        } catch (NoneDeletableModel $ex) {
            echo $ex->getMessage() . PHP_EOL;
        }
    }  
}
