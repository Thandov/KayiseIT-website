<x-app-layout title="Congratulations!">
    <style>
        @keyframes pop-in {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-pop-in { animation: pop-in 0.6s ease-out forwards; }
    </style>
    <div id="confetti-canvas" class="fixed inset-0 pointer-events-none z-50"></div>
    <div class="min-h-[80vh] flex flex-col items-center justify-center py-16 px-4 bg-white">
        <div class="text-center max-w-4xl w-full pt-16">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-7xl font-black text-[#16A34A] mb-6 animate-pop-in leading-tight break-words">
                Congratulations
            </h1>
            <p class="text-xl text-gray-600 mb-2">Your certificate is ready, {{ $name }}!</p>
            <p class="text-lg font-medium text-gray-700 mb-1">{{ $training_name ?? 'Business Essentials for Entrepreneurs' }}</p>
            <p class="text-gray-500 mb-10">Click below to download your PDF certificate.</p>
            <a href="{{ route('certification.download', ['token' => $download_token]) }}" style="display: inline-flex; align-items: center; padding: 1rem 2rem; background: #059669; color: white !important; font-weight: 700; font-size: 1.125rem; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#047857'" onmouseout="this.style.background='#059669'">
                <svg style="width: 1.5rem; height: 1.5rem; margin-right: 0.5rem; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Download Certificate
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const end = Date.now() + 1500;
            const colors = ['#10b981', '#059669', '#14b8a6', '#0d9488', '#34d399'];
            (function frame() {
                confetti({
                    particleCount: 3,
                    angle: 60,
                    spread: 55,
                    origin: { x: 0 },
                    colors: colors
                });
                confetti({
                    particleCount: 3,
                    angle: 120,
                    spread: 55,
                    origin: { x: 1 },
                    colors: colors
                });
                if (Date.now() < end) requestAnimationFrame(frame);
            }());
            setTimeout(function() {
                confetti({
                    particleCount: 100,
                    spread: 100,
                    origin: { y: 0.6 },
                    colors: colors
                });
            }, 200);
        });
    </script>
</x-app-layout>
