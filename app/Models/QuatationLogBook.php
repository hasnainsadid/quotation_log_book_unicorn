<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuatationLogBook extends Model
{
    use SoftDeletes;

    // এই role-গুলো সব quotation দেখতে ও যেকোনো user-এর নামে add করতে পারবে
    public const FULL_ACCESS_ROLES = ['Super Admin', 'Chairman', 'Managing Director', 'Deputy Managing Director'];

    public const EXPORT_ROLES = ['Super Admin', 'Chairman', 'Managing Director', 'Deputy Managing Director'];

    protected $guarded = [];

    protected $casts = [
        'contact_numbers' => 'array',
        'contact_persons' => 'array',
        'offers'          => 'array',
        'pq_date'         => 'date:Y-m-d',
    ];

    public function pqUser()
    {
        return $this->belongsTo(User::class, 'pq_user_id');
    }

    public static function canViewAll(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(self::FULL_ACCESS_ROLES);
    }

    public function scopeVisible(Builder $query): Builder
    {
        if (! self::canViewAll()) {
            $query->where($query->getModel()->getTable() . '.pq_user_id', auth()->id());
        }

        return $query;
    }
}