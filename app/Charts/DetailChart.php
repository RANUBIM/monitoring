<?php

namespace App\Charts;

use App\Models\PeminjamanAlats;
use App\Models\Peminjamans;
use App\Models\PenggunaanBahans;
use App\Models\Penggunaans;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class DetailChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        $dataPeminjaman = Peminjamans::with('dataUser','dataAlat.dataLabor')->get();
        $peminjaman = [
            $dataPeminjaman = Peminjamans::where('tgl_peminjaman','LIKE','%'.'2023-06'.'%')->get()->count(),
            $dataPeminjaman = Peminjamans::where('tgl_peminjaman','LIKE','%'.'2023-07'.'%')->get()->count(),
            $dataPeminjaman = Peminjamans::where('tgl_peminjaman','LIKE','%'.'2023-08'.'%')->get()->count(),
        ];

        
        $penggunaan = [
            Penggunaans::where('tgl_permintaan','LIKE','%'.'2023-06'.'%')->get()->count(),
            Penggunaans::where('tgl_permintaan','LIKE','%'.'2023-07'.'%')->get()->count(),
            Penggunaans::where('tgl_permintaan','LIKE','%'.'2023-08'.'%')->get()->count(),
        ];

        $label = [
            'Juni',
            'Juli',
            'Agustus',
        ];

        return $this->chart->horizontalBarChart()
            ->setTitle('Statistik Jumlah Penggunaan Asset')
            ->setSubtitle('Penggunaan Asset Bulanan')
            ->setColors(['#6777EF','#141E46'])
            ->addData('Alat', $peminjaman)
            ->addData('Bahan', $penggunaan)
            ->setXAxis($label)
            ->setHeight(235);
    }
}
