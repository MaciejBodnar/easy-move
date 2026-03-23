<!doctype html>
<html @php(language_attributes())>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ esc_attr(get_bloginfo('description')) }}">
    <meta name="author" content="{{ esc_attr(get_bloginfo('name')) }}">
    <meta name="keywords"
        content="mortgage, insurance, financial advice, home loans, protection, easy move financial solutions, UK financial services, mortgage advice, insurance advice, home insurance, life insurance, financial planning">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="{{ esc_attr(get_bloginfo('name')) }}">
    <meta property="og:description" content="{{ esc_attr(get_bloginfo('description')) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ esc_url(home_url('/')) }}">
    <meta property="og:image" content="{{ esc_url(get_theme_file_uri('/resources/images/og.png')) }}">
    @php(do_action('get_header'))
    @php(wp_head())
    <link rel="stylesheet" href="https://use.typekit.net/xpt0tkw.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body @php(body_class())>
    @php(wp_body_open())

    <div id="app">
        <a class="sr-only focus:not-sr-only" href="#main">
            {{ __('Skip to content', 'sage') }}
        </a>
        @if (!is_front_page())
            @include('sections.header')
        @endif

        <main id="main" class="main">
            @yield('content')
        </main>

        @hasSection('sidebar')
            <aside class="sidebar">
                @yield('sidebar')
            </aside>
        @endif

        @include('sections.footer')
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
</body>

</html>
