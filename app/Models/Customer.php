<?php

namespace App\Models;

use App\Events\CustomerDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'company'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    protected $dispatchesEvents = [
        'deleting' => CustomerDeleted::class,
    ];
}
