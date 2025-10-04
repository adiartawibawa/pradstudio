<div>

    <style>
        .carousel-container {
            perspective: 1000px;
            touch-action: pan-y pinch-zoom;
        }

        .carousel-track {
            transform-style: preserve-3d;
            transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .carousel-item {
            backface-visibility: hidden;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .carousel-item.active {
            opacity: 1;
            transform: scale(1) translateZ(0);
        }

        @media (max-width: 640px) {
            .carousel-item.prev {
                opacity: 0;
                transform: scale(0.8) translateX(-50%) translateZ(-100px);
            }

            .carousel-item.next {
                opacity: 0;
                transform: scale(0.8) translateX(50%) translateZ(-100px);
            }
        }

        @media (min-width: 641px) {
            .carousel-item.prev {
                opacity: 0.7;
                transform: scale(0.9) translateX(-100%) translateZ(-100px);
            }

            .carousel-item.next {
                opacity: 0.7;
                transform: scale(0.9) translateX(100%) translateZ(-100px);
            }
        }

        .carousel-item.hidden {
            opacity: 0;
            transform: scale(0.8) translateZ(-200px);
        }

        .nav-button {
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        @media (hover: hover) {
            .nav-button:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: scale(1.1);
            }
        }

        .nav-button:active {
            transform: scale(0.95);
        }

        .progress-bar {
            transition: width 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }
    </style>

    <div class="w-full mx-auto pb-8">
        <!-- Carousel container -->
        <div class="carousel-container relative">

            <!-- Navigation buttons -->
            <button
                class="nav-button absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center z-20 text-white touch-manipulation"
                onclick="prevSlide()" title="Previous slide">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button
                class="nav-button absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center z-20 text-white touch-manipulation"
                onclick="nextSlide()" title="Next slide">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Carousel track -->
            <div class="carousel-track relative h-[300px] sm:h-[400px] md:h-[500px] overflow-hidden">
                @foreach ($featured as $index => $post)
                    <article>
                        <a href="{{ route('blog.read', $post->slug) }}"
                            class="carousel-item absolute top-0 left-0 w-full h-full {{ $index === 0 ? 'active' : 'hidden' }}">
                            <div class="w-full h-full p-4 sm:p-8">
                                <div class="w-full h-full rounded-xl sm:rounded-2xl overflow-hidden relative group">
                                    <img src="{{ $post->cover_url ?? 'https://picsum.photos/800/400' }}"
                                        alt="{{ $post->title }}"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-purple-500/40 to-pink-500/40 mix-blend-overlay">
                                    </div>
                                    <div
                                        class="absolute inset-x-0 bottom-0 p-4 sm:p-8 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                                        <h3 class="text-white text-xl md:text-2xl font-bold mb-2 sm:mb-3 line-clamp-2">
                                            {{ $post->title }}
                                        </h3>
                                        <p class="text-gray-200 text-sm md:text-base max-w-2xl line-clamp-3">
                                            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <!-- Indicators -->
            <div class="absolute bottom-2 sm:bottom-4 left-1/2 -translate-x-1/2 flex gap-1 sm:gap-2 z-20">
                @foreach ($featured as $index => $post)
                    <button
                        class="w-8 sm:w-12 h-1 sm:h-1.5 rounded-full transition-colors {{ $index === 0 ? 'bg-white/40' : 'bg-white/20' }} hover:bg-white/60"
                        title="Go to slide {{ $index + 1 }}"></button>
                @endforeach
            </div>

        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-item');
        const indicators = document.querySelectorAll('.bottom-2 button, .bottom-4 button');
        const progressBar = document.querySelector('.progress-bar');
        let autoAdvanceTimer;
        let touchStartX = 0;
        let touchEndX = 0;
        const carousel = document.querySelector('.carousel-track');

        // Add touch events for swipe
        carousel.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, {
            passive: true
        });

        carousel.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, {
            passive: true
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
            }
        }

        function updateSlides() {
            slides.forEach((slide, index) => {
                slide.className = 'carousel-item absolute top-0 left-0 w-full h-full';
                if (index === currentSlide) {
                    slide.classList.add('active');
                } else if (index === (currentSlide + 1) % slides.length) {
                    slide.classList.add('next');
                } else if (index === (currentSlide - 1 + slides.length) % slides.length) {
                    slide.classList.add('prev');
                } else {
                    slide.classList.add('hidden');
                }
            });

            // Update indicators
            indicators.forEach((indicator, index) => {
                indicator.className = `w-8 sm:w-12 h-1 sm:h-1.5 rounded-full transition-colors ${
                    index === currentSlide ? 'bg-white/40' : 'bg-white/20'
                } hover:bg-white/60`;
            });

            // Update progress bar
            progressBar.style.width = `${((currentSlide + 1) / slides.length) * 100}%`;
        }

        function resetAutoAdvance() {
            clearInterval(autoAdvanceTimer);
            autoAdvanceTimer = setInterval(nextSlide, 5000);
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            updateSlides();
            resetAutoAdvance();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            updateSlides();
            resetAutoAdvance();
        }

        // Add click handlers to indicators
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentSlide = index;
                updateSlides();
                resetAutoAdvance();
            });
        });

        // Initialize auto advance
        resetAutoAdvance();

        // Initialize slides
        updateSlides();
    </script>
</div>
