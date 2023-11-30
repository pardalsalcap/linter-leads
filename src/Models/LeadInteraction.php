<?php

namespace Pardalsalcap\LinterLeads\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $lead_id
 * @property int $user_id
 * @property string $type
 * @property string $note
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Lead $lead
 * @property User $user
 */
class LeadInteraction extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['lead_id', 'user_id', 'type', 'note', 'status', 'created_at', 'updated_at', 'deleted_at'];

    public function lead(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Lead');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
