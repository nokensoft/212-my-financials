{{-- Pengunggah bukti transfer: drag & drop + pratinjau gambar/PDF. Butuh Alpine.data('proofUploader'). --}}
@php($fieldName = $name ?? 'payment_proof')
@php($dragActive = $dragActive ?? 'border-rust bg-rust/5')
@php($accentText = $accentText ?? 'text-rust')
<div x-data="proofUploader()">
    <div @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="dragging = false; setFiles($event.dataTransfer.files)"
        @click="$refs.input.click()"
        :class="dragging ? '{{ $dragActive }}' : 'border-line'"
        class="cursor-pointer border-2 border-dashed rounded-xl p-3 text-center transition">
        <template x-if="preview">
            <img :src="preview" alt="Pratinjau bukti transfer" class="mx-auto max-h-48 w-full object-contain rounded-lg">
        </template>
        <template x-if="!preview && isPdf">
            <div class="py-6 {{ $accentText }}">
                <i class="fa-solid fa-file-pdf text-3xl mb-2"></i>
                <p class="text-sm font-semibold break-all px-4" x-text="fileName"></p>
                <p class="text-xs text-muted mt-0.5">Berkas PDF dipilih</p>
            </div>
        </template>
        <template x-if="!preview && !isPdf">
            <div class="py-8 text-muted">
                <i class="fa-solid fa-cloud-arrow-up text-2xl mb-2"></i>
                <p class="text-sm font-medium">Seret &amp; letakkan bukti transfer di sini</p>
                <p class="text-xs">atau klik untuk memilih berkas</p>
            </div>
        </template>
        <input x-ref="input" type="file" name="{{ $fieldName }}" accept="image/*,application/pdf" class="hidden"
            @change="setFiles($event.target.files)">
    </div>

    <div class="flex items-center justify-between gap-3 mt-2">
        <p class="text-xs text-muted">Format JPG, PNG, atau PDF. Maksimal 4 MB.</p>
        <button type="button" x-show="preview || fileName" x-cloak @click.stop="clear()"
            class="shrink-0 text-xs font-semibold text-red-500 hover:underline">
            <i class="fa-solid fa-xmark"></i> Bersihkan
        </button>
    </div>
</div>
