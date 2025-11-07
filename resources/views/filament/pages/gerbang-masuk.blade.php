<x-filament-panels::page>

    <div class="flex flex-wrap gap-4">
        {{-- 
          Loop semua jenis kendaraan dari database
          dan buat satu tombol untuk setiap jenis
        --}}
        @foreach ($this->jenisKendaraan as $jenis)

            {{-- 
              Ini adalah implementasi alur:
              - Tombol adalah link <a>
              - Menjalankan route 'karcis.generate'
              - target="_blank" akan membukanya di TAB BARU
            --}}
            <a href="{{ route('karcis.generate', ['id_jenis' => $jenis->id_jenis]) }}" 
               target="_blank"
               class="
                fi-btn 
                fi-btn-size-lg 
                fi-btn-color-primary 
                fi-btn-style-filled
                rounded-lg
                font-semibold
                shadow-lg
                px-8
                py-4
               "
            >
                MASUK {{ strtoupper($jenis->nama_jenis) }}
            </a>
            
        @endforeach
    </div>

</x-filament-panels::page>