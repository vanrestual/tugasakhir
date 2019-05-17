<div id="app">
    <div class="arrevan-form">
        <div class="wrapper">
            <form class="form-arrevan" method="POST" action="<?= BASEURL; ?>/forecasting/actual">
                <div class="boxes bg-light rounded">
                    <h4 class="mb-4 text-center font-weight-bold">
                        Select <?= $data['title']; ?>
                    </h4>
                    <div class="form-group">
                        <label for="initial-period" class="mb-0">Initial period</label>
                        <input type="month" name="initial-period" id="initial-period" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="final-period" class="mb-0">Final Period</label>
                        <input type="month" name="final-period" id="final-period" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <a href=" <?= BASEURL; ?>/forecasting" class="btn btn-md btn-danger btn-block font-weight-bold">Previous</a>
                        </div>
                        <div class="col-md-6 mt-2">
                            <button class="btn btn-md btn-success btn-block font-weight-bold" name="button-period" type="submit">Next</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 