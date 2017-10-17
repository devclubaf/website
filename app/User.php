<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'github_id',
        'name',
        'nickname',
        'email',
        'avatar',
        'html_url',
        'type',
        'company',
        'public_repos',
        'remember_token',
        'gender',
        'dob',
        'location',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function findByGithubId(string $gthub_id): User
    {
        return static::where('github_id', $gthub_id)->firstOrFail();
    }

    public static function checkDateOfBrith($dob)
    {
        $created = 'Thank you for joining DevClub!';

        $updated = 'Your Information has been updated!';

        $dob == '' ? $status = $created : $status = $updated;

        return $status;
    }

}
