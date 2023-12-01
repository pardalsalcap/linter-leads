<?php

namespace Pardalsalcap\LinterLeads\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $word
 * @property string $slug
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class LeadSpamBlackList extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead_spam_black_list';

    /**
     * @var array<string>
     */
    protected $fillable = ['word', 'slug', 'is_active', 'created_at', 'updated_at'];
}
