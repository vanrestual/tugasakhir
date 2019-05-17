<div id="app">
    <div class="arrevan-form">
        <div class="container my-4">
            <form class="form-arrevan" method="POST" action="<?= BASEURL; ?>/forecasting/result">
                <div class="boxes bg-light rounded">
                    <h1 class="h4 mb-4 text-center font-weight-bold">
                        Please Enter The
                        <?= $data['title']; ?>
                    </h1>
                    <input type="hidden" name="initialPeriod" value=" <?= $data['initialPeriod']; ?>">
                    <input type="hidden" name="finalPeriod" value=" <?= $data['finalPeriod']; ?>">
                    <?php foreach ($data['indexPeriod'] as $index => $period) : ?>
                    <div class="form-group">
                        <input type="number" min="0" name="<?= $index; ?>" id="<?= $index; ?>" class="form-control" placeholder="Period of <?= $period; ?>" autocomplete="off" required>
                    </div>
                    <?php endforeach; ?>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <a href="<?= BASEURL; ?>/forecasting/period" class="btn btn-md btn-danger btn-block font-weight-bold">Previous</a>
                        </div>
                        <div class="col-md-6 mt-2">
                            <button class="btn btn-md btn-primary btn-block font-weight-bold" name="button-actual" type="submit">Start Forecasting</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 