<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use App\Models\Loan;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        // 'firstname',
        // 'surename',
        // 'MobileNumber',
        // 'Address',
        // 'Education',
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
    public function toSearchableArray()
    {
        return [
            'name'     => $this->surename,
        ];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => Role::class
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
    public function isAdmin()
    {
        return auth()->user()->role === Role::Admin ? true : false;
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return Storage::exists("/public/Avatars/" . $value)  ? '/storage/Avatars/' . $value : '/fallback-avatar.jpg';
            }
        );
    }
}
