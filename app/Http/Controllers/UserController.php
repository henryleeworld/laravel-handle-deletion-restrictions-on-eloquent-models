<?php

namespace App\Http\Controllers;

use App\Models\User;
use F9Web\LaravelDeletable\Exceptions\NoneDeletableModel;

class UserController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
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
