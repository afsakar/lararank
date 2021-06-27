<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * @var array
     */
    protected static $logAttributes = ['name', 'description'];

    /**
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * @var bool
     */
    protected static $submitEmptyLogs = false;

    protected $fillable = [
        'name',
        'description',
        'permissions'
    ];

    protected $appends = ['perms'];

    /**
     * @return mixed
     */
    public function getPermsAttribute()
    {
        return json_decode($this->permissions, true);
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::query()
                ->where(function($q) use ($query) {
                    $q
                        ->where('name', 'LIKE', '%'. $query . '%');
                });
    }

    /**
     * @param $eventName
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return "{$eventName} record {$this->id} in the Roles table.";
    }

    public function getLogNameToUse($eventName)
    {
        return $eventName;
    }
}
