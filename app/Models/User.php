<?php

namespace App\Models;

use F9Web\LaravelDeletable\Traits\RestrictsDeletion;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isDeletable() : bool
    {
        if (Str::endsWith($this->device, 'F8:C7:77')) {
            return $this->denyDeletionReason(__('The user with the MAC address ends at :universally_administered_address cannot be deleted.', ['universally_administered_address' => 'F8:C7:77']));
        }
        return true;
    }
}
