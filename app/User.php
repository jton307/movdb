<?php

 namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Notifications\Notifiable;

 class User extends Authenticatable
 {
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $guarded = [];
  protected $attributes = ['active' => 1];

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

  public function role()
  {
   return $this->belongsTo(Role::class);
  }

  public function getActiveAttribute($attributes)
  {
   return $this->activeOptions()[$attributes];
  }

  public function activeOptions()
  {
   return [
   '0' => ' Inactive',
   '1' => 'Active',
   '2' => 'In Process',

   ];
  }

  public function isAdmin()
  {
   if ($this->role->id == 1) {
    return true;
   }
   return false;
  }
 }
