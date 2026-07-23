@php
    $ogImage = $post->display_image;
    if (str_contains($ogImage, 'unsplash.com')) {
        $ogImage = str_replace(['w=1200', 'w=800'], 'w=600&q=70', $ogImage);
    }
@endphp
@section('seo')
    <title>{{ $post->title }} | {{ config('app.name') }}</title>
    <meta name="description" content="{{ $post->excerpt }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{!! request()->fullUrl() !!}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->excerpt }}">
    <meta property="og:image" content="{!! $ogImage !!}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{!! request()->fullUrl() !!}">
    <meta property="twitter:title" content="{{ $post->title }}">
    <meta property="twitter:description" content="{{ $post->excerpt }}">
    <meta property="twitter:image" content="{!! $ogImage !!}">
@endsection

<div class="bg-white min-h-screen font-sans print:bg-white -mt-32 sm:-mt-40">
    <!-- Web UI -->
    <div class="print:hidden">

    <!-- Hero Featured Image — Full-Width Immersive Header -->
    <div class="relative w-full h-[50vh] md:h-[60vh] lg:h-[65vh] overflow-hidden">
        <img
            src="{{ $post->display_image }}"
            alt="{{ $post->title }}"
            class="absolute inset-0 w-full h-full object-cover"
        >
        <!-- Gradient overlays for readability -->
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-slate-950/10"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/30 via-transparent to-slate-950/30"></div>

        <!-- Back Button — Top Left -->
        <div class="absolute top-32 sm:top-40 left-0 right-0 z-30">
            <div class="container mx-auto px-4 md:px-8 max-w-5xl py-5 flex items-center justify-between">
                <a href="{{ $post->type === 'ad' ? '/offers' : '/blog' }}" class="flex items-center gap-2 text-white/80 hover:text-white text-sm font-semibold transition-colors group backdrop-blur-sm bg-white/10 px-4 py-2 rounded-full">
                    <x-heroicon-m-arrow-left class="w-4 h-4 group-hover:-translate-x-1 transition-transform" />
                    {{ __('Back') }}
                </a>
                <div class="flex items-center gap-2">
                    <button 
                        x-data="{ canShare: !!navigator.share }"
                        @click="if(canShare) { navigator.share({ title: '{{ addslashes($post->title) }}', url: '{{ request()->fullUrl() }}' }) } else { window.open('https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}', '_blank') }"
                        class="p-2.5 text-white/70 hover:text-white transition-colors backdrop-blur-sm bg-white/10 rounded-full hover:bg-white/20" 
                        title="{{ __('Share') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                    </button>
                    <button onclick="window.print()" class="p-2.5 text-white/70 hover:text-white transition-colors backdrop-blur-sm bg-white/10 rounded-full hover:bg-white/20" title="Print">
                        <x-heroicon-m-printer class="w-4 h-4" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Title & Meta — Bottom of Hero -->
        <div class="absolute bottom-0 left-0 right-0 z-20">
            <div class="container mx-auto px-4 md:px-8 max-w-5xl pb-10 md:pb-14">
                <!-- Badges -->
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    @if($post->type === 'ad')
                        <span class="inline-block bg-red-500 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-full shadow-md">{{ __('Special Offer') }}</span>
                    @endif
                    @if($post->category)
                        <span class="inline-block bg-white/20 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full border border-white/20">{{ $post->category->name }}</span>
                    @endif
                    <span class="inline-block text-white/60 text-xs font-medium">{{ $post->created_at->format('M j, Y') }}</span>
                    <span class="text-white/30">·</span>
                    <span class="inline-block text-white/60 text-xs font-medium">{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} {{ __('min read') }}</span>
                </div>

                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight max-w-3xl">
                    {{ $post->title }}
                </h1>
            </div>
        </div>
    </div>

    <!-- Article Body — Elevated Card Overlapping Hero -->
    <div class="relative z-10 -mt-6 md:-mt-10">
        <div class="container mx-auto px-4 md:px-8 max-w-4xl">
            <div class="bg-white rounded-t-3xl shadow-xl border border-gray-100 px-6 md:px-12 pt-8 md:pt-12 pb-8">

                <!-- Excerpt / Lead Paragraph -->
                @if($post->excerpt)
                    <p class="text-base md:text-lg text-slate-600 font-medium leading-relaxed mb-8 border-l-4 border-indigo-500 pl-5 italic">
                        {{ $post->excerpt }}
                    </p>
                @endif

                <!-- Price Block for Offers -->
                @if($post->type === 'ad' && $post->new_price)
                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-2xl p-5 flex items-center gap-5 shadow-sm mb-8 max-w-md">
                        @if($post->old_price)
                            <div class="text-slate-400 font-bold text-lg line-through">${{ $post->old_price }}</div>
                        @endif
                        <div class="text-emerald-600 font-black text-3xl">${{ $post->new_price }}</div>
                        @if($post->old_price && $post->new_price)
                            <span class="bg-emerald-500 text-white text-xs font-black px-2.5 py-1 rounded-full">
                                -{{ round((($post->old_price - $post->new_price) / $post->old_price) * 100) }}%
                            </span>
                        @endif
                    </div>
                @endif

                <!-- Article Content -->
                <div class="prose prose-lg prose-slate max-w-none
                    prose-headings:font-black prose-headings:tracking-tight prose-headings:text-slate-900
                    prose-h2:text-2xl prose-h2:mt-12 prose-h2:mb-4 prose-h2:pb-3 prose-h2:border-b prose-h2:border-slate-100
                    prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                    prose-p:text-slate-700 prose-p:leading-relaxed
                    prose-a:text-indigo-600 prose-a:font-semibold prose-a:no-underline hover:prose-a:underline
                    prose-img:rounded-2xl prose-img:shadow-lg prose-img:my-8
                    prose-blockquote:border-indigo-500 prose-blockquote:bg-indigo-50/50 prose-blockquote:rounded-r-xl prose-blockquote:py-1 prose-blockquote:italic
                    prose-code:text-indigo-600 prose-code:bg-indigo-50 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:text-sm prose-code:font-semibold
                    prose-pre:bg-slate-900 prose-pre:rounded-2xl prose-pre:shadow-lg
                    prose-strong:text-slate-900
                    prose-li:text-slate-700
                    mb-12">
                    {!! $post->content !!}
                </div>

                <!-- Divider -->
                <div class="h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-8"></div>

                <!-- Engagement Section — Likes & Comments -->
                <div class="mb-8">
                    <!-- Flash Messages -->
                    @if (session()->has('message'))
                        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-blue-800 font-medium">{{ session('message') }}</p>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('warning'))
                        <div class="mb-6 bg-amber-50 border border-amber-200 rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <p class="text-amber-800 font-medium">{{ session('warning') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Like & Comment Stats Bar -->
                    <div class="flex items-center justify-between py-4 border-y border-slate-100">
                        <div class="flex items-center gap-5">
                            <button
                                wire:click="toggleLike"
                                class="flex items-center gap-2 px-5 py-2.5 rounded-full font-bold text-sm transition-all duration-300 {{ $userHasLiked ? 'bg-red-500 text-white shadow-lg shadow-red-500/25 hover:bg-red-600' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                            >
                                <svg class="w-4.5 h-4.5 {{ $userHasLiked ? 'text-white' : 'text-red-400' }}" fill="{{ $userHasLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                {{ $userHasLiked ? __('Liked') : __('Like') }}
                            </button>
                            <span class="text-slate-500 text-sm font-medium">{{ $likesCount }} {{ __('likes') }}</span>
                        </div>

                        <div class="flex items-center gap-2 text-slate-400 text-sm">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span class="font-medium">{{ $post->comments->count() }} {{ __('comments') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="space-y-6">
                    <h3 class="text-xl font-black text-slate-900">{{ __('Comments') }}</h3>

                    <!-- Comment Review Notice -->
                    <div class="bg-amber-50/60 border border-amber-200/60 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-amber-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <div>
                                <p class="text-amber-800 font-semibold text-sm">{{ __('Comments are moderated') }}</p>
                                <p class="text-amber-700 text-xs mt-0.5">{{ __('❤️ Likes are instant for everyone! 💬 Comments are reviewed by our team before being published. Please use only letters, numbers, and basic punctuation.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Add Comment Form -->
                    <div class="bg-slate-50/60 rounded-2xl p-5 md:p-6 border border-slate-100">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                @if(Auth::check())
                                    <span class="text-white font-bold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                @else
                                    <x-heroicon-s-user class="w-5 h-5 text-white" />
                                @endif
                            </div>
                            <div class="flex-1">
                                <form wire:submit.prevent="addComment">
                                    @if(!Auth::check())
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                                            <div>
                                                <input
                                                    wire:model="guestName"
                                                    type="text"
                                                    class="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white"
                                                    placeholder="{{ __('Your Name') }}"
                                                >
                                                @error('guestName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <input
                                                    wire:model="guestEmail"
                                                    type="email"
                                                    class="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white"
                                                    placeholder="{{ __('Your Email') }}"
                                                >
                                                @error('guestEmail') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    @endif

                                    <textarea
                                        wire:model="newComment"
                                        rows="3"
                                        class="w-full px-4 py-3 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none bg-white"
                                        placeholder="{{ __('Share your thoughts...') }}"
                                    ></textarea>
                                    @error('newComment') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                                    <div class="flex justify-end mt-3">
                                        <button
                                            type="submit"
                                            class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-600/20"
                                        >
                                            {{ __('Post Comment') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Display Comments -->
                    <div class="space-y-5">
                        <!-- Pending Comments (For current user only) -->
                        @if($pendingComments->count() > 0)
                            <div class="space-y-3 mb-6">
                                <h4 class="text-xs font-bold text-amber-600 uppercase tracking-wider flex items-center gap-2">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                    </span>
                                    {{ __('Your Comments (Pending Approval)') }}
                                </h4>
                                @foreach($pendingComments as $comment)
                                    <div class="flex items-start gap-3 p-4 bg-amber-50/60 rounded-xl border border-amber-100/80">
                                        <div class="w-9 h-9 bg-amber-200 rounded-full flex items-center justify-center flex-shrink-0">
                                            <span class="text-amber-700 font-bold text-xs">{{ strtoupper(substr($comment->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h4 class="font-bold text-slate-900 text-sm">{{ $comment->name }}</h4>
                                                <span class="text-[9px] bg-amber-200 text-amber-800 px-1.5 py-0.5 rounded-full font-black uppercase tracking-tight">{{ __('Pending') }}</span>
                                            </div>
                                            <p class="text-slate-500 italic text-sm leading-relaxed">{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Approved Comments -->
                        @forelse($approvedComments as $comment)
                            <div class="flex items-start gap-3 pb-5 border-b border-slate-100 last:border-b-0 last:pb-0">
                                <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-xs">{{ strtoupper(substr($comment->name, 0, 1)) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <h4 class="font-bold text-slate-900 text-sm">{{ $comment->name }}</h4>
                                        <span class="text-xs text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-slate-600 text-sm leading-relaxed">{{ $comment->content }}</p>
                                </div>
                            </div>
                        @empty
                            @if($pendingComments->count() == 0)
                                <div class="text-center py-10 text-slate-400">
                                    <svg class="w-10 h-10 mx-auto mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <p class="font-medium text-sm">{{ __('No comments yet. Be the first to share your thoughts!') }}</p>
                                </div>
                            @endif
                        @endforelse
                    </div>
                </div>

                <!-- Divider -->
                <div class="h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-8"></div>

                <!-- Related Articles Section -->
                @if($relatedPosts && $relatedPosts->count() > 0)
                    <div class="mb-10">
                        <h3 class="text-xl font-black text-slate-900 mb-6">{{ __('Related Articles') }}</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                            @foreach($relatedPosts as $relatedPost)
                                <a href="/posts/{{ $relatedPost->slug }}" class="group block bg-white rounded-2xl border-2 border-slate-100 shadow-sm hover:shadow-xl hover:border-indigo-100 transition-all duration-300 overflow-hidden flex flex-col h-full hover:-translate-y-1" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                    <div class="relative h-32 overflow-hidden bg-slate-100">
                                        <img src="{{ $relatedPost->display_image }}" alt="{{ $relatedPost->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    </div>
                                    <div class="p-4 flex flex-col flex-1">
                                        <h4 class="font-bold text-slate-900 text-sm leading-snug mb-2 group-hover:text-indigo-600 transition-colors line-clamp-2">{{ $relatedPost->title }}</h4>
                                        <div class="mt-auto flex items-center justify-between text-[11px] text-slate-500 font-bold tracking-wide pt-3 border-t border-slate-50 uppercase">
                                            <span>{{ $relatedPost->created_at->format('M j, Y') }}</span>
                                            <span>{{ ceil(str_word_count(strip_tags($relatedPost->content)) / 200) }} {{ __('min read') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Divider -->
                    <div class="h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-8"></div>
                @endif

                <!-- Author Footer -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg shadow-indigo-500/20 shrink-0">
                            <span class="text-white font-black text-lg">M</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Mohammad Sulieman Ibrahim</h4>
                            <p class="text-sm text-slate-500">{{ __('Full Stack Developer & Writer') }}</p>
                        </div>
                    </div>

                    <a href="/blog" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-slate-900 text-white px-7 py-3 rounded-xl font-bold text-sm shadow-lg hover:bg-slate-800 transition-all hover:shadow-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                        {{ __('More Articles') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
    </div>

    <!-- Print UI -->
    <div class="hidden print:block print:p-8 print:bg-white print:text-black print:max-w-4xl print:mx-auto" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <!-- Header -->
        <div class="flex justify-between items-end border-b-2 border-slate-900 pb-6 mb-8">
            <div>
                <h1 class="text-4xl font-black text-slate-900 mb-2">{{ $post->title }}</h1>
                <p class="text-lg text-slate-600 font-medium">{{ __('By Mohammad Sulieman') }}</p>
                <p class="text-sm text-slate-500 mt-1">{{ request()->fullUrl() }}</p>
            </div>
            <div class="text-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} flex flex-col items-{{ app()->getLocale() === 'ar' ? 'start' : 'end' }}">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(request()->fullUrl()) }}" alt="QR Code" class="w-24 h-24 mb-2 inline-block border border-slate-200 p-1 rounded-lg" />
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">{{ __('Scan to read online') }}</p>
            </div>
        </div>

        <!-- Content -->
        <div class="prose prose-slate max-w-none prose-img:max-h-96 prose-img:object-contain prose-a:text-black prose-a:no-underline">
            {!! $post->content !!}
        </div>

        <!-- Footer / CTA -->
        <div class="mt-12 pt-8 border-t-2 border-slate-900 break-inside-avoid">
            <h3 class="text-2xl font-black text-slate-900 mb-2">{{ __('Did you find this helpful?') }}</h3>
            <p class="text-slate-600 mb-4 text-lg">
                {{ __('I am :name, a :role. Let\'s connect and build something amazing together.', ['name' => 'Mohammad Sulieman', 'role' => __('Full Stack Developer & Writer')]) }}
            </p>
            <div class="flex items-center gap-6 text-sm text-slate-900 font-bold">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    {{ $siteSettings->get('contact_email', 'hello@sulieman.dev') }}
                </span>
                <span class="flex items-center gap-2" dir="ltr">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    {{ $siteSettings->get('contact_phone', '+252 61 500 0000') }}
                </span>
                <span class="flex items-center gap-2" dir="ltr">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    {{ url('/') }}
                </span>
            </div>
        </div>
    </div>
</div>
