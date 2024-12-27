@extends('admin.adminLayout')
@section('title', 'About Page')
@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
    <div class="container">
        <p class="heading_for_admin_section">About Page</p>
        @if($aboutPage)
            <form action="{{ route('about.update', $aboutPage) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $aboutPage->title) }}" required>
                </div>
                <div class="mb-3 form-group">
                    <label for="title" class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $aboutPage->description) }}</textarea>
                </div>
                <div class="mb-3 form-group">
                    <label for="team_description" class="form-label">Team Description</label>
                    <textarea name="team_description" class="form-control">{{ old('team_description', $aboutPage->team_description) }}</textarea>
                </div>
                <div class="mb-3 form-group">
                    <label for="main_background" class="form-label">Background</label>
                    <input type="file" class="form-control" name="main_background">
                </div>
                <div class="mb-3 form-group">
                    <img style=" width: 150px; border: 1px solid #3b3527; " src="{{ asset($aboutPage->main_background) }}" alt="">
                </div>
                <button type="submit" class="green-btn">Save</button>
            </form>

            <p class="heading_for_admin_section">Sections</p>
            <form action="{{ route('about.storeSection', $aboutPage) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="sections">
                    <div class="section">
                    <div class="mb-3 form-group">
                    <label for="heading" class="form-label">Heading</label>
                        <input type="text" name="heading" class="form-control" placeholder="Heading" required>
                    </div>
                    <div class="mb-3 form-group">
                    <label for="description" class="form-label">Description</label>
                        <textarea name="description" placeholder="Description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3 form-group">
                    <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                        <button type="submit" class="green-btn">Add Section</button>
                    </div>
                </div>
            </form>
            </br>
            @if(isset($aboutPage->sections) && !empty($aboutPage->sections))
                <p class="heading_for_admin_section">Existing Sections:</p>
                <div class="row">
                @foreach ($aboutPage->sections as $section)
                    <div class="col-md-6 ">
                        <div class="card p-4">
                        <h4><b>{{ $section->heading }}</b></h4>
                        <p>{!! $section->description !!}</p>
                        @if ($section->image)
                            <img class="w-100" src="{{ asset($section->image) }}" alt="Section Image">
                        @endif
                        <form action="{{ route('about.destroySection', $section) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mt-2 btn btn-danger">Delete Section</button>
                        </form>
                    </div>
                    </div>
                @endforeach
                </div>
            @endif
        @else
            <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title" required>
                </div>
                <div class="mb-3 form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Description" required></textarea>
                </div>
                <div class="mb-3 form-group">
                    <label for="main_background" class="form-label">Background</label>
                    <input type="file" class="form-control" name="main_background">
                </div>   
                <button type="submit" class="green-btn">Create About Page</button>
            </form>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    document.querySelector('.sections').addEventListener('click', function(e) {
        if (e.target && e.target.matches('button[type="submit"]')) {
            let sectionClone = e.target.closest('.section').cloneNode(true);
            e.target.closest('.sections').appendChild(sectionClone);
        }
    });
</script>

@endsection