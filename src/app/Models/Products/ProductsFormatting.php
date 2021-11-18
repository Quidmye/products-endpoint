<?php

namespace Quidmye\ProductsEndpoint\App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsFormatting extends Model
{
    use HasFactory;

    protected $table = 'products_formatting';
    protected $guarded = [];

    public const STATUS_NEW = 'New';
    public const STATUS_IN_PROGRESS = 'In-Progress';
    public const STATUS_SUCCESS = 'Success';
    public const STATUS_FAILED = 'FAILED';

    public function products(){
        return $this->belongsToMany(Product::class, 'products_to_formatting',  'formatting_id', 'product_id');
    }

}
