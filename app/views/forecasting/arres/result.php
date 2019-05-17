<div class="app">
    <div class="container">
        <section class="my-5">
            <div class="card bg-light">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center font-weight-bold mt-2 mb-3">Details Of Forecasting Results</h3>
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr class="head">
                                <th scope="col">t</th>
                                <th scope="col">Period (Month)</th>
                                <th scope="col">Y</th>
                                <th scope="col">F</th>
                                <th scope="col">E</th>
                                <th scope="col">A</th>
                                <th scope="col">M</th>
                                <th scope="col">&alpha;</th>
                                <th scope="col">PE (%)</th>
                            </tr>
                        </thead>
                        <tbody>
<?php $betaAndMape = []; $lastForecasting = '';?>
<?php foreach ($data['result'] as $index => $data): ?>
<?php if ($index == "forecastingResult"): ?>
                        <?php foreach ($data as $result): ?>
    <tr>
                                <th scope="row"><?= $result['no']; ?></th>
                                <td><?= $result['period']; ?></td>
                                <td><?= $result['actual']; ?></td>
                                <td><?= $result['forecasting']; ?></td>
                                <td><?= $result['error']; ?></td>
                                <td><?= $result['smoothed-error']; ?></td>
                                <td><?= $result['absolute-smoothed-error']; ?></td>
                                <td><?= $result['alpha']; ?></td>
                                <td><?= $result['percentage-error']; ?></td>
                            </tr>
                        <?php endforeach ?>
<?php else: ?>
<?php $betaAndMape[] = $data; ?>
<?php endif; ?>
<?php endforeach; ?>
</tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="my-5">
            <div class="row">
                <div class="col-md-3 align-self-center">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title text-center">Best &beta; Index</h5>
                            <h1 class="display-5 text-center font-weight-bold text-dark"><?= $betaAndMape[0]; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 align-self-center">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title text-center">MAPE</h5>
                            <h1 class="display-5 text-center font-weight-bold text-dark"><?= $betaAndMape[1]; ?>%</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 align-self-center">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title text-center">Forecasting Accuracy</h5>
                            <h1 class="display-5 text-center font-weight-bold text-dark"><?= 100 - $betaAndMape[1]; ?>%</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="card bg-primary text-light">
                        <div class="card-body">
                            <h5 class="card-title text-center">Forecasting Results</h5>
                            <h1 id="lastForecasting" class="display-5 text-center font-weight-bold"></h1>
                            <p id="lastPeriod" class="card-text text-center"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-5">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Graph Of Actual Data Pattern</h5>
                            <canvas id="actualDataPattern"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-5">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Graph Of Forecasting Data Pattern</h5>
                            <canvas id="forecastingDataPatternChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h4 class="card-title text-center font-weight-bold mb-sm-3">More Complete Information</h4>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    Index Period <span class="badge badge-dark badge-pill">t</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    Actual Data<span class="badge badge-dark badge-pill">Y</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    Forecasting Results<span class="badge badge-dark badge-pill">F</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    Error<span class="badge badge-dark badge-pill">E</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    Smoothed Error<span class="badge badge-dark badge-pill">A</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    Absolute Smoothed Error<span class="badge badge-dark badge-pill">M</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    Parameter Of Smoothing Alpha<span class="badge badge-dark badge-pill">&alpha;</span>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    Parameter Of Smoothing Beta<span class="badge badge-dark badge-pill">&beta;</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    Percentage Error<span class="badge badge-dark badge-pill">PE</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    Mean Absolute Percentage Error<span class="badge badge-dark badge-pill">MAPE</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-5">
            <div class="row justify-content-center">
                <div class="col-md-3 my-sm-2">
                    <a href=" <?= BASEURL; ?>" class="btn btn-md btn-danger btn-block font-weight-bold">Back To Home</a>
                </div>
                <div class="col-md-3 my-sm-2">
                    <a href=" <?= BASEURL; ?>/forecasting/period" class="btn btn-md btn-primary btn-block font-weight-bold">Do Forecasting Again</a>
                </div>
            </div>
        </section>
    </div>
</div> 