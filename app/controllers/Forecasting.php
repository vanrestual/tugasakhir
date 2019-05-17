<?php 

class Forecasting extends Controller
{
    public function index()
    {
        $data['title'] = 'Forecasting';
        $this->view('templates/header', $data);
        $this->view('forecasting/index');
        $this->view('templates/footer');
    }

    public function period()
    {
        $data['title'] = 'Forecasting Period';
        $this->view('templates/header', $data);
        $this->view('forecasting/arres/period', $data);
        $this->view('templates/footer');
    }

    public function actual()
    {
        if (isset($_POST['button-period'])) {
            $data['initialPeriod'] = $_POST['initial-period'];
            $data['finalPeriod'] = $_POST['final-period'];
            $data['title'] = 'Actual Data';
            $data['period'] = $this->model('Forecasting_model')->period($data['initialPeriod'], $data['finalPeriod']);
            $data['index'] = $this->indexPeriod($data['period']);
            $data['indexPeriod'] = array_combine($data['index'], $data['period']);
            if ($_POST['initial-period'] > $_POST['final-period'] || !isset($data['period'][4])) {
                header("Location:" . BASEURL . "/forecasting/period");
                exit;
            }
            $this->view('templates/header', $data);
            $this->view('forecasting/arres/actual', $data);
            $this->view('templates/footer');
        } elseif (!isset($_POST['button-period'])) {
            header("Location:" . BASEURL . "/forecasting/period");
        }
    }

    public function result()
    {
        if (isset($_POST['button-actual'])) {
            $data['title'] = 'Result';
            $data['result'] = $this->model('Forecasting_model')->forecastingResult();
            $this->view('templates/header', $data);
            $this->view('forecasting/arres/result', $data);
            $this->view('templates/forecasting/footer', $data);
        } elseif (!isset($_POST['button-actual'])) {
            header("Location:" . BASEURL);
        }
    }

    public function indexPeriod($indexPeriod = [])
    {
        $i = 0;
        foreach ($indexPeriod as $index) {
            $index = date('Y-m', strtotime($index));
            $index = "actual-data-" . $index;
            $indexPeriod[] = $index;
            unset($indexPeriod[$i]);
            $i++;
        }
        $indexPeriod = array_values($indexPeriod);
        return $indexPeriod;
    }
}
