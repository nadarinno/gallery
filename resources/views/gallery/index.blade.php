@extends('layouts.app')

@section('content')

<h1>My Gallery</h1>

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <h2>Upload One Image</h2>

    <form
        action="{{ route('gallery.single') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <input
            type="file"
            name="image"
            accept="image/*"
            required
        >

        @error('image')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit">
            Upload Image
        </button>
    </form>
</div>


<div class="card">
    <h2>Upload Multiple Images</h2>

    <form
        action="{{ route('gallery.multiple') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <input
            type="file"
            name="images[]"
            accept="image/*"
            multiple
            required
        >

        @error('images')
            <p class="error">{{ $message }}</p>
        @enderror

        @error('images.*')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit">
            Upload Images
        </button>
    </form>
</div>


@if($images->count() > 0)

    <div class="gallery">

        @foreach($images as $image)

            <div class="gallery-item">

                <img
                    src="{{ asset('storage/' . $image->image_path) }}"
                    alt="{{ $image->original_name }}"
                >

                <p>
                    {{ $image->original_name }}
                </p>

                <div class="actions">

                    <a
                        href="{{ route('gallery.show', $image->id) }}"
                        class="btn"
                    >
                        View
                    </a>

                    <form
                        action="{{ route('gallery.destroy', $image->id) }}"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="delete"
                            onclick="return confirm('Are you sure you want to delete this image?')"
                        >
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        @endforeach

    </div>

    <div style="margin-top: 30px;">
        {{ $images->links() }}
    </div>

@else

    <div class="card">
        <p>You have not uploaded any images yet.</p>
    </div>

@endif

@endsection