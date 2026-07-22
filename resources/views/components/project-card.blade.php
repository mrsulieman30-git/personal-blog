@props(['project', 'loopIndex' => 0])

<div class="group relative bg-white rounded-2xl sm:rounded-3xl shadow-md border border-slate-200/80 overflow-hidden hover:shadow-2xl hover:border-indigo-300 transition-all duration-500 hover:-translate-y-2 animate-float-slow flex-1 flex flex-col w-full h-full"
     style="animation-delay: {{ ($loopIndex % 3) * 0.7 }}s;">
    
    {{-- Live Preview Container with Dynamic Scaling --}}
    <div class="relative aspect-[16/10] bg-slate-900 overflow-hidden w-full shrink-0" 
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

            {{-- Hover Overlay with "Visit Site" --}}
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-3 sm:pb-5 z-25">
                <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-1.5 px-3 sm:px-5 py-1.5 sm:py-2.5 bg-white text-slate-950 font-bold text-[10px] sm:text-xs uppercase tracking-wider rounded-xl shadow-xl hover:bg-indigo-50 transition-all transform translate-y-3 group-hover:translate-y-0 duration-300">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    {{ __('Visit Site') }}
                </a>
            </div>
        @elseif($project->url)
            {{-- Hover Overlay only if site is sameorigin (static fallback) --}}
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-3 sm:pb-5 z-25">
                <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-1.5 px-3 sm:px-5 py-1.5 sm:py-2.5 bg-white text-slate-950 font-bold text-[10px] sm:text-xs uppercase tracking-wider rounded-xl shadow-xl hover:bg-indigo-50 transition-all transform translate-y-3 group-hover:translate-y-0 duration-300">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    {{ __('Visit Site') }}
                </a>
            </div>
        @endif

        {{-- Featured Badge --}}
        @if($project->is_featured)
            <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-30">
                <span class="inline-flex items-center gap-1 px-2 py-0.5 sm:px-2.5 sm:py-1 bg-amber-400 text-amber-955 text-[9px] sm:text-[10px] font-black uppercase tracking-wider rounded-md sm:rounded-lg shadow-sm">
                    {{ __('Featured') }}
                </span>
            </div>
        @endif
    </div>

    {{-- Card Details --}}
    <div class="p-3 sm:p-5 flex-1 flex flex-col">
        <h3 class="text-xs sm:text-lg font-black text-slate-955 mb-1 sm:mb-2 group-hover:text-indigo-600 transition-colors line-clamp-1">
            {{ $project->title }}
        </h3>

        <p class="text-[11px] sm:text-sm text-slate-500 mb-2 sm:mb-4 line-clamp-2 leading-relaxed font-normal flex-1">
            {{ $project->description }}
        </p>

        {{-- Tech Badges --}}
        @if(!empty($project->technologies) && is_array($project->technologies) && count($project->technologies) > 0)
            <div class="flex flex-wrap gap-1 mt-auto">
                @foreach(array_slice($project->technologies, 0, 3) as $tech)
                    <span class="inline-flex items-center px-1.5 sm:px-2.5 py-0.5 bg-indigo-50 text-indigo-600 text-[9px] sm:text-[11px] font-bold rounded-md border border-indigo-100">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Live Link URL Bar --}}
    @if($project->url)
        <div class="px-3 sm:px-5 pb-3 sm:pb-4 hidden sm:block mt-auto shrink-0">
            <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
               class="flex items-center gap-2 px-3 py-1.5 bg-slate-50 rounded-xl border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50 transition-colors group/url">
                <div class="flex items-center gap-1.5 shrink-0">
                    <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">{{ __('Live') }}</span>
                </div>
                <span class="text-[11px] text-slate-500 group-hover/url:text-indigo-600 truncate font-mono transition-colors">
                    {{ parse_url($project->url, PHP_URL_HOST) }}
                </span>
                <svg class="w-3 h-3 text-slate-300 group-hover/url:text-indigo-400 ml-auto shrink-0 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </a>
        </div>
    @endif
</div>
