# INSTALL

```
composer require quidmye/products-endpoint
```

Then run the command
```
php artisan migrate
```

#ENDPOINTS

POST: https://example.app/api/v1/format/
PARAMS: 
```
[
  'products' => [
    [
      'name' => 'SAMPLE NAME',
      'price' => 9.99,
      'image' => 'https://example.app/image.png',
      'category' => 'Category'
    ]
  ]
]
```

GET: https://example.app/api/v1/format/{id}
RESPONSE: 
```
{
    "status": "Success",
    "link": "https://example.app/storage/products/ymls/1.yml"
}
```


BASIC TEST:
```angular2html
php artisan test vendor/quidmye/products-endpoint
```