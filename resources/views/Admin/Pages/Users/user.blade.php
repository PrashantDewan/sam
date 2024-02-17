@extends('Admin.Home.index')

@section('Head')
@vite('resources/css/app.css')
@endsection

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">
        <span class="text-bold d-flex justify-content-center align-items-center" style="font-size: 30px;">User List</span>
    </h1>
    <table class="table p-5">
        <thead class="thead-dark ">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Email Verified At</th>
                <th>Action</th> <!-- New column for action -->
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->email_verified_at)
                        {{ $user->email_verified_at->format('Y-m-d H:i:s') }}
                    @else
                        Not Verified
                    @endif
                </td>
                <td class="flex gap-1"> <!-- Action column with delete and view buttons -->
                    <a href="" class="btn btn-primary ml-2">View</a>
                    <form class="d-inline btn-danger" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn ">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
        @link 
    </table>
</div>

@endsection
