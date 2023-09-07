<?php

namespace App\Charts;

use App\Models\Bahans;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PenggunaansChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $stok1 = Bahans::get()->sum('stok');
        $stok2 = Bahans::get()->sum('digunakan');
        $stokReal = $stok1 - $stok2;

        $data = [
            $stokReal,
            $alat2 = Bahans::get()->sum('digunakan'),
        ];

        return $this->chart->donutChart()
            ->setTitle('Persentase Jumlah Bahan')
            ->setSubtitle('Total Keseluruhan alat berjumlah '. $stok1)
            ->addData($data)
            ->setLabels(['Tersedia', 'Digunakan'])
            ->setColors(['#6777EF','#141E46'])
            ->setHeight(250);
    }
}
