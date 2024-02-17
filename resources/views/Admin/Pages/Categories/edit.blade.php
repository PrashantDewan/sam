@extends('Admin.Home.index')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Edit Category</h1>
            <div class="card">

                <div class="card-body">
                    <form action=" {{ route('admin.categories.update',['id' => $category->id ]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{  $category->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $category->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

