{{-- Pengunggah sampul: drag & drop + pratinjau. Butuh Alpine.data('coverUploader'). --}}
<div x-data="coverUploader(@js($current ? asset($current) : null))">
    <div @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="dragging = false; setFiles($event.dataTransfer.files)"
        @click="$refs.input.click()"
        :class="dragging ? 'border-primary bg-primary-50 dark:bg-primary-500/10' : 'border-slate-300 dark:border-white/15'"
        class="cursor-pointer border-2 border-dashed rounded-xl p-3 text-center transition">
        <template x-if="preview">
            <img :src="preview" alt="Pratinjau sampul" class="mx-auto max-h-40 w-full object-contain rounded-lg">
        </template>
        <template x-if="!preview">
            <div class="py-8 text-slate-400">
                <i class="fa-solid fa-cloud-arrow-up text-2xl mb-2"></i>
                <p class="text-sm font-medium">Seret &amp; letakkan gambar di sini</p>
                <p class="text-xs">atau klik untuk memilih berkas</p>
            </div>
        </template>
        <input x-ref="input" type="file" name="cover_image" accept="image/*" class="hidden"
            @change="setFiles($event.target.files)">
    </div>

    <div class="flex items-center gap-4 mt-2">
        <button type="button" x-show="preview" x-cloak @click.stop="clear()"
            class="text-xs font-semibold text-red-500 hover:underline">
            <i class="fa-solid fa-xmark"></i> Bersihkan pilihan
        </button>
        @if ($current)
            <label class="flex items-center gap-2 text-xs text-slate-600 dark:text-slate-300">
                <input x-ref="remove" type="checkbox" name="remove_cover" value="1"
                    @change="if ($event.target.checked) { preview = null; if ($refs.input) $refs.input.value = ''; }"
                    class="rounded text-primary focus:ring-primary"> Hapus sampul saat ini
            </label>
        @endif
    </div>
</div>
