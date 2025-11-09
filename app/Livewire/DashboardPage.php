<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use App\Models\JenisKendaraan;
use Illuminate\Support\Carbon;

class DashboardPage extends Component
{
    public $kendaraanMasukHariIni;
    public $pendapatanHariIni;
    public $kendaraanKeluarHariIni;

    public $revenueLabels = [];
    public $revenueData = [];
    public $vehicleLabels = [];
    public $vehicleData = [];

    public function mount()
    {
        $today = Carbon::today();

        $this->kendaraanMasukHariIni = Transaksi::whereDate('jam_masuk', $today)->count();
        $this->pendapatanHariIni = Transaksi::whereDate('jam_keluar', $today)->sum('total_biaya');
        $this->kendaraanKeluarHariIni = Transaksi::whereDate('jam_keluar', $today)->count();

        $revenueDates = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = $today->copy()->subDays($i);
            $revenueDates[] = $day;
            $this->revenueLabels[] = $day->format('d M');
        }
        foreach ($revenueDates as $date) {
            $this->revenueData[] = Transaksi::whereDate('jam_keluar', $date)->sum('total_biaya');
        }

        $vehicleTypes = JenisKendaraan::all();
        foreach ($vehicleTypes as $type) {
            $this->vehicleLabels[] = $type->nama_jenis;
            $this->vehicleData[] = Transaksi::where('id_jenis_fk', $type->id_jenis)
                                            ->whereNull('jam_keluar')
                                            ->count();
        }
    }

    public function render()
    {
        return view('livewire.dashboard-page')
            ->layout('layouts.app', [
                'title' => 'Dashboard'
            ]);
    }
}