@php
    $languages = App\Models\Language::all();
    $pages = App\Models\Page::where('tempname', $activeTemplate)->get();
@endphp
<!-- ==================== Header End Here ==================== -->
<div class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand logo" href="{{ route('home') }}">
                <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png', '?' . time()) }}" alt="{{ config('app.name') }}">
            </a>
            <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu mx-auto ps-lg-4 ps-0">
                    @foreach ($pages as $page)
                    <li class="nav-item {{ Request::url() == url('/') . '/' . $page->slug ? 'active' : '' }}">
                        <a href="{{ route('pages', [$page->slug]) }}" class="nav-link" aria-current="page">{{ __($page->name) }}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="nav-end d-lg-flex d-block align-items-center py-lg-0 py-1">
                    @if(request()->route()->uri != '/')
                        @include($activeTemplate.'components.lang')
                    @else
                        <div class="d-flex mx-2">
                            <div class="icon">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <select class="select-dir langSel">
                                @foreach ($languages as $language)
                                    <option value="{{ $language->code }}"
                                        @if (Session::get('lang') === $language->code) selected @endif>
                                        {{ __($language->name) }}
                                    </option>
                                 @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="mx-lg-0 mx-2">
                        @auth
                        <a class="btn btn--base mt-3 mt-lg-0" href="{{route('user.home')}}">@lang('Dashboard')</a>
                        @else
                        <a class="btn btn--base mt-3 mt-lg-0" href="{{route('user.login')}}">@lang('Sign In')</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- ==================== Header End Here ==================== -->
