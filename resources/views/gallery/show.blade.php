@extends('layouts.app')

@section('content')

<div class="card">

    <h1>View Image</h1>

    <p>{{ $image->original_name }}</p>

    <img
        src="{{ asset('storage/' . $image->image_path) }}"
        alt="{{ $image->original_name }}"
        style="max-width: 100%; max-height: 600px;"
    >

    <br><br>

    <a
        href="{{ route('gallery.index') }}"
        class="btn"
    >
        Back to Gallery
    </a>

    <form
        action="{{ route('gallery.destroy', $image->id) }}"
        method="POST"
        style="display: inline;"
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="delete"
            onclick="return confirm('Are you sure you want to delete this image?')"
        >
            Delete Image
        </button>

    </form>

</div>

@endsection