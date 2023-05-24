<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all naturalPersons that are assigned this group.
     */
    public function naturalPersons(): MorphToMany
    {
        return $this->morphedByMany(NaturalPerson::class, 'groupable');
    }

    /**
     * Get all legalPersons that are assigned this group.
     */
    public function legalPersons(): MorphToMany
    {
        return $this->morphedByMany(LegalPerson::class, 'groupable');
    }

}
