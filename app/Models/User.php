<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'nama',
        'email',
        'password',
        'profile_picture', 
        'role', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Mengembalikan URL gambar profil user.
     */
    public function getProfilePictureUrl()
    {
        return $this->profile_picture
            ? asset('storage/profile/' . $this->profile_picture)
            : asset('images/default-profile.png');
    }

    /**
     *  Menampilkan nama role berdasarkan kode.
     */
    public function getRoleName()
    {
        $roles = [
            'admin' => 'Administrator',
            'user' => 'User',
        ];

        return $roles[$this->role] ?? 'Tidak Diketahui';
    }
}
