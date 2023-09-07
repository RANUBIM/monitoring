<?php

namespace App\Charts;

use App\Models\Alats;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PeminjamansChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\pieChart
    {
        $stok1 = Alats::get()->sum('stok');
        $stok2 = Alats::get()->sum('dipinjam');
        $stokReal = $stok1 - $stok2;

        $data = [
            $stokReal,
            $alat2 = Alats::get()->sum('dipinjam'),
        ];
        // dd($data);

        return $this->chart->pieChart()
            ->setTitle('Persentase Jumlah Alat')
            ->setSubtitle('Total Keseluruhan alat berjumlah '. $stok1)
            ->addData($data)
            ->setLabels(['Tersedia', 'Dipinjam'])
            ->setColors(['#6777EF','#141E46','#252B48'])
            ->setHeight(250);
        // return $this->chart->lineChart()
        //     ->setTitle('Pengelolaan Asset')
        //     ->setSubtitle('Peminjaman alat dan Penggunaan bahan')
        //     ->addData('Peminjaman', [0, 12, 8, 20, 18, 15])
        //     ->addData('Penggunaan', [0, 14, 7, 10, 15, 12])
        //     ->setXAxis([ '', 'May', 'June','Juli', 'Agustus', 'September'])
        //     ->setColors(['#A1A1A1', '#000'])
        //     ->setHeight(250);
    }
}
