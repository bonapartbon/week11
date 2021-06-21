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
                <h3 class="font-weight-bold">Posts</h3>
                <a type="button" href="{{ route('posts.create') }}" class="btn btn-dark ">+ Add New Post</a>
            </div>

            <div class="card-body">
                @if (count($posts)>0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Name</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Author</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td>{{ $post->author->full_name }}</td>
                            @if (Auth::user()->id == $post->user_id || Auth::user()->role == 'admin')

                            <td><a type="button" href="{{ route('posts.edit', $post->id) }}" class="btn btn-dark">Edit</a></td>
                            <td>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            @else
                            <td></td>
                            <td></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-dark text-center">
                There are no posts!
            </div>
            @endif
        </div>
    </div>
</main>
@endsection