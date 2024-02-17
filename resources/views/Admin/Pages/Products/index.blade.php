@extends('Admin.Home.index')

{{-- @section('Head')
@vite('resources/css/app.css')
@endsection --}}

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Product</h1>


     <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Products</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Full Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Available</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Populate the table with your data -->
            @foreach ( $products as $product )
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->full_description }}</td>
                    <td>{{ $product->price }}</td>
                    <td><img src="{{ asset('images/product/'.$product->image) }}" alt="{{ $product->name }}" width="100"></td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->category_name }}</td>
                    <td>{{ $product->available ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit',['id' => $product->id ]) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('admin.products.delete',['id' => $product->id ]) }}" class="btn btn-danger btn-sm">Delete</a>
                </tr>


            @endforeach
            {{-- <tr>
                <td>Product 1</td>
                <td>Description 1</td>
                <td>Full Description 1</td>
                <td>$10.00</td>
                <td><img src="product1.jpg" alt="Product 1"></td>
                <td>10</td>
                <td>Category 1</td>
                <td>Yes</td>
                <td>
                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr> --}}
            <!-- Add more rows as needed -->
        </tbody>
    </table>

</div>

@endsection
