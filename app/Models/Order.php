<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    public $timestamps = true;
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $table = 'orders';
    protected $fillable = ['admin_id', 'customer_id', 'order_note', 'status', 'date'];

    public function admins() {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function customers() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
