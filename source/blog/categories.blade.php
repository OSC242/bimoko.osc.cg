---
title: Catégories
---

@extends('_layouts.master')

@section('body')
    <h1 class="border-b border-blue-200 mb-6 pb-10">Catégories</h1>

    <ul class="list-disc list-inside">
    @foreach ($categories as $category)
        <li class="my-2">
            <a title="Catégorie: {{ $category->getFilename() }}" href="/blog/categories/{{ $category->getFilename() }}">{{ $category->name }}</a>
        </li>
    @endforeach
    </ul>

    @include('_components.newsletter-signup')
@stop
