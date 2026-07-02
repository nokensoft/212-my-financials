{{-- Penanda bahwa halaman ini adalah SIMULASI (konsep desain, tanpa database/CRUD). --}}
<div class="mb-6 flex items-start gap-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3">
    <i class="fa-solid fa-flask mt-0.5"></i>
    <p class="text-sm font-medium">
        <span class="font-bold">Mode Simulasi.</span>
        {{ $note ?? 'Halaman ini adalah konsep desain. Data hanyalah contoh dan tombol aksi belum tersambung ke database.' }}
    </p>
</div>
