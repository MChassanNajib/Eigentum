<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = "agents";
    protected $guarded = ['id'];
    
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'property_agent', 'property_id', 'agent_id');
    }   

    public function provinces(): BelongsToMany
    {
        return $this->belongsToMany(Province::class, 'agent_provinces', 'agent_id', 'province_id');
    }

    public function regencies(): BelongsToMany
    {
        return $this->belongsToMany(Regency::class, 'agent_regencies', 'agent_id', 'regency_id');
    }

    public function districts(): BelongsToMany
    {
        return $this->belongsToMany(District::class, 'agent_districts', 'agent_id', 'district_id');
    }

    public function villages(): BelongsToMany
    {
        return $this->belongsToMany(Village::class, 'agent_villages', 'agent_id', 'village_id');
    }

    public function scopefilter($query, array $filters){

        $query->when($filters['search'] ?? false, function($query, $search){
            $query->where('name','like','%'.$search.'%')
            // ->orWhere('description','like','%'.$search.'%')
            ->orWhere('email','like','%'.$search.'%');
        });

        $query->when($filters['regency_id'] ?? false, function ($query, $regencyId) {
            return $query->whereHas('regencies', function ($query) use ($regencyId) {
                $query->where('id', $regencyId);
            });
        });

        return $query;
    }

}
