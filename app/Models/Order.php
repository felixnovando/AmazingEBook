<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'ebook_id', 'order_date'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function ebook(){
        return $this->belongsTo(EBook::class, 'ebook_id', 'ebook_id');
    }
}
