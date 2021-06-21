@extends('admin.layout')

@section('content')
<main>
    <div class="container-fluid px-4">

        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between">
                <h3 class="font-weight-bold">Edit Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-1 col-md-3">
                        <label class="form-label">Category Name</label>
                        <select class="form-select" name="category_id" value="{{$post->category_id}}" required>
                            <option value=""  selected  disabled>Please Select One</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-1 col-md-3">
                        <label class="form-label">Post Title</label>
                        <input class="form-control" type="text" name="title" placeholder="Post Title" value="{{$post->title}}" required>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Post Content</label>
                        <input class="form-control" type="text" name="content" placeholder="Post Content" value="{{$post->content}}" required>
                    </div>
                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection