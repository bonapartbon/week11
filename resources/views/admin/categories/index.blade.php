@extends('admin.layout')

@section('content')
<main>
    <div class="container-fluid px-4">
        @if ($message = Session::get('success'))
        <div class="alert alert-success pb-0 mt-3">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger pb-0 mt-3">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between">
                <h3 class="font-weight-bold">Categories</h3>
                @if (Auth::user()->role == 'admin')
                <a type="button" href="{{ route('categories.create') }}" class="btn btn-dark">+ Add New Category</a>
                @endif
            </div>

            <div class="card-body">
                @if (count($categories)>0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            @if (Auth::user()->role == 'admin')
                            <th>Edit</th>
                            <th>Delete</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            @if (Auth::user()->role == 'admin')
                            <td><a type="button" href="{{ route('categories.edit', $category->id) }}" class="btn btn-dark ">Edit</a></td>
                            <td>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ">Delete</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-dark text-center">
                There are no categories!
            </div>
            @endif
        </div>
    </div>
</main>
@endsection