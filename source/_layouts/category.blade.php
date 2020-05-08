@extends('_layouts.master')

@section('body')
    <h1>Catégorie: {{ $page->title }}</h1>

    <div class="text-2xl border-b border-blue-200 mb-6 pb-10">
        @yield('content')
    </div>

    @foreach ($posts->filter->inCategory($page->name) as $post)
        @include('_components.post-preview-inline')

        @if (! $loop->last)
            <hr class="w-full border-b mt-2 mb-6">
        @endif
    @endforeach

    @include('_components.newsletter-signup')
@stop
