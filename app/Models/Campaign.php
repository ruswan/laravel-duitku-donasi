<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;

class Campaign extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];

    public const CAMPAIGN_DRAFT = '0';
    public const CAMPAIGN_ACTIVE = '1';
    public const CAMPAIGN_FINISHED = '2';


    /**
     * Get all of the donasis for the Campaign
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function donasis()
    {
        return $this->hasMany(Donasi::class);
    }

    /**
     * Get the campaignStatus that owns the Campaign
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaignStatus()
    {
        return $this->belongsTo(CampaignStatus::class);
    }
}
