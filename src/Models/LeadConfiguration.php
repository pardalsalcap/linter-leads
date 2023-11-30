<?php

namespace Pardalsalcap\LinterLeads\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $parameter
 * @property mixed $value
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class LeadConfiguration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead_configuration';

    /**
     * @var array
     */
    protected $fillable = ['parameter', 'value', 'is_active', 'created_at', 'updated_at'];
}
