<div class="bg-[#f1f3f6] min-h-screen py-8 md:py-12 font-sans">
    
    <style>
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(0.5deg); }
        }
        .animate-float-slow {
            animation: floatSlow 6s ease-in-out infinite;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($projects->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
                
                @php
                    $titleCardRendered = false;
                    // Target position for injecting Title Card (index 1 means 2nd item in the grid)
                    $targetPosition = 1; 
                @endphp

                @foreach($projects as $index => $project)
                
                {{-- Inject Centered Title Card and Project stacked in the SAME column --}}
                @if($index == $targetPosition)
                    <div class="flex flex-col gap-3 sm:gap-6 lg:gap-8 h-full">
                        {{-- Centered Title Card (Compact) --}}
                        <div class="group relative bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 shadow-md border border-slate-200/80 flex flex-col justify-center items-center text-center hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-float-slow h-auto flex-shrink-0"
                             style="animation-delay: 1.5s;">
                            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-50/50 via-transparent to-transparent pointer-events-none"></div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-[10px] font-bold uppercase tracking-wider mb-2 border border-indigo-100">
                                {{ __('Portfolio') }}
                            </span>
                            <h1 class="text-xl sm:text-3xl font-black text-slate-950 tracking-tight leading-tight mb-2">
                                {{ __('My Projects') }}
                            </h1>
                            <p class="text-slate-500 text-[11px] sm:text-xs leading-relaxed max-w-xs font-normal">
                                {{ __('Interactive preview portals. Hover over cards for live website previews and direct access.') }}
                            </p>
                        </div>
                        
                        {{-- Squeezed Project Card under the title --}}
                        <x-project-card :project="$project" :loopIndex="$index" />
                    </div>
                    @php $titleCardRendered = true; @endphp
                @else
                    {{-- Normal Project Card --}}
                    <div class="h-full flex flex-col">
                        <x-project-card :project="$project" :loopIndex="$index" />
                    </div>
                @endif
            @endforeach

            {{-- If loop finishes and Title Card wasn't rendered (e.g. less than 2 projects) --}}
            @if(!$titleCardRendered)
                <div class="group relative bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 shadow-md border border-slate-200/80 flex flex-col justify-center items-center text-center hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-float-slow h-full">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-[10px] font-bold uppercase tracking-wider mb-4 border border-indigo-100">
                        {{ __('Portfolio') }}
                    </span>
                    <h1 class="text-xl sm:text-3xl font-black text-slate-955 tracking-tight leading-tight">
                        {{ __('My Projects') }}
                    </h1>
                    <p class="text-slate-500 text-[11px] sm:text-xs leading-relaxed mt-2 max-w-xs font-normal">
                        {{ __('Interactive preview portals. Hover over cards for live website previews and direct access.') }}
                    </p>
                </div>
            @endif

            </div>
        @else
            <div class="text-center py-20 bg-white rounded-[2.5rem] border border-slate-200/80 shadow-md">
                <h3 class="text-lg font-bold text-slate-700">No projects listed yet</h3>
            </div>
        @endif
    </div>
</div>
