@if ($headerSection = \App\Models\HeaderSection::first())
    <header>
        <div>
            @if ($headerSection->logo_url)
                <img src="{{ Storage::url($headerSection->logo_url) }}" alt="Logo">
            @endif
        </div>
        <nav>
            @php
                $navLinks = $headerSection->navigation_links;
            @endphp
            <ul>
                @foreach ($navLinks as $link)
                    <li>
                        <a href="{{ $link['url'] }}">{{ $link['title'] }}</a>
                        @if (!empty($link['children']))
                            <ul>
                                @foreach ($link['children'] as $child)
                                    <li><a href="{{ $child['url'] }}">{{ $child['title'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
    </header>
@endif

<form action="{{ route('header_sections.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="logo">Upload Logo</label>
        <input type="file" id="logo" name="logo">
    </div>
    <div>
        <label for="navigation_links">Navigation Links (JSON format)</label>
        <textarea id="navigation_links" name="navigation_links" rows="5">{{ old('navigation_links') }}</textarea>
    </div>
    <button type="submit">Save</button>
</form>
