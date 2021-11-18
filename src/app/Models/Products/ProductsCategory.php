<?php

namespace Quidmye\ProductsEndpoint\App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCategory extends Model
{
    use HasFactory;

    protected $table = 'products_categories';
    protected $guarded = [];


}
