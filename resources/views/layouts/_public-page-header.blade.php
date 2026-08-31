<header class="page-header">
    <div class="site-shell">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span aria-hidden="true">/</span>
            <span aria-current="page">{{ $title }}</span>
        </nav>
        <h1 class="page-header-title">{{ $title }}</h1>
        @if (!empty($description))
            <p class="page-header-description">{{ $description }}</p>
        @endif
    </div>
</header>