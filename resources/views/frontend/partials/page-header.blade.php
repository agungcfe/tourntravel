<section class="page-header" style="--cover: url('{{ $image ?? 'https://picsum.photos/seed/header/1920/600' }}')">
    <div class="container">
        <nav class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> <span>/</span> {{ $title }}</nav>
        <h1>{{ $title }}</h1>
        @isset($subtitle)<p>{{ $subtitle }}</p>@endisset
    </div>
</section>
