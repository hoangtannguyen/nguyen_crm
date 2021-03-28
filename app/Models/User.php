<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'displayname',
        'name',
        'email',
        'password',
        'image',
        'address',
        'phone',
        'department_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the metas of user
     */
    public function user_metas(){
        return $this->hasMany('App\Models\UserMeta', 'user_id', 'id');
    }

    public function user_equipment(){
        return $this->hasMany('App\Models\Equipment', 'user_id', 'id');
    }

    public function user_action(){
        return $this->hasMany('App\Models\Action','user_id','id');
    }

    public function users_department(){
        return $this->hasOne('App\Models\Department','nursing_id','id');
    }

    public function departments(){
        return $this->hasOne('App\Models\Department','user_id','id');
    }

    public function user_department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }

}
