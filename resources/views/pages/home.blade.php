@extends('layouts.app')

@section('content')
<div class="bg-[#f1f3f6] min-h-screen relative overflow-hidden py-8 md:py-12 font-sans">

    {{-- Subtle Ambient Glow Background Accents --}}
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-purple-500/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-10">
        
        {{-- Full-Width Premium Hero Card --}}
        <div class="bg-white rounded-[2.5rem] p-8 sm:p-12 lg:p-14 shadow-xl border border-slate-200/60 flex flex-col-reverse lg:flex-row items-center justify-between gap-10 lg:gap-14">
            
            {{-- Left Content Area --}}
            <div class="flex-1 space-y-6 text-left w-full">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-500/10 border border-green-500/20 rounded-full text-green-600 text-xs font-bold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    {{ __('MOH UAE & Sudan Licensed') }}
                </div>
                
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 leading-tight tracking-tight">
                    {!! __(':role Manager & Expert.', ['role' => '<span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">' . __('Medical Laboratory') . '</span>']) !!}
                </h1>
                
                <p class="text-lg md:text-xl text-slate-600 max-w-2xl font-medium leading-relaxed">
                    {{ __('Expert in Hematology & Immunology. Bridging healthcare and technology through Bioinformatics and Data Science.') }}
                </p>
                
                {{-- Action Row: Integrated Contact Badges & Centered Download CV --}}
                <div class="pt-2 space-y-4 w-full">
                    {{-- 2 Contact Info Badges on Same Line --}}
                    <div class="flex flex-row items-center justify-center sm:justify-start gap-2 sm:gap-3 w-full">
                        <div class="inline-flex items-center gap-2 px-3.5 sm:px-4.5 py-2.5 sm:py-3 bg-slate-900 text-white rounded-2xl text-[11px] sm:text-xs font-bold shadow-md shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span dir="ltr">{{ $siteSettings->get('contact_phone', '+252 61 500 0000') }}</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 sm:px-4.5 py-2.5 sm:py-3 bg-slate-900 text-white rounded-2xl text-[11px] sm:text-xs font-bold shadow-md shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span dir="ltr">{{ $siteSettings->get('contact_email', 'hello@sulieman.dev') }}</span>
                        </div>
                    </div>

                    {{-- Download CV Button Under & Centered on Mobile (Fits Text Only) --}}
                    <div class="flex justify-center sm:justify-start w-full">
                        <a href="/about" class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 bg-indigo-600 text-white font-bold text-sm rounded-full hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200/60 active:scale-95 w-auto text-center">
                            {{ __('Download CV') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Portrait Area --}}
            <div class="relative shrink-0">
                <div class="w-64 h-64 sm:w-72 sm:h-72 md:w-80 md:h-80 lg:w-96 lg:h-96 rounded-full overflow-hidden shadow-2xl border-4 border-slate-100 bg-indigo-50">
                    <img src="/images/developer_portrait.jpg" alt="Mohammad Sulieman" class="w-full h-full object-cover">
                </div>
                {{-- Overlay Tag Badge --}}
                <div class="absolute bottom-6 start-6 bg-slate-900 text-white text-xs font-bold uppercase tracking-wider px-5 py-2 rounded-full shadow-xl border border-white/20 text-center">
                    {{ __('Med Lab Manager') }}<br>
                    <span class="text-[10px] text-slate-400 font-medium">{{ __('Bioinformatics & IT') }}</span>
                </div>
            </div>
        </div>

        {{-- Featured Blog Slider Section (Custom 3D Stack Slider) --}}
        <div class="pt-2">
            <livewire:home-latest-blog />
        </div>

        {{-- Featured Projects Section --}}
        @php
            $featuredProjects = \App\Models\Project::where('is_published', true)->where('is_featured', true)->orderBy('sort_order')->take(3)->get();
        @endphp
        @if($featuredProjects->count() > 0)
        <div class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-xl border border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-bold uppercase tracking-wider rounded-full mb-2">
                        {{ __('Portfolio') }}
                    </span>
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">{{ __('Featured Projects') }}</h2>
                </div>
                <a href="/projects" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white font-bold text-xs uppercase tracking-wider rounded-full hover:bg-indigo-700 transition-all shadow-md">
                    {{ __('View All') }}
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($featuredProjects as $project)
                    <div class="group bg-slate-50 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="relative aspect-[16/10] bg-slate-900 overflow-hidden"
                             x-data="{ 
                                loaded: false, 
                                error: false, 
                                scale: 0.25, 
                                calcScale() { 
                                    if (this.$refs.cardBox) {
                                        this.scale = this.$refs.cardBox.clientWidth / 1280;
                                    }
                                } 
                             }" 
                             x-init="calcScale(); $nextTick(() => calcScale()); window.addEventListener('resize', () => calcScale())"
                             x-ref="cardBox">
                            
                            {{-- Static Image Fallback / Background --}}
                            <img src="{{ $project->display_image }}" alt="{{ $project->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            @if($project->url && $project->can_iframe)
                                {{-- Live Iframe Preview --}}
                                <div class="absolute inset-0 overflow-hidden" x-show="!error">
                                    <iframe
                                        src="{{ $project->url }}"
                                        class="border-none pointer-events-none absolute top-0 left-0"
                                        :style="`width: 1280px; height: ${Math.round(1280 * (10/16))}px; transform: scale(${scale}); transform-origin: top left;`"
                                        sandbox="allow-scripts allow-same-origin"
                                        loading="lazy"
                                        x-on:load="loaded = true"
                                        x-on:error="error = true"
                                    ></iframe>
                                </div>

                                {{-- Hover overlay with "Visit" button --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4 z-20">
                                    <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-white text-slate-900 font-bold text-[11px] uppercase tracking-wider rounded-xl shadow-lg hover:bg-indigo-50 transition-all transform translate-y-3 group-hover:translate-y-0 duration-300">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Visit Site
                                    </a>
                                </div>
                            @elseif($project->url)
                                {{-- Hover overlay with "Visit" button for sameorigin sites (static fallback) --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4 z-20">
                                    <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-white text-slate-900 font-bold text-[11px] uppercase tracking-wider rounded-xl shadow-lg hover:bg-indigo-50 transition-all transform translate-y-3 group-hover:translate-y-0 duration-300">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Visit Site
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="text-base font-bold text-slate-900 mb-1.5">{{ $project->title }}</h3>
                            <p class="text-xs text-slate-500 line-clamp-2 mb-3 leading-relaxed">{{ $project->description }}</p>
                            @if(!empty($project->technologies) && is_array($project->technologies) && count($project->technologies) > 0)
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach(array_slice($project->technologies, 0, 4) as $tech)
                                        <span class="px-2 py-0.5 bg-white border border-slate-200 text-slate-700 text-[10px] font-bold rounded-md">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
