<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EBook extends Model
{
    use HasFactory;
    protected $table = 'ebooks';
    public $timestamps = false;

    protected $fillable = [
        'title', 'author', 'description'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

}
