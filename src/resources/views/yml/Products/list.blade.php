<?xml version="1.0" encoding="UTF-8"?>
<yml_catalog date="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i:s.uP') }}">
    <shop>
        <name>SELLER NAME</name>
        <company>INC</company>
        <url>http://localhost</url>
        <currencies>
            <currency id="RUR" rate="1"/>
        </currencies>
        <categories>
            @foreach($categories as $category)
            <category id="{{ $category['id'] }}">{{ $category['name'] }}</category>
            @endforeach
        </categories>
        <delivery-options>
            <option cost="200" days="1"/>
        </delivery-options>
        <offers>
            @foreach($products as $product)
            <offer id="{{ $product['id'] }}">
                <name>{{ $product['name'] }}</name>
                <url>{{ $product['image_path'] }}</url>
                <price>{{ $product['price'] * 100 }}</price>
                <currencyId>RUR</currencyId>
                <categoryId>{{ $product['category_id'] }}</categoryId>
                <delivery>true</delivery>
                <delivery-options>
                    <option cost="300" days="1" order-before="18"/>
                </delivery-options>
            </offer>
            @endforeach
        </offers>
    </shop>
</yml_catalog>
