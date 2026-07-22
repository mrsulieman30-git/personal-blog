@extends('layouts.app')

@section('seo')
    <title>Coming Soon — Mohammad Sulieman Ibrahim</title>
    <meta name="description" content="Exciting new features are on the way. Stay tuned!">
@endsection

@section('content')
<section class="relative min-h-[80vh] flex items-center justify-center bg-gradient-to-br from-slate-900 via-indigo-950 to-purple-950 overflow-hidden">
    {{-- Animated background elements --}}
    <div class="absolute inset-0">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-indigo-500/20 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/15 rounded-full blur-[120px] animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-indigo-500/5 rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] border border-purple-500/5 rounded-full"></div>
    </div>

    <div class="relative z-10 text-center px-4 max-w-2xl mx-auto">
        {{-- Icon --}}
        <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center shadow-2xl shadow-indigo-500/25 rotate-12 hover:rotate-0 transition-transform duration-500">
            <svg class="w-12 h-12 text-white -rotate-12 hover:rotate-0 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
        </div>

        <h1 class="text-5xl md:text-7xl font-bold text-white mb-4 tracking-tight">
            Coming <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">Soon</span>
        </h1>

        <p class="text-lg md:text-xl text-slate-400 mb-10 leading-relaxed">
            I'm working on something exciting. New features and content are on the way — stay tuned!
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/"
               class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-slate-900 font-semibold rounded-xl shadow-lg hover:shadow-xl hover:bg-indigo-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Back to Home
            </a>
            <a href="/blog"
               class="inline-flex items-center gap-2 px-8 py-3.5 bg-white/5 border border-white/10 text-white font-semibold rounded-xl hover:bg-white/10 transition-all backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Read Blog
            </a>
        </div>
    </div>
</section>
@endsection
