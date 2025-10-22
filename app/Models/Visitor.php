<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitor extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function ipAddress(): BelongsTo
    {
        return $this->belongsTo(IpAddress::class);
    }

    public function userAgent(): BelongsTo
    {
        return $this->belongsTo(UserAgent::class);
    }

    //

    public function robot()
    {
        return ['Not Robot', 'Robot'][$this->robot];
    }

    public function robotColor()
    {
        return ['success', 'danger'][$this->robot];
    }

    public function api()
    {
        return ['Not API', 'API'][$this->api];
    }

    public function apiColor()
    {
        return ['success', 'danger'][$this->api];
    }

    public function disabled()
    {
        return ['False', 'True'][$this->disabled];
    }

    public function disabledColor()
    {
        return ['success', 'danger'][$this->disabled];
    }
}
