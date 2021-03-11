<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $table = 'imports';

    protected $fillable = [
        'name',
        'vendor_id',
        'import_date',
        'notes'
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function importDetail()
    {
        return $this->hasMany(ImportDetail::class, 'import_id');
    }
}
