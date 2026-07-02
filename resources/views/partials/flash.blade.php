@if (session('status'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
        class="mb-6 flex items-start gap-3 rounded-xl bg-primary-50 dark:bg-primary-500/10 border border-primary-200 dark:border-primary-500/30 text-primary-800 dark:text-primary-200 px-4 py-3">
        <i class="fa-solid fa-circle-check mt-0.5"></i>
        <span class="text-sm font-medium">{{ session('status') }}</span>
        <button @click="show = false" class="ml-auto text-primary-500 hover:text-primary-700"><i class="fa-solid fa-xmark"></i></button>
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/30 text-red-700 dark:text-red-300 px-4 py-3">
        <p class="font-semibold text-sm flex items-center gap-2"><i class="fa-solid fa-triangle-exclamation"></i> Periksa kembali isian berikut:</p>
        <ul class="list-disc list-inside text-sm mt-1.5 space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
