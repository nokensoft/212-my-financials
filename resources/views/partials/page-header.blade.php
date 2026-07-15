{{--
    Header halaman: judul + keterangan singkat di kiri, breadcrumb di kanan.
    Variabel:
    - $title    : judul halaman (string)
    - $subtitle : keterangan singkat (opsional)
    - $crumbs   : array item breadcrumb [['label' => ..., 'url' => ...], ...].
                  Item terakhir dianggap halaman aktif; 'url' opsional.
    - $width    : kelas max-width kontainer (opsional, default max-w-[1200px])
--}}
@php($crumbs = $crumbs ?? [])
@php($width = $width ?? 'max-w-[1200px]')
<header class="pt-32 pb-8 px-6 bg-stone border-b border-line">
    <div class="{{ $width }} mx-auto flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div class="min-w-0">
            @isset($title)
                <h1 class="font-serif text-3xl md:text-4xl font-semibold text-ink">{{ $title }}</h1>
            @endisset
            @isset($subtitle)
                <p class="text-muted mt-2 max-w-2xl">{{ $subtitle }}</p>
            @endisset
        </div>
        @if (!empty($crumbs))
            <nav aria-label="Breadcrumb" class="shrink-0 md:pb-1">
                <ol class="flex flex-wrap items-center gap-x-1.5 gap-y-1 text-[.8rem] text-muted md:justify-end">
                    @foreach ($crumbs as $crumb)
                        <li class="flex items-center gap-x-1.5">
                            @if ($loop->last)
                                <span class="text-ink font-semibold">{{ $crumb['label'] }}</span>
                            @elseif (!empty($crumb['url']))
                                <a href="{{ $crumb['url'] }}" class="hover:text-rust transition-colors">{{ $crumb['label'] }}</a>
                            @else
                                <span>{{ $crumb['label'] }}</span>
                            @endif
                            @unless ($loop->last)
                                <span class="text-line">/</span>
                            @endunless
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif
    </div>
</header>
