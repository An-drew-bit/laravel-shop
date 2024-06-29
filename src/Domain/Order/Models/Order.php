<?php

namespace Domain\Order\Models;

use Support\Casts\PriceCast;
use Domain\User\Models\User;
use Domain\Order\States\OrderState;
use Domain\Order\Enums\OrderStatus;
use Domain\Order\Builder\OrderBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int id
 * @property int user_id
 * @property int delivery_type_id
 * @property int payment_method_id
 * @property int|float amount
 * @property OrderState status
 * @property User user
 * @property OrderCustomer orderCustomer
 *
 * @method static Order|OrderBuilder query()
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'delivery_type_id',
        'payment_method_id',
        'amount',
        'status',
    ];

    protected $casts = [
        'amount' => PriceCast::class,
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => OrderStatus::from($value)->createState($this),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryType(): BelongsTo
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function orderCustomer(): HasOne
    {
        return $this->hasOne(OrderCustomer::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function newEloquentBuilder($query): OrderBuilder
    {
        return new OrderBuilder($query);
    }
}
