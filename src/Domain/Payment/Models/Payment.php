<?php

namespace Domain\Payment\Models;

use Domain\Payment\States\PaymentState;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Payment extends Model
{
    use HasFactory, HasStates, HasUlids;

    protected $fillable = [
        'payment',
        'payment_gateway',
        'meta',
    ];

    protected $casts = [
        'meta' => 'collection',
        'state' => PaymentState::class,
    ];

    public function uniqueIds(): array
    {
        return [
            'payment_id'
        ];
    }
}
