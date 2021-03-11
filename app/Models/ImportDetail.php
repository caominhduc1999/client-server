<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'import_id',
        'notes'
    ];

    protected $table = 'import_details';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function import()
    {
        return $this->belongsTo(Import::class, 'import_id');
    }
}
