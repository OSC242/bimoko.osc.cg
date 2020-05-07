@extends('_layouts.master')

@section('body')
    @if ($page->cover_image)
        <img src="{{ $page->cover_image }}" alt="{{ $page->title }} – Image de couverture" class="mb-2">
    @endif

    <h1 class="leading-none mb-2">{{ $page->title }}</h1>

    <p class="text-gray-700 text-xl md:mt-0">{{ $page->author }}  –  {{ $page->getDate()->formatLocalized('%e %B %Y') }}</p>

    @if ($page->categories)
        @foreach ($page->categories as $i => $category)
            <a
                href="{{ '/blog/categories/' . $category }}"
                title="Voir les articles dans la catégorie {{ $category }}"
                class="inline-block bg-gray-300 hover:bg-blue-200 leading-loose tracking-wide text-gray-800 uppercase text-xs font-semibold rounded mr-4 px-3 pt-px"
            >{{ $category }}</a>
        @endforeach
    @endif

    @if (in_array('podcast', $page->categories))
        <div class="mt-8">
            <!-- Sounder Embedded Player -->
            @include('_components.sounder-player', [
                'episodeId' => $page->episode['sounderId'],
            ])
            <!-- /Sounder Embedded Player -->
        </div>

        <div class="mt-6">
            <!-- Apple Podcasts badge -->
            <a
                href="{{ $page->podcast->apple->url }}?i={{ $page->episode['appleId'] }}"
                title="Écouter l’épisode sur Apple Podcasts"
                class="inline-block pr-3"
                target="_blank"
            >
                <img src="/assets/img/badge-apple-podcasts.svg">
            </a>
            <!-- /Apple Podcasts badge -->

            <!-- Spotify badge -->
            <a
                href="{{ $page->podcast->spotify->episodeUrl }}/{{ $page->episode['spotifyId'] }}"
                title="Écouter l’épisode sur Spotify"
                class="inline-block px-3"
                target="_blank"
            >
                <img src="/assets/img/badge-spotify-podcasts.svg">
            </a>
            <!-- Spotify badge -->
        </div>
    @endif

    <hr class="my-8">

    <div class="border-b border-blue-200 mb-10 pb-4" v-pre>
        @yield('content')
    </div>

    <nav class="flex justify-between text-sm md:text-base">
        <div>
            @if ($next = $page->getNext())
                <a href="{{ $next->getUrl() }}" title="Articles plus anciens: {{ $next->title }}">
                    &LeftArrow; {{ $next->title }}
                </a>
            @endif
        </div>

        <div>
            @if ($previous = $page->getPrevious())
                <a href="{{ $previous->getUrl() }}" title="Articles plus récents: {{ $previous->title }}">
                    {{ $previous->title }} &RightArrow;
                </a>
            @endif
        </div>
    </nav>

    <!-- Disqus -->
    <div class="mt-20 italic">
    @if ($page->disqusId && $page->baseUrl)
        @include('_components.disqus', ['identifier' => $page->disqusId])
    @else
        <p class="text-center">Les commentaires sont désactivés sur cette page</p>
    @endif
    </div>
    <!-- /Disqus -->
@endsection
