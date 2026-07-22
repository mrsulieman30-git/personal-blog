<div class="bg-gradient-to-b from-slate-50 via-white to-slate-50 py-12 font-sans relative overflow-hidden border-t border-slate-100">
    {{-- Swiper.js --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @php
        // Repeat posts to ensure continuous endless looping without any blank gaps
        $loopPosts = $posts;
        if ($posts->count() > 0 && $posts->count() < 12) {
            $loopPosts = $posts->concat($posts)->concat($posts)->concat($posts);
        }
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div x-data="{
            swiper: null,
            init() {
                const initSwiper = () => {
                    if (typeof Swiper !== 'undefined' && this.$refs.blogSlider) {
                        this.swiper = new Swiper(this.$refs.blogSlider, {
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
                    } else {
                        setTimeout(initSwiper, 50);
                    }
                };
                initSwiper();
            }
        }">

            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-0.5 bg-indigo-50 text-indigo-600 text-xs font-bold uppercase tracking-wider rounded-full mb-2 border border-indigo-100">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        {{ __('Articles & Insights') }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">{{ __('Latest Blog Posts') }}</h2>
                </div>

                {{-- Endless Direct-Method Controls --}}
                <div class="flex items-center gap-3">
                    <button type="button" @click="swiper?.slidePrev()" aria-label="Previous Slide" class="w-10 h-10 flex items-center justify-center rounded-2xl bg-white border border-slate-200/80 text-slate-700 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 shadow-md hover:shadow-indigo-200 transition-all duration-300 active:scale-95 cursor-pointer">
                        <x-heroicon-m-chevron-left class="w-5 h-5" />
                    </button>
                    <button type="button" @click="swiper?.slideNext()" aria-label="Next Slide" class="w-10 h-10 flex items-center justify-center rounded-2xl bg-white border border-slate-200/80 text-slate-700 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 shadow-md hover:shadow-indigo-200 transition-all duration-300 active:scale-95 cursor-pointer">
                        <x-heroicon-m-chevron-right class="w-5 h-5" />
                    </button>
                    <a href="/blog" class="ml-2 px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors hidden sm:block">{{ __('View All') }}</a>
                </div>
            </div>

            {{-- Custom Stacked Card Slider --}}
            <div x-ref="blogSlider" class="swiper ios-stack-slider !py-10 !overflow-visible max-w-5xl mx-auto" dir="ltr">
                <div class="swiper-wrapper" style="align-items:center;">
                    @forelse($loopPosts as $post)
                        <div class="swiper-slide !w-[220px] sm:!w-[260px] md:!w-[290px] h-auto shrink-0">
                            <a href="/posts/{{ $post->slug }}" class="flex flex-col h-full bg-white rounded-3xl overflow-hidden shadow-lg border-2 border-slate-200 hover:border-indigo-500 transition-shadow duration-500 group" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                <div class="relative h-40 sm:h-48 overflow-hidden bg-slate-100 shrink-0">
                                    <img src="{{ $post->display_image }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $post->title }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                    @if($post->category)
                                        <span class="absolute top-3 left-3 bg-white/90 text-slate-900 text-[11px] font-bold px-2.5 py-0.5 rounded-full backdrop-blur-md shadow-sm">{{ $post->category->name }}</span>
                                    @endif
                                </div>
                                <div class="p-4 flex flex-col flex-1">
                                    <p class="text-[10px] text-slate-400 font-bold mb-1 uppercase tracking-wider">{{ $post->created_at->format('M d, Y') }}</p>
                                    <h3 class="text-sm font-bold text-slate-900 leading-snug mb-1.5 group-hover:text-indigo-600 transition-colors line-clamp-2">{{ $post->title }}</h3>
                                    <p class="text-xs text-slate-500 leading-relaxed mb-3 line-clamp-2 font-normal">{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 80) }}</p>
                                    <div class="mt-auto flex items-center pt-2 border-t border-slate-100 text-indigo-600 text-xs font-bold group-hover:text-indigo-700 transition-colors">
                                        {{ __('Read Article') }} <x-heroicon-m-arrow-right class="w-3.5 h-3.5 ml-1 group-hover:translate-x-1 transition-transform" />
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="w-full text-center py-12 text-slate-400 font-medium">{{ __('Articles coming soon.') }}</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Stacked Card Slider — transforms applied via JS setTranslate --}}
    <style>
        .ios-stack-slider .swiper-wrapper {
            transition-timing-function: cubic-bezier(0.22, 1, 0.36, 1) !important;
        }

        .ios-stack-slider .swiper-slide {
            will-change: transform, opacity;
            transform-origin: center center;
        }
    </style>
</div>
