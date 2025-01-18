<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at'     => 'datetime',
        'created_at'            => 'datetime',
    ];



    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }

    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug',$permission)->first() ? true: false;
    }


    public function getImageAttribute($value)
    {
        if(!$value){
            return asset('placeholder/user.jpeg');
        }
        return asset('/uploads/customer/'.$value);

    }


}
