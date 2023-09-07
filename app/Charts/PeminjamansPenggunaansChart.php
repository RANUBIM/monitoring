<?php

namespace App\Charts;

use App\Models\Peminjamans;
use App\Models\Penggunaans;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PeminjamansPenggunaansChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $peminjaman = [
            0,
            Peminjamans::where('tgl_peminjaman','LIKE','%'.'2023-06'.'%')->get()->count(),
            Peminjamans::where('tgl_peminjaman','LIKE','%'.'2023-07'.'%')->get()->count(),
            Peminjamans::where('tgl_peminjaman','LIKE','%'.'2023-08'.'%')->get()->count(),
        ];
        
        $penggunaan = [
            0,
            Penggunaans::where('tgl_permintaan','LIKE','%'.'2023-06'.'%')->get()->count(),
            Penggunaans::where('tgl_permintaan','LIKE','%'.'2023-07'.'%')->get()->count(),
            Penggunaans::where('tgl_permintaan','LIKE','%'.'2023-08'.'%')->get()->count(),
        ];

        return $this->chart->lineChart()
                ->setTitle('Statistik Penggunaan Asset')
            ->setSubtitle('Peminjaman alat dan Penggunaan bahan')
            ->addData('Peminjaman', $peminjaman)
            ->addData('Penggunaan', $penggunaan)
            ->setXAxis(['', 'Juni', 'Juli', 'Agustus'])
            ->setColors(['#6777EF','#141E46'])
            ->setHeight(235);
    }
}
