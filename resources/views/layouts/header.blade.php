@if ($headerSection = getHeaderSection())
    @php
        $headerSections = json_decode($headerSection->navigation_links, true);
        $first_button_name = $headerSections['buttons']['first_button_name'] ?? null;
        $first_button_url = $headerSections['buttons']['first_button_url'] ?? null;
        $second_button_name = $headerSections['buttons']['second_button_name'] ?? null;
        $second_button_url = $headerSections['buttons']['second_button_url'] ?? null;
        $dropdown_urls = $headerSections['dropdown_urls'] ?? [];
    @endphp
    @else
    @php
        $headerSections = $first_button_name = $first_button_url = $second_button_name = $second_button_url = null;
    @endphp
@endif

<header class="header js-header header-fixed">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- logo -->
            <div class="logo-web">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="logo-box">
                        <img src="{{ asset(siteLogo()) }}" alt="Site Logo">
                    </div>
                </a>
            </div>

            <!-- right -->
            <div class="right-head">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-lg-auto">
                        {!! headerNav() !!}
                        @if(isset($dropdown_urls) && !empty($dropdown_urls))
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                More <img src="{{ asset('img/down-arrow.svg') }}" alt="Dropdown Arrow">
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    @foreach ($dropdown_urls as $url => $name)
                                        <li><a href="{{ $url }}">{{ $name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>

                <div class="EndSide">
                    <div class="schedule-call desktop-none">
                        <a class="btn green-btn" data-toggle="modal" data-target="#search-modal">
                            <div class="btn-icon">
                                <img src="{{ asset('img/search.svg') }}" alt="Search Icon">
                            </div>
                        </a>
                    </div>

                    @if ($first_button_name && $first_button_url)
                        <div class="schedule-call mobile-none">
                            <a class="btn green-btn" href="{{ $first_button_url }}">
                                <div class="btn-icon">
                                    <img src="{{ asset('img/home.svg') }}" alt="First Button Icon">
                                </div>
                                <span>{{ $first_button_name }}</span>
                            </a>
                        </div>
                    @endif

                    @if ($second_button_name && $second_button_url)
                        <div class="schedule-call">
                            <a class="btn green-btn" href="{{ $second_button_url }}">
                                <div class="btn-icon">
                                    <img src="{{ asset('img/user.svg') }}" class="mobile-none" alt="User Icon Mobile">
                                    <img src="{{ asset('img/user2.svg') }}" class="desktop-none" alt="User Icon Desktop">
                                </div>
                                <span>{{ $second_button_name }}</span>
                            </a>
                        </div>
                    @else
                        <div class="schedule-call">
                            @guest
                                <a class="btn green-btn" href="{{ route('login') }}">
                                    <div class="btn-icon">
                                        <img src="{{ asset('img/user.svg') }}" class="mobile-none" alt="User Icon Mobile">
                                        <img src="{{ asset('img/user2.svg') }}" class="desktop-none" alt="User Icon Desktop">
                                    </div>
                                    <span>Log in</span>
                                </a>
                            @else
                                <a class="btn green-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div class="btn-icon">
                                        <img src="{{ asset('img/user.svg') }}" class="mobile-none" alt="User Icon Mobile">
                                        <img src="{{ asset('img/user2.svg') }}" class="desktop-none" alt="User Icon Desktop">
                                    </div>
                                    <span>Log Out</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endguest
                        </div>
                    @endif

                    <div class="mobile-icon">
                        <button class="navbar-toggler nav-btn nav-slider" type="button">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>