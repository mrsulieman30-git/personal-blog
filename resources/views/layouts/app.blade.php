<!DOCTYPE html>
<html class="overflow-x-clip" lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $siteName = $siteSettings->get('site_name', 'Mohammad Sulieman Ibrahim');
        $siteTagline = $siteSettings->get('site_tagline', 'Developer, Creator & Writer');
        $siteDescription = $siteSettings->get('site_description', 'Personal blog and portfolio of Mohammad Sulieman Ibrahim. Sharing thoughts on web development, technology, and more.');
        $defaultOgImage = $siteSettings->get('logo_path') ? asset('storage/' . $siteSettings->get('logo_path')) : asset('images/og-image.jpg');
    @endphp

    {{-- Dynamic SEO Meta Tags --}}
    @if(View::hasSection('seo'))
        @yield('seo')
    @else
        <title>{{ $siteName }} — {{ $siteTagline }}</title>
        <meta name="description" content="{{ $siteDescription }}">

        {{-- Open Graph / Facebook --}}
        <meta property="og:type" content="website">
        <meta property="og:url" content="{!! request()->fullUrl() !!}">
        <meta property="og:title" content="{{ $siteName }}">
        <meta property="og:description" content="{{ $siteDescription }}">
        <meta property="og:image" content="{!! $defaultOgImage !!}">

        {{-- Twitter --}}
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{!! request()->fullUrl() !!}">
        <meta property="twitter:title" content="{{ $siteName }}">
        <meta property="twitter:description" content="{{ $siteDescription }}">
        <meta property="twitter:image" content="{!! $defaultOgImage !!}">
    @endif
    @stack('seo')

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="/favicon.png">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Schema.org JSON-LD --}}
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Person",
      "name": "Mohammad Sulieman Ibrahim",
      "url": "{{ url('/') }}",
      "jobTitle": "Web Developer",
      "sameAs": [
        "{{ $siteSettings->get('github_url', '') }}",
        "{{ $siteSettings->get('linkedin_url', '') }}",
        "{{ $siteSettings->get('twitter_url', '') }}"
      ]
    }
    </script>

    {{-- Scripts & Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans antialiased text-gray-800 bg-[#f1f3f6] overflow-x-clip select-none" style="font-family: 'Inter', sans-serif;">

    {{-- Navigation --}}
    <nav 
        x-data="{ 
            mobileMenuOpen: false, 
            scrolled: false,
            checkScroll() { this.scrolled = window.scrollY > 20; }
        }"
        x-init="checkScroll(); window.addEventListener('scroll', () => checkScroll())"
        :class="scrolled ? 'bg-white/90 backdrop-blur-xl border-b border-slate-200/60 shadow-md py-3' : 'bg-white/70 backdrop-blur-md border-b border-slate-200/30 py-4'"
        class="fixed top-0 inset-x-0 z-50 transition-all duration-300 print:hidden"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Logo Emblem & Name Text --}}
                <div class="flex items-center min-w-0">
                    <a href="/" class="flex items-center gap-2 sm:gap-3.5 group min-w-0">
                        <img src="/images/ms_monogram_transparent.png" alt="MS Monogram" class="h-9 sm:h-16 w-auto object-contain group-hover:scale-105 transition-transform duration-300 shrink-0">
                        <span class="text-slate-950 font-black text-lg sm:text-2xl md:text-3xl tracking-tight truncate">Mohammad Sulieman</span>
                    </a>
                </div>

                {{-- Floating White Pill Desktop Navigation (Enlarged Proportions) --}}
                <div class="hidden md:flex items-center bg-white rounded-full px-12 py-4 shadow-2xl border border-slate-200/80 gap-10">
                    <a href="/" class="text-sm font-black uppercase tracking-wider transition-colors {{ request()->is('/') ? 'text-slate-950 font-black' : 'text-slate-400 hover:text-slate-950' }}">{{ __('Home') }}</a>
                    <a href="/about" class="text-sm font-black uppercase tracking-wider transition-colors {{ request()->is('about') ? 'text-slate-950 font-black' : 'text-slate-400 hover:text-slate-950' }}">{{ __('About') }}</a>
                    <a href="/projects" class="text-sm font-black uppercase tracking-wider transition-colors {{ request()->is('projects*') ? 'text-slate-950 font-black' : 'text-slate-400 hover:text-slate-950' }}">{{ __('Projects') }}</a>
                    <a href="/blog" class="text-sm font-black uppercase tracking-wider transition-colors {{ request()->is('blog*') || request()->is('posts*') ? 'text-slate-950 font-black' : 'text-slate-400 hover:text-slate-950' }}">{{ __('Blog') }}</a>
                    
                    {{-- Language Switcher Dropdown --}}
                    <div class="relative" x-data="{ langOpen: false }" @click.outside="langOpen = false">
                        <button @click="langOpen = !langOpen" class="flex items-center gap-1.5 hover:opacity-80 transition-opacity">
                            @if(app()->getLocale() == 'en')
                                <img src="https://flagcdn.com/w40/us.png" alt="English" class="w-6 h-auto rounded-sm shadow-sm">
                            @elseif(app()->getLocale() == 'ar')
                                <img src="https://flagcdn.com/w40/sa.png" alt="Arabic" class="w-6 h-auto rounded-sm shadow-sm">
                            @elseif(app()->getLocale() == 'so')
                                <img src="https://flagcdn.com/w40/so.png" alt="Somali" class="w-6 h-auto rounded-sm shadow-sm">
                            @endif
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="langOpen" x-cloak x-transition.opacity class="absolute right-0 mt-2 w-auto bg-white rounded-xl shadow-xl border border-slate-100 py-2 px-1 z-50 flex flex-col items-center gap-1">
                            <a href="{{ route('lang.switch', 'en') }}" class="block p-2 hover:bg-slate-50 rounded-lg transition-colors" title="English"><img src="https://flagcdn.com/w40/us.png" alt="English" class="w-6 h-auto rounded-sm shadow-sm"></a>
                            <a href="{{ route('lang.switch', 'ar') }}" class="block p-2 hover:bg-slate-50 rounded-lg transition-colors" title="العربية"><img src="https://flagcdn.com/w40/sa.png" alt="Arabic" class="w-6 h-auto rounded-sm shadow-sm"></a>
                            <a href="{{ route('lang.switch', 'so') }}" class="block p-2 hover:bg-slate-50 rounded-lg transition-colors" title="Somali"><img src="https://flagcdn.com/w40/so.png" alt="Somali" class="w-6 h-auto rounded-sm shadow-sm"></a>
                        </div>
                    </div>
                </div>

                {{-- Social Links & Mobile Toggle (Enlarged Buttons) --}}
                <div class="flex items-center gap-3">
                    @if($siteSettings->get('github_url'))
                        <a href="{{ $siteSettings->get('github_url') }}" target="_blank" rel="noopener" class="hidden lg:flex w-11 h-11 items-center justify-center text-slate-700 hover:text-slate-950 rounded-full bg-white hover:bg-slate-100 transition-all shadow-lg border border-slate-200/80 hover:scale-105" title="GitHub">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                        </a>
                    @endif
                    @if($siteSettings->get('linkedin_url'))
                        <a href="{{ $siteSettings->get('linkedin_url') }}" target="_blank" rel="noopener" class="hidden lg:flex w-11 h-11 items-center justify-center text-slate-700 hover:text-blue-600 rounded-full bg-white hover:bg-blue-50 transition-all shadow-lg border border-slate-200/80 hover:scale-105" title="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.064-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path></svg>
                        </a>
                    @endif
                    @if($siteSettings->get('facebook_url'))
                        <a href="{{ $siteSettings->get('facebook_url') }}" target="_blank" rel="noopener" class="hidden lg:flex w-11 h-11 items-center justify-center text-slate-700 hover:text-blue-600 rounded-full bg-white hover:bg-blue-50 transition-all shadow-lg border border-slate-200/80 hover:scale-105" title="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path></svg>
                        </a>
                    @endif
                    @if($siteSettings->get('twitter_url'))
                        <a href="{{ $siteSettings->get('twitter_url') }}" target="_blank" rel="noopener" class="hidden lg:flex w-11 h-11 items-center justify-center text-slate-700 hover:text-sky-500 rounded-full bg-white hover:bg-sky-50 transition-all shadow-lg border border-slate-200/80 hover:scale-105" title="Twitter">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                        </a>
                    @endif
                    @if($siteSettings->get('instagram_url'))
                        <a href="{{ $siteSettings->get('instagram_url') }}" target="_blank" rel="noopener" class="hidden lg:flex w-11 h-11 items-center justify-center text-slate-700 hover:text-pink-600 rounded-full bg-white hover:bg-pink-50 transition-all shadow-lg border border-slate-200/80 hover:scale-105" title="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                        </a>
                    @endif

                    {{-- Hamburger Mobile Button --}}
                    <button @click="mobileMenuOpen = true" class="md:hidden p-3 text-slate-950 rounded-2xl bg-white hover:bg-slate-100 transition-colors shadow-lg border border-slate-200/80" aria-label="Open Mobile Navigation Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Sliding Drawer Backdrop --}}
        <div 
            x-show="mobileMenuOpen" 
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="mobileMenuOpen = false" 
            class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 md:hidden"
        ></div>

        {{-- Mobile Sliding Drawer Panel --}}
        <div 
            x-show="mobileMenuOpen" 
            x-cloak
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed inset-y-0 right-0 w-80 max-w-[85vw] bg-slate-950 text-white z-50 p-6 flex flex-col justify-between shadow-2xl border-l border-slate-800 md:hidden"
        >
            {{-- Drawer Header --}}
            <div>
                <div class="flex items-center justify-between pb-6 border-b border-slate-800">
                    <div class="flex items-center gap-3">
                        <img src="/images/ms_monogram_white.png" alt="MS Monogram" class="h-10 w-auto object-contain">
                        <span class="font-black text-lg text-white tracking-tight">Mohammad Sulieman</span>
                    </div>
                    <button @click="mobileMenuOpen = false" class="p-2 text-slate-400 hover:text-white rounded-xl bg-slate-900 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                {{-- Drawer Links --}}
                <div class="py-8 flex flex-col gap-3">
                    <a href="/" @click="mobileMenuOpen = false" class="flex items-center justify-between p-3.5 rounded-2xl transition-all {{ request()->is('/') ? 'bg-indigo-600 text-white font-black' : 'text-slate-300 hover:bg-slate-900 hover:text-white font-bold' }}">
                        <span>{{ __('Home') }}</span>
                        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <a href="/about" @click="mobileMenuOpen = false" class="flex items-center justify-between p-3.5 rounded-2xl transition-all {{ request()->is('about') ? 'bg-indigo-600 text-white font-black' : 'text-slate-300 hover:bg-slate-900 hover:text-white font-bold' }}">
                        <span>{{ __('About') }}</span>
                        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <a href="/projects" @click="mobileMenuOpen = false" class="flex items-center justify-between p-3.5 rounded-2xl transition-all {{ request()->is('projects*') ? 'bg-indigo-600 text-white font-black' : 'text-slate-300 hover:bg-slate-900 hover:text-white font-bold' }}">
                        <span>{{ __('Projects') }}</span>
                        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <a href="/blog" @click="mobileMenuOpen = false" class="flex items-center justify-between p-3.5 rounded-2xl transition-all {{ request()->is('blog*') || request()->is('posts*') ? 'bg-indigo-600 text-white font-black' : 'text-slate-300 hover:bg-slate-900 hover:text-white font-bold' }}">
                        <span>{{ __('Blog') }}</span>
                        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    {{-- Mobile Language Switcher --}}
                    <div class="mt-4 pt-4 border-t border-slate-800">
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-3">Language</p>
                        <div class="grid grid-cols-3 gap-2">
                            <a href="{{ route('lang.switch', 'en') }}" class="flex items-center justify-center p-3 rounded-xl {{ app()->getLocale() == 'en' ? 'bg-indigo-600/20 border border-indigo-500/30' : 'bg-slate-900 hover:bg-slate-800' }} transition-colors" title="English">
                                <img src="https://flagcdn.com/w40/us.png" alt="English" class="w-7 h-auto rounded shadow-sm">
                            </a>
                            <a href="{{ route('lang.switch', 'ar') }}" class="flex items-center justify-center p-3 rounded-xl {{ app()->getLocale() == 'ar' ? 'bg-indigo-600/20 border border-indigo-500/30' : 'bg-slate-900 hover:bg-slate-800' }} transition-colors" title="العربية">
                                <img src="https://flagcdn.com/w40/sa.png" alt="Arabic" class="w-7 h-auto rounded shadow-sm">
                            </a>
                            <a href="{{ route('lang.switch', 'so') }}" class="flex items-center justify-center p-3 rounded-xl {{ app()->getLocale() == 'so' ? 'bg-indigo-600/20 border border-indigo-500/30' : 'bg-slate-900 hover:bg-slate-800' }} transition-colors" title="Somali">
                                <img src="https://flagcdn.com/w40/so.png" alt="Somali" class="w-7 h-auto rounded shadow-sm">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Drawer Footer Contact --}}
            <div class="pt-6 border-t border-slate-800 space-y-4">
                <div class="text-xs font-bold text-slate-400 space-y-1">
                    <p class="text-white font-extrabold">{{ $siteSettings->get('contact_phone', '+252 61 500 0000') }}</p>
                    <p class="truncate text-slate-400">{{ $siteSettings->get('contact_email', 'hello@sulieman.dev') }}</p>
                </div>
                <div class="flex items-center gap-3 pt-1">
                    @if($siteSettings->get('github_url'))
                        <a href="{{ $siteSettings->get('github_url') }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-slate-900 flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                        </a>
                    @endif
                    @if($siteSettings->get('linkedin_url'))
                        <a href="{{ $siteSettings->get('linkedin_url') }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-slate-900 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.064-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path></svg>
                        </a>
                    @endif
                    @if($siteSettings->get('facebook_url'))
                        <a href="{{ $siteSettings->get('facebook_url') }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-slate-900 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path></svg>
                        </a>
                    @endif
                    @if($siteSettings->get('twitter_url'))
                        <a href="{{ $siteSettings->get('twitter_url') }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-slate-900 flex items-center justify-center text-slate-400 hover:text-white hover:bg-sky-500 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                        </a>
                    @endif
                    @if($siteSettings->get('instagram_url'))
                        <a href="{{ $siteSettings->get('instagram_url') }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-slate-900 flex items-center justify-center text-slate-400 hover:text-white hover:bg-pink-600 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="min-h-screen pt-24 sm:pt-28">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-8 print:hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                {{-- About Column --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">M</span>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Mohammad Sulieman</h3>
                        </div>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        {{ __('Medical Laboratory Manager at Kaafi hospital. Expert in fertility diagnostics, Quality Control (QC), and Bioinformatics. Bridging healthcare and technology.') }}
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">{{ __('Quick Links') }}</h4>
                    <ul class="space-y-2.5">
                        <li><a href="/" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm">{{ __('Home') }}</a></li>
                        <li><a href="/blog" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm">{{ __('Blog') }}</a></li>
                        <li><a href="/projects" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm">{{ __('Projects') }}</a></li>
                        <li><a href="/about" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm">{{ __('About Me') }}</a></li>
                    </ul>
                </div>

                {{-- Social Links --}}
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">{{ __('Connect') }}</h4>
                    <div class="flex gap-3">
                        @if($siteSettings->get('github_url'))
                            <a href="{{ $siteSettings->get('github_url') }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-indigo-600 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                            </a>
                        @endif
                        @if($siteSettings->get('linkedin_url'))
                            <a href="{{ $siteSettings->get('linkedin_url') }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path></svg>
                            </a>
                        @endif
                        @if($siteSettings->get('facebook_url'))
                            <a href="{{ $siteSettings->get('facebook_url') }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path></svg>
                            </a>
                        @endif
                        @if($siteSettings->get('twitter_url'))
                            <a href="{{ $siteSettings->get('twitter_url') }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-sky-500 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                            </a>
                        @endif
                        @if($siteSettings->get('instagram_url'))
                            <a href="{{ $siteSettings->get('instagram_url') }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-pink-600 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-6 text-center text-sm text-slate-500">
                <p>&copy; {{ date('Y') }} Mohammad Sulieman Ibrahim. {{ __('All rights reserved.') }}</p>
            </div>
        </div>
    </footer>

    {{-- Floating Compact Language Switcher (About & Single Post Pages Only) --}}
    @if(request()->is('about') || request()->is('posts/*') || request()->is('blog/*'))
        <div 
            x-data="{ 
                open: false, 
                dismissed: false,
                switchLang(url) {
                    sessionStorage.setItem('restoreScrollPos', window.scrollY);
                    window.location.href = url;
                }
            }"
            x-init="
                if (sessionStorage.getItem('restoreScrollPos')) {
                    const savedPos = parseInt(sessionStorage.getItem('restoreScrollPos'));
                    sessionStorage.removeItem('restoreScrollPos');
                    window.scrollTo({ top: savedPos, behavior: 'instant' });
                }
            "
            x-show="!dismissed"
            x-cloak
            class="fixed bottom-5 end-5 z-40 print:hidden flex items-center gap-1.5 select-none"
        >
            <div class="bg-slate-950/90 text-white backdrop-blur-md border border-slate-800 shadow-2xl rounded-full p-1.5 flex items-center gap-1">
                
                {{-- Active Flag Button --}}
                <button 
                    @click="open = !open" 
                    type="button" 
                    class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-800/80 hover:bg-slate-700 text-xs font-bold transition-colors cursor-pointer"
                    aria-label="Switch Language"
                >
                    @if(app()->getLocale() == 'en')
                        <img src="https://flagcdn.com/w40/us.png" alt="EN" class="w-4 h-auto rounded-xs shadow-xs shrink-0">
                        <span class="text-[11px] uppercase tracking-wider font-extrabold text-slate-200">EN</span>
                    @elseif(app()->getLocale() == 'ar')
                        <img src="https://flagcdn.com/w40/sa.png" alt="AR" class="w-4 h-auto rounded-xs shadow-xs shrink-0">
                        <span class="text-[11px] uppercase tracking-wider font-extrabold text-slate-200">عربي</span>
                    @elseif(app()->getLocale() == 'so')
                        <img src="https://flagcdn.com/w40/so.png" alt="SO" class="w-4 h-auto rounded-xs shadow-xs shrink-0">
                        <span class="text-[11px] uppercase tracking-wider font-extrabold text-slate-200">SO</span>
                    @endif
                    <svg class="w-3 h-3 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                {{-- Flag Options Dropdown --}}
                <div 
                    x-show="open" 
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="flex items-center gap-1 px-1"
                >
                    @if(app()->getLocale() !== 'en')
                        <button @click="switchLang('{{ route('lang.switch', 'en') }}')" type="button" class="p-1 hover:bg-slate-800 rounded-full transition-colors cursor-pointer" title="English">
                            <img src="https://flagcdn.com/w40/us.png" alt="English" class="w-5 h-auto rounded-xs shadow-xs">
                        </button>
                    @endif
                    @if(app()->getLocale() !== 'ar')
                        <button @click="switchLang('{{ route('lang.switch', 'ar') }}')" type="button" class="p-1 hover:bg-slate-800 rounded-full transition-colors cursor-pointer" title="العربية">
                            <img src="https://flagcdn.com/w40/sa.png" alt="Arabic" class="w-5 h-auto rounded-xs shadow-xs">
                        </button>
                    @endif
                    @if(app()->getLocale() !== 'so')
                        <button @click="switchLang('{{ route('lang.switch', 'so') }}')" type="button" class="p-1 hover:bg-slate-800 rounded-full transition-colors cursor-pointer" title="Somali">
                            <img src="https://flagcdn.com/w40/so.png" alt="Somali" class="w-5 h-auto rounded-xs shadow-xs">
                        </button>
                    @endif
                </div>

                {{-- Close / Dismiss Button --}}
                <button 
                    @click="dismissed = true" 
                    type="button" 
                    class="w-5 h-5 flex items-center justify-center rounded-full text-slate-400 hover:text-white hover:bg-slate-800 transition-colors ml-0.5 cursor-pointer"
                    title="Close language switcher"
                >
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    @endif

    @livewireScripts
</body>
</html>
