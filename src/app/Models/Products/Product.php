<?php

namespace Quidmye\ProductsEndpoint\App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];
    public $timestamps = true;

    public function category(){
        return $this->belongsTo(ProductsCategory::class);
    }

    public function formatters(){
        return $this->belongsToMany(ProductsFormatting::class, 'products_to_formatting', 'product_id', 'formatting_id');
    }

}
