<?php 

class Forecasting_model
{
    private
        $period = [],
        $actual = [],
        $forecasting = [],
        $error = [],
        $smoothedError = [],
        $absoluteSmoothedError = [],
        $alpha = [],
        $beta = [],
        $percentageError = [],
        $meanAbsolutePercentageError = [],
        $result = [];

    public function period($initialPeriod, $finalPeriod)
    {
        $i = 0;
        while (date("Y-m", strtotime($initialPeriod)) <= date("Y-m", strtotime($finalPeriod))) {
            $this->period[$i] = date('F Y', strtotime($initialPeriod));
            $initialPeriod = date("Y-m", strtotime("+1 month", strtotime(date($initialPeriod))));
            $i++;
        }
        return $this->period;
    }

    public function getDataActual()
    {
        $this->period = $this->period($_POST['initialPeriod'], $_POST['finalPeriod']);
        foreach ($this->period as $p) {
            $p = 'actual-data-' . date("Y-m", strtotime($p));
            $this->actual[] = $_POST[$p];
        }
        return $this->actual;
    }

    public function getBeta()
    {
        for ($i = 0; $i < 100; $i += 1) {
            $this->beta[] = $i / 100;
        }
        return $this->beta;
    }

    public function forecastingARRES()
    {
        $this->period = $this->period($_POST['initialPeriod'], $_POST['finalPeriod']);
        $this->actual = $this->getDataActual();
        $this->beta = $this->getBeta();
        for ($i = 0; $i < count($this->beta); $i++) {
            for ($j = 1; $j < count($this->period); $j++) {

                // inisialisasi
                $this->forecasting[$i][0] = $this->error[$i][0] = $this->smoothedError[$i][0] = $this->absoluteSmoothedError[$i][0] = $this->alpha[$i][0] = $this->percentageError[$i][0] = 0;
                $this->forecasting[$i][1] = $this->actual[0];
                $this->alpha[$i][1] = $this->alpha[$i][2] = $this->alpha[$i][3] = $this->beta[$i];

                // perhitungan peramalan untuk periode berikutnya
                $this->forecasting[$i][$j + 1] = ($this->alpha[$i][$j] * $this->actual[$j]) + ((1 - $this->alpha[$i][$j]) * $this->forecasting[$i][$j]);

                // menghitung selisih antara nilai aktual dengan hasil peramalan
                $this->error[$i][$j] = $this->actual[$j] - $this->forecasting[$i][$j];

                // menghitung nilai kesalahan peramalan yang dihaluskan
                $this->smoothedError[$i][$j] = ($this->beta[$i] * $this->error[$i][$j]) + ((1 - $this->beta[$i]) * $this->smoothedError[$i][$j - 1]);

                // menghitung nilai kesalahan absolut peramalan yang dihaluskan
                $this->absoluteSmoothedError[$i][$j] = ($this->beta[$i] * abs($this->error[$i][$j])) + ((1 - $this->beta[$i]) * $this->absoluteSmoothedError[$i][$j - 1]);

                // menghitung nilai alpha untuk periode berikutnya
                $this->alpha[$i][$j + 1] = $this->smoothedError[$i][$j] == 0 ? $this->beta[$i] : abs($this->smoothedError[$i][$j] / $this->absoluteSmoothedError[$i][$j]);

                // menghitung nilai kesalahan persentase peramalan
                $this->percentageError[$i][$j] = $this->actual[$j] == 0 ? 0 : abs((($this->actual[$j] - $this->forecasting[$i][$j]) / $this->actual[$j]) * 100);
            }

            // menghitung rata-rata kesalahan peramalan
            $this->meanAbsolutePercentageError[$i] = array_sum($this->percentageError[$i]) / (count($this->period) - 1);
        }

        // mendapatkan index beta dengan nilai mape terkecil
        $bestBetaIndex = array_search(min($this->meanAbsolutePercentageError), $this->meanAbsolutePercentageError);

        // menyatukan semua hasil perhitungan dan menginputkan hasil peramalan periode berikutnya
        for ($i = 0; $i <= count($this->period); $i++) {
            if ($i < count($this->period)) {
                $this->result[$i] = [
                    "no"                        => $i + 1,
                    "period"                    => $this->period[$i],
                    "actual"                    => $this->actual[$i],
                    "forecasting"               => number_format($this->forecasting[$bestBetaIndex][$i], 2),
                    "error"                     => number_format($this->error[$bestBetaIndex][$i], 2),
                    "smoothed-error"            => number_format($this->smoothedError[$bestBetaIndex][$i], 2),
                    "absolute-smoothed-error"   => number_format($this->absoluteSmoothedError[$bestBetaIndex][$i], 2),
                    "alpha"                     => number_format($this->alpha[$bestBetaIndex][$i], 2),
                    "percentage-error"          => number_format($this->percentageError[$bestBetaIndex][$i], 2),
                ];
            } else {
                $nextPeriod = date("F Y", strtotime("+1 month", strtotime(date($_POST['finalPeriod']))));
                $this->result[$i] = [
                    "no"                        => $i + 1,
                    "period"                    => $nextPeriod,
                    "actual"                    => "",
                    "forecasting"               => number_format($this->forecasting[$bestBetaIndex][$i], 2),
                    "error"                     => "",
                    "smoothed-error"            => "",
                    "absolute-smoothed-error"   => "",
                    "alpha"                     => "",
                    "percentage-error"          => ""
                ];
            }
        }

        $this->result = [
            "forecastingResult" => $this->result,
            "beta" => $this->beta[$bestBetaIndex],
            "mape" => number_format($this->meanAbsolutePercentageError[$bestBetaIndex], 2),
        ];

        return $this->result;
    }

    public function forecastingResult()
    {
        $this->result = $this->forecastingARRES();
        return $this->result;
    }
}


