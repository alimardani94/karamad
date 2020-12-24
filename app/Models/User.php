<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $surname
 * @property string $cell
 * @property string|null $email
 * @property int|null $province_id
 * @property int|null $city_id
 * @property int|null $school_id
 * @property string|null $grade
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $cell_verified_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\City|null $city
 * @property-read string $full_name
 * @property-read \App\Models\Instructor|null $instructor
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Province|null $province
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\School|null $school
 * @property-read \App\Models\UserEmailReset|null $userEmailReset
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCellVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = [
        'password',
        'remember_token',
        'cell_verified_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'cell_verified_at' => 'datetime',
    ];

    public $appends = ['full_name'];

    /**
     * @param $value
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * @return HasOne
     */
    public function instructor()
    {
        return $this->hasOne(Instructor::Class);
    }

    /**
     * @return bool
     */
    public function isInstructor()
    {
        return $this->instructor != null;
    }

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'owner_id');
    }

    /**
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @param string $value
     * @return string
     */
    public function getImageAttribute(string $value)
    {
        if ($value) {
            return asset('media/' . $value);
        } elseif ($this->isAdmin()) {
            return asset('assets/img/avatars/avatar5.png');
        } else {
            return asset('assets/img/avatars/avatar.png');
        }
    }

    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param int $roleId
     * @return bool
     */
    public function hasRole(int $roleId): bool
    {
        foreach ($this->roles as $role) {
            if ($role->id == $roleId) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $permissions
     * @return bool
     */
    public function hasPermission(string $permissions): bool
    {
        $permissions = explode('|', $permissions);

        foreach ($this->roles as $role) {
            foreach ($role->permissions() as $p) {
                if (in_array($p, $permissions)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function isAdmin(): bool
    {
        return $this->roles()->count() > 0;
    }

    public function isSuperAdmin(): bool
    {
        $this->load('roles');

        return $this->roles()->where('title', 'super_admin')->exists();
    }

    /**
     * @return HasOne
     */
    public function userEmailReset()
    {
        return $this->hasOne(UserEmailReset::class);
    }

    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
