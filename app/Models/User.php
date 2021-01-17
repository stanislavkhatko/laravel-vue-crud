<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'username',
        'gender',
        'dob',
        'role_id'
    ];

    /**
     * @var array[]
     */
    protected $appends = [
        'is_admin'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }

    /**
     * Helper method if user is Admin
     *
     * @return bool
     */
    public function isAdmin() {
        return $this->role->role === 'admin';
    }

    /**
     * @return bool
     */
    public function getIsAdminAttribute() {
        return $this->isAdmin();
    }

    /**
     * @return mixed
     */
    public function getTimesReadAttribute() {
        return Transaction::all()->where('user_id', $this->id)->where('type', 'time')->sum('amount');
    }

    /**
     * @return int
     */
    public function getLinesReadAttribute() {
        return Transaction::all()->where('user_id', $this->id)->where('type', 'line')->count();
    }

    /**
     * @return mixed
     */
    public function getRewardAttribute() {
        return Transaction::all()->where('user_id', $this->id)->sum('amount');
    }



    /**
     * Helper method to compare a role
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role) {
        return $this->role->role === $role;
    }

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
//        'created_at' => 'datetime:d-m-Y',
    ];

}
