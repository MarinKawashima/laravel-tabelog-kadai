<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-bottom mt-5">
    <div class="container d-flex flex-column align-items-center">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <div class="footer-link">
            <a href="{{ url('company-overview') }}" class="link-secondary me-3">会社概要</a>
            <a href="{{ url('terms') }}" class="link-secondary">会員規約</a>
        </div>
    </div>
</nav>