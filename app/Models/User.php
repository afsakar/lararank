<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use LogsActivity;

    /**
     * @var array
     */
    protected static $logAttributes = ['name', 'email', 'role_id'];

    /**
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * @var bool
     */
    protected static $submitEmptyLogs = false;

    protected static $recordEvents = ['deleted', 'updated'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'permissions'
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
        'permission',
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::query()
                ->where(function($q) use ($query) {
                    $q
                        ->where('name', 'LIKE', '%'. $query . '%')
                        ->orWhere('email', 'LIKE', '%' . $query . '%');
                });
    }

    /**
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getPermissionAttribute()
    {
        return json_decode($this->permissions, true);
    }

    /**
     * @param $eventName
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return "{$eventName} record {$this->id} in the Users table.";
    }

    public function getLogNameToUse($eventName)
    {
        return $eventName;
    }
}
