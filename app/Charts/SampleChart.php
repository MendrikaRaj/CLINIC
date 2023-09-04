<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SampleChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->labels(['January', 'February', 'March', 'April', 'May', 'June'])
            ->dataset('Sample Data', [10, 20, 30, 40, 50, 60])
            ->options([
                'responsive' => true,
            ]);
    }
}
