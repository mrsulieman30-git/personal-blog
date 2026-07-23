@extends('layouts.app')

@section('seo')
    <title>About Me — Mohammad Sulieman Ibrahim</title>
    <meta name="description" content="Learn more about Mohammad Sulieman Ibrahim — Laboratory Manager, Expert, and Developer.">
@endsection

@section('content')
<div x-data="{ 
    modalOpen: false, 
    modalImage: '', 
    openModal(image) { 
        if(image) {
            this.modalImage = image; 
            this.modalOpen = true; 
        }
    } 
}">

    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden -mt-32 sm:-mt-40">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 start-10 w-72 h-72 bg-indigo-500 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-10 end-20 w-96 h-96 bg-purple-600 rounded-full blur-[150px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-12">
                {{-- Profile Photo --}}
                <div class="shrink-0">
                    @php $authorPhoto = $siteSettings->get('author_photo'); @endphp
                    @if($authorPhoto)
                        <img src="{{ asset('storage/' . $authorPhoto) }}" alt="Mohammad Sulieman Ibrahim"
                             class="w-40 h-40 md:w-48 md:h-48 rounded-3xl object-cover border-4 border-indigo-500/30 shadow-2xl shadow-indigo-500/20">
                    @else
                        <div class="w-40 h-40 md:w-48 md:h-48 rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center border-4 border-indigo-500/30 shadow-2xl shadow-indigo-500/20">
                            <span class="text-6xl md:text-7xl font-bold text-white">M</span>
                        </div>
                    @endif
                </div>

                {{-- Bio Text --}}
                <div class="text-center md:text-start">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-indigo-300 text-sm font-medium mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        {{ __('About Me') }}
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 tracking-tight">
                        Mohammad Sulieman Ibrahim
                    </h1>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-500/10 border border-green-500/20 rounded text-green-400 text-sm font-bold mb-4 uppercase tracking-wider">
                        {{ __('MOH UAE & Sudan Licensed') }}
                    </div>
                    <p class="text-xl text-indigo-300 font-medium mb-6">
                        {{ __('Laboratory Manager | Hematology & Immunology Expert | Bioinformatics & Data Science') }}
                    </p>
                    <p class="text-slate-400 text-lg leading-relaxed max-w-3xl">
                        {{ __('With over 8 years of experience in medical laboratory sciences, I currently serve as a Medical Laboratory Manager at Kaafi hospital. I perform all types of medical laboratory tests, with specialized expertise in fertility tests and semen analysis. In my managerial role, I prioritize Quality Control (QC) and accuracy above all else to ensure the highest standards of patient care. I am also a certified trainer, passionate about bridging theoretical knowledge with hands-on expertise, web development, and data science.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Resume Sections --}}
    <section class="py-16 md:py-24 bg-slate-50 relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                {{-- Left Column: Dynamic Content --}}
                <div class="lg:col-span-2 space-y-16">
                    
                    {{-- 1. Experience --}}
                    @if(isset($experience) && $experience->count() > 0)
                    <div>
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h2 class="text-3xl font-black text-slate-900">{{ __('Experience') }}</h2>
                        </div>

                        <div class="space-y-8 relative before:absolute before:inset-0 before:ms-5 before:rtl:-translate-x-px before:ltr:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">
                            @foreach($experience as $item)
                            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group {{ $item->image_path ? 'cursor-pointer' : '' }}" 
                                 @if($item->image_path) x-on:click="openModal('{{ asset('storage/' . $item->image_path) }}')" @endif>
                                <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-indigo-500 text-white shadow shrink-0 md:order-1 md:group-odd:rtl:translate-x-1/2 md:group-odd:ltr:-translate-x-1/2 md:group-even:rtl:-translate-x-1/2 md:group-even:ltr:translate-x-1/2 transition-transform group-hover:scale-110">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-6 rounded-2xl bg-white shadow-sm border border-slate-100 transition-all group-hover:shadow-md group-hover:border-indigo-200">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="font-bold text-slate-900 text-lg">{{ $item->title }}</h3>
                                        @if($item->image_path)
                                            <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" title="View Certificate"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        @endif
                                    </div>
                                    @if($item->subtitle)
                                        <div class="text-sm font-medium text-indigo-600 mb-2">{{ $item->subtitle }}</div>
                                    @endif
                                    @if($item->date_range)
                                        <div class="text-xs text-slate-400 font-medium uppercase tracking-wider mb-3">{{ $item->date_range }}</div>
                                    @endif
                                    @if($item->description)
                                        <p class="text-slate-500 text-sm leading-relaxed">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- 2. Systemic Education --}}
                    @if(isset($education) && $education->count() > 0)
                    <div>
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                            </div>
                            <h2 class="text-3xl font-black text-slate-900">{{ __('Systemic Education') }}</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($education as $item)
                            <div class="p-6 rounded-2xl bg-white border border-slate-100 shadow-sm transition-all hover:shadow-md hover:border-purple-200 {{ $item->image_path ? 'cursor-pointer' : '' }}"
                                 @if($item->image_path) x-on:click="openModal('{{ asset('storage/' . $item->image_path) }}')" @endif>
                                <div class="flex items-start justify-between">
                                    <h3 class="font-bold text-slate-900 mb-1 pe-2">{{ $item->title }}</h3>
                                    @if($item->image_path)
                                        <svg class="w-5 h-5 text-purple-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    @endif
                                </div>
                                @if($item->subtitle)
                                    <div class="text-sm font-medium text-purple-600 mb-2">{{ $item->subtitle }}</div>
                                @endif
                                @if($item->date_range)
                                    <div class="text-xs text-slate-400 font-medium mb-3">{{ $item->date_range }}</div>
                                @endif
                                @if($item->description)
                                    <p class="text-slate-500 text-sm leading-relaxed">{{ $item->description }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- 3. Courses --}}
                    @if(isset($courses) && $courses->count() > 0)
                    <div>
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <h2 class="text-3xl font-black text-slate-900">{{ __('Courses') }}</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($courses as $item)
                            <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm transition-all hover:shadow-md hover:border-sky-200 {{ $item->image_path ? 'cursor-pointer group' : '' }}"
                                 @if($item->image_path) x-on:click="openModal('{{ asset('storage/' . $item->image_path) }}')" @endif>
                                <div class="flex items-start justify-between">
                                    <h3 class="font-bold text-slate-800 mb-1 pe-2 text-sm">{{ $item->title }}</h3>
                                    @if($item->image_path)
                                        <svg class="w-4 h-4 text-sky-400 shrink-0 mt-0.5 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    @if($item->subtitle)
                                        <div class="text-xs font-semibold text-sky-600">{{ $item->subtitle }}</div>
                                    @endif
                                    @if($item->date_range)
                                        <div class="text-[10px] text-slate-400 uppercase font-medium">{{ $item->date_range }}</div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>

                {{-- Right Column: Skills & Licenses --}}
                <div class="space-y-8">
                    {{-- Skills Widget --}}
                    <div class="sticky top-24 bg-white p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
                        <h2 class="text-2xl font-black text-slate-900 mb-6">{{ __('Expertise & Skills') }}</h2>
                        
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">{{ __('Laboratory & Medical') }}</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1.5 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-lg">Clinical Chemistry</span>
                                    <span class="px-3 py-1.5 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-lg">Microbiology</span>
                                    <span class="px-3 py-1.5 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-lg">Hematology</span>
                                    <span class="px-3 py-1.5 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-lg">Histopathology</span>
                                    <span class="px-3 py-1.5 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-lg">Parasitology</span>
                                    <span class="px-3 py-1.5 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-lg">Lab Management</span>
                                </div>
                            </div>
                            
                            <hr class="border-slate-100">

                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">{{ __('Data Science & AI') }}</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1.5 bg-purple-50 text-purple-700 text-sm font-medium rounded-lg">Python</span>
                                    <span class="px-3 py-1.5 bg-purple-50 text-purple-700 text-sm font-medium rounded-lg">SQL</span>
                                    <span class="px-3 py-1.5 bg-purple-50 text-purple-700 text-sm font-medium rounded-lg">Jupyter</span>
                                    <span class="px-3 py-1.5 bg-purple-50 text-purple-700 text-sm font-medium rounded-lg">Data Analysis</span>
                                    <span class="px-3 py-1.5 bg-purple-50 text-purple-700 text-sm font-medium rounded-lg">ChatGPT</span>
                                    <span class="px-3 py-1.5 bg-purple-50 text-purple-700 text-sm font-medium rounded-lg">Prompt Engineering</span>
                                </div>
                            </div>

                            <hr class="border-slate-100">

                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">{{ __('Web Development') }}</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1.5 bg-sky-50 text-sky-700 text-sm font-medium rounded-lg">HTML5</span>
                                    <span class="px-3 py-1.5 bg-sky-50 text-sky-700 text-sm font-medium rounded-lg">CSS</span>
                                    <span class="px-3 py-1.5 bg-sky-50 text-sky-700 text-sm font-medium rounded-lg">JavaScript</span>
                                    <span class="px-3 py-1.5 bg-sky-50 text-sky-700 text-sm font-medium rounded-lg">PHP</span>
                                    <span class="px-3 py-1.5 bg-sky-50 text-sky-700 text-sm font-medium rounded-lg">WordPress</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 4. Licenses & Certifications Gallery Section --}}
    @if(isset($licenses) && $licenses->count() > 0)
    <section class="py-16 md:py-24 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-4">{{ __('Licenses & Certifications') }}</h2>
                <p class="text-slate-500 text-lg">{{ __('My professional licenses and verified certificates.') }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($licenses as $cert)
                    <div class="group relative bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 {{ $cert->image_path ? 'cursor-pointer' : '' }}"
                         @if($cert->image_path) x-on:click="openModal('{{ asset('storage/' . $cert->image_path) }}')" @endif>
                        
                        {{-- Image Container with Security Measures --}}
                        <div class="relative h-64 bg-slate-100 overflow-hidden" 
                             oncontextmenu="return false;" 
                             ondragstart="return false;" 
                             style="user-select: none; -webkit-user-drag: none;">
                            
                            {{-- Transparent Overlay to block right click save-as even more effectively --}}
                            <div class="absolute inset-0 z-10 w-full h-full cursor-default bg-transparent" oncontextmenu="return false;"></div>
                            
                            @if($cert->image_path)
                                <img src="{{ asset('storage/' . $cert->image_path) }}" 
                                     alt="License" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 pointer-events-none"
                                     style="-webkit-touch-callout: none;">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors z-0 flex items-center justify-center">
                                    <div class="bg-white/90 text-slate-900 px-4 py-2 rounded-full font-bold shadow-lg opacity-0 group-hover:opacity-100 transform scale-95 group-hover:scale-100 transition-all flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        View Certificate
                                    </div>
                                </div>
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                    <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span class="text-sm font-medium">Pending Upload</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-slate-900 text-lg mb-2 line-clamp-2">{{ $cert->title }}</h3>
                            @if($cert->subtitle)
                                <p class="text-sm font-medium text-emerald-600 mb-1">{{ $cert->subtitle }}</p>
                            @endif
                            @if($cert->date_range)
                                <p class="text-xs text-slate-400 font-medium uppercase">{{ $cert->date_range }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Contact Section --}}
    <section class="py-16 md:py-24 bg-slate-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">{{ __("Let's Connect") }}</h2>
            <p class="text-slate-400 text-lg mb-12">{{ __('Feel free to reach out or follow my work on these platforms.') }}</p>

            <div class="flex flex-wrap justify-center gap-6">
                @if($siteSettings->get('author_email'))
                    <a href="mailto:{{ $siteSettings->get('author_email') }}" class="flex items-center gap-3 px-6 py-3 rounded-full bg-white/10 text-white hover:bg-white hover:text-slate-900 transition-colors border border-white/20 hover:border-transparent font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Email Me
                    </a>
                @endif
                
                @if($siteSettings->get('linkedin_url'))
                    <a href="{{ $siteSettings->get('linkedin_url') }}" target="_blank" class="flex items-center gap-3 px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.064-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path></svg>
                        LinkedIn
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- The Protected Modal Popup --}}
    <div x-cloak x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/95 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        {{-- Close button --}}
        <button @click="modalOpen = false" class="absolute top-6 right-6 text-white/70 hover:text-white bg-slate-800/50 hover:bg-slate-800 rounded-full p-2 transition-all z-[60]">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        {{-- Image Container (Protected) --}}
        <div class="relative max-w-5xl w-full max-h-[90vh] flex items-center justify-center rounded-xl overflow-hidden shadow-2xl"
             @click.outside="modalOpen = false"
             oncontextmenu="return false;" 
             ondragstart="return false;" 
             style="user-select: none; -webkit-user-drag: none;">
            
            {{-- Image --}}
            <img :src="modalImage" class="max-w-full max-h-[90vh] object-contain rounded-xl pointer-events-none" style="-webkit-touch-callout: none;">
            
            {{-- Invisible overlay to trap right-clicks --}}
            <div class="absolute inset-0 z-10 bg-transparent cursor-default"></div>

            {{-- Watermark Grid Overlay --}}
            <div class="absolute inset-0 z-20 pointer-events-none overflow-hidden opacity-[0.15] flex flex-wrap content-center justify-center gap-12 rotate-[-25deg] scale-150">
                @for($i = 0; $i < 40; $i++)
                    <div class="text-white text-5xl font-black uppercase tracking-widest" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">SAMPLE</div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection