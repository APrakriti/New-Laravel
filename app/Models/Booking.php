<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Booking extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at','deleted_at'];

    /**
     * Get the package that owns the booking.
     */
    public function package()
    {
        return $this->belongsTo('App\Models\Package','package_id');
    }

    /**
     * Get the customer that owns the booking.
     */
    public function customer()
    {
        return $this->belongsTo('App\User','user_id');
    }

    /**
     * Get the country that owns the booking customer.
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }

    /**
     * Get the payment for the booking.
     */
    public function payment()
    {
        return $this->hasOne('App\Models\BookingPayment', 'booking_id');
    }
}
