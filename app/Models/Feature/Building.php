<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Feature;
use App\Models\Feature\BuildingModel;

class Building extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_id',
        'feature_id',
        'construction_start_date',
        'construction_end_date',
        'launched_satisfaction',
        'information',
        'rotation',
        'position',
        'bubble_diameter'
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts()
    {
        return [
            'information' => 'array',
            'position' => 'array',
            'construction_start_date' => 'datetime',
            'construction_end_date' => 'datetime',
            'bubble_diameter' => 'float'
        ];
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buildings';

    /**
     * Get the feature that owns the Building
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    /**
     * Get the building model that owns the Building
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function buildingModel()
    {
        return $this->belongsTo(BuildingModel::class, 'model_id');
    }

    /**
     * Scope to buildings whose construction has finished.
     */
    public function scopeConstructionCompleted($query)
    {
        return $query->where('construction_end_date', '<', now());
    }
}
