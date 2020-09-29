<?php

namespace App\Models;

use F9Web\LaravelDeletable\Traits\RestrictsDeletion;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, RestrictsDeletion;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
        if (Str::endsWith($this->device, '7A:DE:D2')) {
            return $this->denyDeletionReason('網卡實體位址結束為 7A:DE:D2 使用者無法刪除。');
        }
        return true;
    }
}
