<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'sms', 'ref', 'avatar_id', 'can_create_users', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Contact Preferences
    public function prefs()
    {
        return $this->hasMany('App\ContactPref');
    }

    // Friends List
    public function following()
    {
        return $this->belongsToMany('App\User', 'friends_list', 'friender_id', 'friendee_id');
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'friends_list', 'friendee_id', 'friender_id');
    }

    // Incidents user is assigned to
    public function incidents()
    {
        return $this->belongsToMany('App\Incident');
    }

    // Indidents the user has created
    public function incidents_created()
    {
        return $this->hasMany('App\Incident', 'creator_id');
    }

    // Locations this user has been at
    public function locations()
    {
        return $this->belongsToMany('App\Location');
    }

    // Networks the user is a member of
    public function networks()
    {
        return $this->belongsToMany('App\Network');
    }

    // The networks that the user has created
    public function networks_created()
    {
        return $this->belongsTo('App\Network', 'creator_id');
    }
}
