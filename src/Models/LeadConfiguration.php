<?php

namespace Pardalsalcap\LinterLeads\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $parameter
 * @property mixed $value
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class LeadConfiguration extends Model
{
    protected $table = 'lead_configuration';

    protected $casts = [
        'value' => 'array',
    ];

    protected $fillable = ['parameter', 'value', 'is_active', 'created_at', 'updated_at'];
}
