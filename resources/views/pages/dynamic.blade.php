@extends('layouts.app')
@section('seo')
    <title>{{ $page->meta_title ?: ($page->title . ' — Mohammad Sulieman Ibrahim') }}</title>
    <meta name="description" content="{{ $page->meta_description ?: Str::limit(strip_tags($page->content), 160) }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:title" content="{{ $page->meta_title ?: $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?: Str::limit(strip_tags($page->content), 160) }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->fullUrl() }}">
    <meta property="twitter:title" content="{{ $page->meta_title ?: $page->title }}">
    <meta property="twitter:description" content="{{ $page->meta_description ?: Str::limit(strip_tags($page->content), 160) }}">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">
@endsection

@section('content')
<div class="bg-slate-50 min-h-screen py-16">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 overflow-hidden">
            
            {{-- Header --}}
            <div class="bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 px-10 py-12 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full opacity-10">
                    <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full"><path d="M0,0 C30,40 70,60 100,0 L100,100 L0,100 Z" fill="white"/></svg>
                </div>
                <h1 class="relative z-10 text-4xl md:text-5xl font-black text-white tracking-tight">{{ $page->title }}</h1>
            </div>

            {{-- Body Content --}}
            <div class="p-10 md:p-16">
                <article class="prose prose-lg md:prose-xl prose-indigo max-w-none text-slate-700">
                    {!! str($page->content)->markdown() !!}
                </article>
            </div>
            
        </div>
    </div>
</div>
@endsection
