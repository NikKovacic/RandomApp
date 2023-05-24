<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Notifications\Notifiable;

class LegalPerson extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'tin',
    ];

    /**
     * Get all legal person groups.
     */
    public function groups(): MorphToMany
    {
        return $this->morphToMany(Group::class, 'groupable');
    }

    //@todo: Add setter/getter for name (title-case)!
    //@todo: Add setter/getter for phone (phone library include formatting functions)!
}
