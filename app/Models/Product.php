<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'warranty',
        'image',
        'category_id', // Add the foreign key field to fillable
    ];

    // Define the relationship with Categories
    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }
}