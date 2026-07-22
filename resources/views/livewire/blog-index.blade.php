<div>
    @section('seo')
        <title>{{ __('Blog') }} | {{ config('app.name') }}</title>
        <meta name="description" content="{{ __('Read the latest articles, thoughts, and insights from Mohammad Sulieman Ibrahim.') }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ request()->fullUrl() }}">
        <meta property="og:title" content="{{ __('Blog') }} | {{ config('app.name') }}">
        <meta property="og:description" content="{{ __('Read the latest articles, thoughts, and insights from Mohammad Sulieman Ibrahim.') }}">
        <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ request()->fullUrl() }}">
        <meta property="twitter:title" content="{{ __('Blog') }} | {{ config('app.name') }}">
        <meta property="twitter:description" content="{{ __('Read the latest articles, thoughts, and insights from Mohammad Sulieman Ibrahim.') }}">
        <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">
    @endsection

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50/30">

    <div class="container mx-auto px-4 pt-6 pb-6">
        <!-- Search & Filter Control Bar inside page body -->
        <div class="max-w-5xl mx-auto mb-8 bg-white/80 backdrop-blur-md border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <h1 class="text-xl font-black text-slate-900 tracking-tight">{{ __('Blog Articles') }}</h1>
            </div>

            <div class="flex items-center gap-3 flex-1 sm:flex-initial justify-end">
                <div class="relative flex-1 sm:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input
                        wire:model.live.debounce.300ms="search"
                        type="text"
                        class="w-full pl-9 pr-4 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 bg-slate-50"
                        placeholder="{{ __('Search articles...') }}"
                    >
                </div>

                <select
                    wire:model.live="selectedCategory"
                    class="bg-slate-50 border border-slate-200 px-3.5 py-2 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500 cursor-pointer hidden sm:block"
                >
                    <option value="">{{ __('All Categories') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Featured Posts Slider -->
        @if($featuredPosts->isNotEmpty() && empty($search) && is_null($selectedCategory))
            <div class="mb-10">
                <!-- Swiper CSS & JS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
                <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

                @php
                    $loopFeatured = $featuredPosts;
                    if ($featuredPosts->count() > 0 && $featuredPosts->count() < 12) {
                        $loopFeatured = $featuredPosts->concat($featuredPosts)->concat($featuredPosts)->concat($featuredPosts);
                    }
                @endphp

                <div x-data="{
                    swiper: null,
                    init() {
                        this.$nextTick(() => {
                            if (typeof Swiper !== 'undefined' && this.$refs.slider) {
                                const slideWidth = window.innerWidth < 640 ? 160 : (window.innerWidth < 768 ? 240 : 290);
                                this.swiper = new Swiper(this.$refs.slider, {
                                    centeredSlides: true,
                                    slidesPerView: 'auto',
                                    initialSlide: 3,
                                    loop: true,
                                    loopAdditionalSlides: 5,
                                    speed: 600,
                                    grabCursor: true,
                                    simulateTouch: true,
                                    allowTouchMove: true,
                                    touchRatio: 1,
                                    threshold: 5,
                                    preventClicks: true,
                                    preventClicksPropagation: true,
                                    watchSlidesProgress: true,
                                    autoplay: {
                                        delay: 2800,
                                        disableOnInteraction: false,
                                        pauseOnMouseEnter: true,
                                    },
                                    on: {
                                        setTranslate: function() {
                                            const slides = this.slides;
                                            const isMobile = window.innerWidth < 640;
                                            const overlapPx = isMobile ? 65 : 85;

                                            for (let i = 0; i < slides.length; i++) {
                                                const slide = slides[i];
                                                const progress = slide.progress;
                                                const absProgress = Math.abs(progress);

                                                const scaleDecayY = isMobile ? 0.15 : 0.13;
                                                const scaleDecayX = isMobile ? 0.09 : 0.08;
                                                const minScaleY = isMobile ? 0.78 : 0.55;
                                                const minScaleX = isMobile ? 0.82 : 0.65;

                                                const sy = Math.max(minScaleY, 1.0 - absProgress * scaleDecayY);
                                                const sx = Math.max(minScaleX, 1.0 - absProgress * scaleDecayX);
                                                const zIdx = Math.max(10, 100 - Math.round(absProgress * 20));

                                                // Smooth continuous cosine fade curve (no popping or jump)
                                                const maxVisibleProgress = isMobile ? 1.35 : 3.2;
                                                let op = 0;
                                                if (absProgress <= maxVisibleProgress) {
                                                    op = Math.cos((absProgress / maxVisibleProgress) * (Math.PI / 2));
                                                }

                                                const tx = progress * overlapPx;

                                                slide.style.transform =
                                                    'translateX(' + tx + 'px) scaleX(' + sx.toFixed(3) + ') scaleY(' + sy.toFixed(3) + ')';
                                                slide.style.zIndex = zIdx;
                                                slide.style.opacity = op.toFixed(3);
                                                slide.style.pointerEvents = op > 0.1 ? 'auto' : 'none';
                                                slide.style.transformOrigin = 'center center';
                                            }
                                        },
                                        setTransition: function(duration) {
                                            const easing = 'cubic-bezier(0.22, 1, 0.36, 1)';
                                            for (let i = 0; i < this.slides.length; i++) {
                                                this.slides[i].style.transition =
                                                    'transform ' + duration + 'ms ' + easing + ', ' +
                                                    'opacity ' + duration + 'ms ' + easing;
                                            }
                                        },
                                    },
                                });
                            }
                        });
                    }
                }" class="relative">
                    <div x-ref="slider" class="swiper ios-stack-slider !py-10 !overflow-visible max-w-5xl mx-auto" dir="ltr">
                        <div class="swiper-wrapper" style="align-items:center;">
                            @foreach($loopFeatured as $post)
                                <div class="swiper-slide !w-[220px] sm:!w-[260px] md:!w-[290px] h-auto shrink-0">
                                    <a href="/posts/{{ $post->slug }}" class="group block relative z-10" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                        <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-500 mx-1 border-2 border-slate-200 group-hover:border-[#003B73]">
                                            <div class="relative h-44 md:h-52 overflow-hidden">
                                                <img
                                                    src="{{ $post->display_image }}"
                                                    alt="{{ $post->title }}"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                                >
                                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>

                                                <!-- Featured Badge -->
                                                <div class="absolute top-3 left-3">
                                                    <span class="bg-[#003B73] text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-md">
                                                        {{ __('Featured') }}
                                                    </span>
                                                </div>

                                                <!-- Category Badge -->
                                                @if($post->category)
                                                    <div class="absolute top-3 right-3">
                                                        <span class="bg-white/90 text-slate-900 text-[10px] font-bold px-2.5 py-1 rounded-full backdrop-blur-sm shadow-sm">
                                                            {{ $post->category->name }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="p-4 md:p-5">
                                                <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                                </div>

                                                <h3 class="text-sm md:text-base font-bold text-slate-900 mb-2 group-hover:text-[#003B73] transition-colors leading-snug line-clamp-2">
                                                    {{ $post->title }}
                                                </h3>

                                                <p class="text-slate-500 text-xs leading-relaxed mb-3 line-clamp-2">
                                                    {{ $post->excerpt }}
                                                </p>

                                                <div class="flex items-center justify-between pt-2 border-t border-slate-100">
                                                    <span class="text-xs text-slate-400 font-medium">{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} {{ __('min read') }}</span>
                                                    <div class="flex items-center text-[#003B73] text-xs font-bold group-hover:translate-x-1 transition-transform">
                                                        {{ __('Read') }} <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Direction Controls -->
                        <button type="button" @click="swiper?.slidePrev()" aria-label="Previous" class="swiper-button-prev !text-[#003B73] !w-11 !h-11 !left-0 sm:!left-2 bg-white/90 hover:bg-white rounded-2xl shadow-xl transition-all after:!text-base cursor-pointer z-[110]"></button>
                        <button type="button" @click="swiper?.slideNext()" aria-label="Next" class="swiper-button-next !text-[#003B73] !w-11 !h-11 !right-0 sm:!right-2 bg-white/90 hover:bg-white rounded-2xl shadow-xl transition-all after:!text-base cursor-pointer z-[110]"></button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Posts Grid -->
        <div class="pb-16">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-black text-gray-900 mb-1">{{ __('Latest Articles') }}</h2>
                    <p class="text-gray-600">
                        @if($search)
                            {{ __('Search results for') }}: <span class="font-semibold text-gray-900">"{{ $search }}"</span>
                        @elseif($selectedCategory)
                            {{ __('Articles in') }}: <span class="font-semibold text-gray-900">{{ $categories->find($selectedCategory)?->name ?? 'Category' }}</span>
                        @else
                            {{ __('Explore all published articles and engineering thoughts') }}
                        @endif
                    </p>
                </div>

                <div class="hidden md:flex items-center gap-2 text-sm text-gray-500">
                    <span>{{ $posts->total() }} {{ __('articles found') }}</span>
                </div>
            </div>

            @if($posts->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                    @foreach($posts as $post)
                        <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:-translate-y-1">
                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden bg-gray-100">
                                <img
                                    src="{{ $post->display_image }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >

                                <!-- Badges Overlay -->
                                <div class="absolute top-3 left-3 flex flex-col items-start gap-1.5">
                                    @if($post->created_at > now()->subDays(7))
                                        <span class="inline-block bg-red-500 text-white text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">
                                            {{ __('New') }}
                                        </span>
                                    @endif

                                    @if($post->type === 'ad')
                                        <span class="inline-block bg-orange-500 text-white text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">
                                            {{ __('Offer') }}
                                        </span>
                                    @elseif($post->category)
                                        <span class="inline-block bg-[#003B73] text-white text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Reading Time Indicator -->
                                <div class="absolute bottom-3 right-3">
                                    <span class="bg-black/70 text-white text-xs px-2 py-1 rounded-full backdrop-blur-sm">
                                        {{ ceil(str_word_count(strip_tags($post->content)) / 200) }} {{ __('min read') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="flex items-center gap-3 text-xs text-gray-500 mb-3">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $post->created_at->format('M d, Y') }}
                                    </span>
                                    @if($post->user)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            {{ $post->user->name }}
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-[#0062B8] transition-colors leading-tight line-clamp-2">
                                    <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                                </h3>

                                <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                    {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
                                </p>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center gap-4 text-xs text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                            {{ $post->likes_count ?? 0 }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                            {{ $post->comments->where('is_approved', true)->count() }}
                                        </span>
                                    </div>

                                    <a href="/posts/{{ $post->slug }}" class="text-[#0062B8] font-semibold text-sm hover:text-[#003B73] transition-colors flex items-center group-hover:translate-x-1">
                                        {{ __('Read More') }}
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200 shadow-lg">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-2">{{ __('No articles found') }}</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        @if($search)
                            {{ __('We couldn\'t find any articles matching your search for') }} <strong>"{{ $search }}"</strong>
                        @else
                            {{ __('Check back later for new updates and engineering insights.') }}
                        @endif
                    </p>
                    @if($search)
                        <button wire:click="$set('search', '')" class="bg-[#003B73] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#0052a0] transition-colors">
                            {{ __('Clear Search') }}
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function featuredSlider() {
    return {
        init() {
            new Swiper(this.$refs.slider, {
                slidesPerView: 3,
                spaceBetween: 20,
                centeredSlides: true,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                slideToClickedSlide: true,
                touchStartPreventDefault: false,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    320: { slidesPerView: 1.2 },
                    640: { slidesPerView: 2.2 },
                    1024: { slidesPerView: 2.5 },
                    1280: { slidesPerView: 3 }
                },
                effect: 'coverflow',
                coverflowEffect: {
                    rotate: 0,
                    stretch: 0,
                    depth: 150,
                    modifier: 1,
                    slideShadows: false,
                }
            });
        }
    }
}
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.swiper-pagination-bullet {
    background-color: #cbd5e1;
    opacity: 1;
}

.swiper-pagination-bullet-active {
    background-color: #003B73;
    transform: scale(1.2);
}

.swiper-button-next,
.swiper-button-prev {
    color: #003B73 !important;
    background: white;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0, 59, 115, 0.15);
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 18px !important;
    font-weight: bold;
}

/* Custom Stacked Card Slider — transforms applied via JS setTranslate */
.ios-stack-slider .swiper-wrapper {
    transition-timing-function: cubic-bezier(0.22, 1, 0.36, 1) !important;
}

.ios-stack-slider .swiper-slide {
    will-change: transform, opacity;
    transform-origin: center center;
}
</style>
</div>
