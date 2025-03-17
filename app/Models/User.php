<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'is_active',
        'activation_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activation_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the activity batches that the user is an alumni of.
     */
    public function batchesAsAlumni()
    {
        return $this->belongsToMany(ActivityBatch::class, 'batch_alumni')
            ->withPivot('instagram_account', 'gender', 'notes')
            ->withTimestamps();
    }

    /**
     * Get the alumni records for this user.
     */
    public function batchAlumni()
    {
        return $this->hasMany(BatchAlumni::class);
    }

    /**
     * Get the taaruf profile associated with the user.
     */
    public function taarufProfile()
    {
        return $this->hasOne(TaarufProfile::class);
    }
}
