<x-guest-layout :title="'Home — ' . config('app.name')">
    <!-- Hero Section -->
    <section
        class="flex flex-col-reverse md:flex-row items-center justify-between gap-12 px-6 py-20 max-w-7xl mx-auto w-full">
        <!-- Left -->
        <div class="flex-1 space-y-6">
            {{-- <span class="px-3 py-1 rounded-full border text-xs font-medium">UI/UX Team</span> --}}
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Creating digital products <br>
                and experiences <br>
                for <span class="italic font-serif">all-kind of desires</span>
            </h1>
            <p class="text-neutral-600 dark:text-neutral-400 max-w-md">
                We design clean, modern, and effective digital solutions that connect ideas with users.
            </p>
            <div class="flex gap-4 pt-2">
                <a href="#"
                    class="w-10 h-10 flex items-center justify-center rounded-full border hover:bg-neutral-200 dark:hover:bg-neutral-800 transition">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#"
                    class="w-10 h-10 flex items-center justify-center rounded-full border hover:bg-neutral-200 dark:hover:bg-neutral-800 transition">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="#"
                    class="w-10 h-10 flex items-center justify-center rounded-full border hover:bg-neutral-200 dark:hover:bg-neutral-800 transition">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>
        </div>

        <!-- Right (Illustration) -->
        <div class="flex-1 flex justify-center">
            <!-- Ilustrasi Flat Orang -->
            <img src="/img/bg-illustration.svg" alt="Hero Illustration" class="max-h-[400px] object-contain">
        </div>
    </section>
</x-guest-layout>
