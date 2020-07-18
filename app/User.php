<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use F9Web\LaravelDeletable\Traits\RestrictsDeletion;

class User extends Authenticatable
{
    use Notifiable, RestrictsDeletion;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'device',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isDeletable() : bool
    {
        if (Str::endsWith($this->device, '5B:48:6F')) {
            return $this->denyDeletionReason('網卡實體位址結束為 5B:48:6F 使用者無法刪除。');
        }
        return true;
    }
}
