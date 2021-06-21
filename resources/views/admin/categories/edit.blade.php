@extends('admin.layout')

@section('content')
<main>
    <div class="container-fluid px-4">

        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between">
                <h3 class="font-weight-bold">Edit Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 col-md-3">
                        <label class="form-label">Category Title</label>
                        <input type="text" name="name" class="form-control" placeholder="Category Title" value="{{$category->name}}">
                    </div>
                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection