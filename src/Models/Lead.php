<?php

namespace Pardalsalcap\LinterLeads\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property User $user
 * @property LeadInteraction[] $leadInteractions
 */
class Lead extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array<string>
     */
    protected $fillable = ['assigned_to', 'name', 'surname', 'email', 'phone', 'company', 'city', 'state', 'country', 'subject', 'message', 'source', 'ip', 'is_read', 'is_spam', 'is_success', 'is_flagged', 'score', 'status', 'data', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'data' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'assigned_to');
    }

    public function leadInteractions(): HasMany
    {
        return $this->hasMany('App\Models\LeadInteraction');
    }
}
