@extends('Admin.Home.index')

@section('Head')
@vite('resources/css/app.css')
@endsection

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">
        <span class="text-bold d-flex justify-content-center align-items-center" style="font-size: 30px;">Category List</span>
    </h1>

    <button class="p-3">
        <a href="{{ route('admin.categories.create')}}" class="btn btn-primary">Add Category</a>
    </button>
    <table class="table p-5">
        <thead class="thead-dark ">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th> <!-- New column for action -->
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>

                <td class="flex gap-1"> <!-- Action column with delete and view buttons -->
                    <a href="{{  route('admin.categories.edit',['id'=> $category->id ]) }}" class="btn btn-primary ml-2">Edit</a>
                    <a href="{{  route('admin.categories.delete',['id'=> $category->id ]) }}" class="btn btn-danger ml-2">Delete</a>
                    {{-- <form class="d-inline btn-danger" action=" {{ route('admin.categories.delete',['id' => $Category->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn ">Delete</button>
                    </form> --}}

                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@endsection
