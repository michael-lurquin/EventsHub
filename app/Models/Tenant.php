<?php

namespace App\Models;

use App\Traits\HasAddresses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tenant extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasAddresses;

    protected $fillable = [
        'name',
        'email',
        'subdomain',
        'owner_id',
        'ends_at',
        'about',
        'logo_url',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $dates = [
        'ends_at',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'subdomain';
    }

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function isExceeded()
    {
        return !empty($this->ends_at) ? !$this->ends_at->isToday() && $this->ends_at->isPast() : false;
    }

    public function isOwner()
    {
        return !empty($this->owner_id) && (int) auth()->user()->id === (int) $this->owner_id;
    }
}
