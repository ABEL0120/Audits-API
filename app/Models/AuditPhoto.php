<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditPhoto extends Model
{
    use HasFactory, \App\Traits\HashId;

    protected $fillable = ['audit_item_id', 'path', 'caption', 'taken_at', 'meta'];

    protected $hashKeys = ['audit_item_id'];

    protected $casts = [
        'taken_at' => 'datetime',
        'meta' => 'array',
    ];

    public function item()
    {
        return $this->belongsTo(AuditItem::class, 'audit_item_id');
    }
}
