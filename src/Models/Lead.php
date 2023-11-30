<?php

namespace Pardalsalcap\LinterLeads\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $assigned_to
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phone
 * @property string $company
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $subject
 * @property string $message
 * @property string $source
 * @property string $ip
 * @property bool $is_read
 * @property bool $is_spam
 * @property bool $is_success
 * @property bool $is_flagged
 * @property int $score
 * @property string $status
 * @property mixed $data
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $user
 * @property LeadInteraction[] $leadInteractions
 */
class Lead extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['assigned_to', 'name', 'surname', 'email', 'phone', 'company', 'city', 'state', 'country', 'subject', 'message', 'source', 'ip', 'is_read', 'is_spam', 'is_success', 'is_flagged', 'score', 'status', 'data', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'data' => 'array',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'assigned_to');
    }

    public function leadInteractions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\LeadInteraction');
    }
}
