<!DOCTYPE html>
<html>
<head>
    <title>Scraped Products</title>
</head>
<body>
<h1>Scraped Products</h1>
<table>
    <thead>
    <tr>
        <th>Title</th>
        <th>Price</th>
        <th>Link</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->title }}</td>
            <td>{{ $product->price }}</td>
            <td><a href="{{ $product->link }}" target="_blank">View Product</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
