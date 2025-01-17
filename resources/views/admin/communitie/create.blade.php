@extends('admin.adminLayout')

@section('title', 'Create Community')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section>
        <div class="container">
            <p class="heading_for_admin_section">Create Community</p>

            <form class="home_section" id="community-form" action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row row-container-section pl-2 pr-2">
                    <div class="col-12">

                        <!-- Community Name -->
                        <div class="form-group">
                            <label for="community_name">Community Name</label>
                            <input type="text" name="community_name" id="community_name" class="form-control" required>
                        </div>

                        <!-- Featured Image -->
                        <div class="form-group">
                            <label for="featured_image">Featured Image</label>
                            <input type="file" name="featured_image" id="featured_image" class="form-control" required>
                        </div>

                        <!-- Section I Image -->
                        <div class="form-group">
                            <label for="section_i_image">Section I Image</label>
                            <input type="file" name="section_i_image" id="section_i_image" class="form-control" required>
                        </div>

                        <!-- Section I Content -->
                        <div class="form-group">
                            <label for="section_i_content">Section I Content</label>
                            <textarea name="section_i_content" id="section_i_content" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Section II Content -->
                        <div class="form-group">
                            <label for="section_ii_content">Section II Content</label>
                            <textarea name="section_ii_content" id="section_ii_content" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Button I Name -->
                        <div class="form-group">
                            <label for="button_i_name">Button I Name</label>
                            <input type="text" name="button_i_name" id="button_i_name" class="form-control" required>
                        </div>
                        <!-- Button I url -->
                        <div class="form-group">
                            <label for="button_i_url">Button I Url</label>
                            <input type="text" name="button_i_url" id="button_i_url" class="form-control" value="{{ old('button_i_url') }}" required>
                        </div>

                        <!-- Button II Name -->
                        <div class="form-group">
                            <label for="button_ii_name">Button II Name</label>
                            <input type="text" name="button_ii_name" id="button_ii_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="button_ii_url">Button II Url</label>
                            <input type="text" name="button_ii_url" id="button_ii_url" class="form-control" value="{{ old('button_ii_url') }}" required>
                        </div>

                        <!-- Second Image -->
                        <div class="form-group">
                            <label for="second_image">Second Image</label>
                            <input type="file" name="second_image" id="second_image" class="form-control" required>
                        </div>

                        <!-- Section III Content -->
                        <div class="form-group">
                            <label for="section_iii_content">Section III Content</label>
                            <textarea name="section_iii_content" id="section_iii_content" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Section III Button Name -->
                        <div class="form-group">
                            <label for="section_iii_button_name">Section III Button Url</label>
                            <input type="text" name="section_iii_button_name" id="section_iii_button_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Section III Image</label>
                            <input type="file" name="third_image" id="third_image" class="form-control">
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="green-btn">Save Community</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('scripts')
    <!-- Optional JS for form validation or additional features -->
@endsection
