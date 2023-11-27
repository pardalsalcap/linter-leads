<?php

namespace Pardalsalcap\LinterLeads\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $configuration
 * @property string $created_at
 * @property string $updated_at
 */
class LeadSpamFilter extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'configuration', 'created_at', 'updated_at'];
}
