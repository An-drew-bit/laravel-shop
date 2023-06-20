<?php

namespace Domain\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int order_id
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string phone
 * @property string address
 * @property string city
 */
class OrderCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city'
    ];
}
