@extends('template')
 
@section('content')
<div class="navbar">
    <div class="container">
        <h2>My Blog - Dashboard</h2>

        <form method="POST" action="{{ route('logout') }}" >
            @csrf
            <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                this.closest('form').submit();" 
                class="btn btn-warning">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </div>
</div>

<div class="row py-lg-2">
    <div>
        <a class="btn btn-success" href="{{ route('posts.create') }}"> Create Post</a>
    </div>
</div>
     
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
 
<table class="table table-bordered">
    <tr>
        <th width="20px" class="text-center">No</th>
        <th>Title</th>
        <th width="280px"class="text-center">Action</th>
    </tr>
    @foreach ($posts as $post)
    <tr>
        <td class="text-center">{{ ++$i }}</td>
        <td>{{ $post->title }}</td>
        <td class="text-center">
            <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('posts.show',$post->id) }}">Show</a>
                <a class="btn btn-primary btn-sm" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                @csrf
                @method('DELETE')
    
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
 
{!! $posts->links() !!}
 
@endsection
