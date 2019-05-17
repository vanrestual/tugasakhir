<script src="<?= BASEURL; ?>/js/jquery.js"></script>
<script src="<?= BASEURL; ?>/js/popper.js"></script>
<script src="<?= BASEURL; ?>/js/bootstrap.js"></script>
<script src="<?= BASEURL; ?>/js/chart.js"></script>
<script src="<?= BASEURL; ?>/js/main.js"></script>
<?php 
$actualDataPattern = [];
$forecastingDataPattern = [];
$periodLabel = [];
foreach ($data['result'] as $index => $results) {
    if ($index == "forecastingResult") {
        foreach ($results as $result) {
            $actualDataPattern[] = $result['actual'];
            $forecastingDataPattern[] = $result['forecasting'];
            $periodLabel[] = $result['period'];
        }
    }
}
?>
<script>
    var ctx = document.getElementById('actualDataPattern').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [<?php for ($i = 0; $i < count($periodLabel) - 1; $i++) { ?><?php  $periodLabel[$i] = date('M-Y', strtotime($periodLabel[$i])); ?><?php if($i < count($periodLabel) - 2): ?><?= '"' . $periodLabel[$i] . '", '; ?><?php else: ?><?= '"' . $periodLabel[$i] . '"'; ?><?php endif; ?><?php } ?>],
            datasets: [{
                label: "Actual",
                borderColor: 'rgb(40, 167, 69)',
                data: [<?php for ($i = 0; $i < count($actualDataPattern) - 1; $i++) { ?><?php if($i < count($actualDataPattern) - 2): ?><?= '"' . $actualDataPattern[$i] . '", '; ?><?php else: ?><?= '"' . $actualDataPattern[$i] . '"'; ?><?php endif; ?><?php } ?>],
            }]
        },

        // Configuration options go here
        options: {}
    });

    var cty = document.getElementById('forecastingDataPatternChart').getContext('2d');
    var chart = new Chart(cty, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [<?php for ($i = 0; $i < count($periodLabel); $i++) { ?><?php  $periodLabel[$i] = date('M-Y', strtotime($periodLabel[$i])); ?><?php if($i < count($periodLabel) - 1): ?><?= '"' . $periodLabel[$i] . '", '; ?><?php else: ?><?= '"' . $periodLabel[$i] . '"'; ?><?php endif; ?><?php } ?>],
            datasets: [{
                    label: "Actual",
                    borderColor: 'rgb(40, 167, 69)',
                    data: [<?php for ($i = 0; $i < count($actualDataPattern) - 1; $i++) { ?><?php if($i < count($actualDataPattern) - 2): ?><?= '"' . $actualDataPattern[$i] . '", '; ?><?php else: ?><?= '"' . $actualDataPattern[$i] . '"'; ?><?php endif; ?><?php } ?>],
                },
                {
                    label: "Forecasting",
                    borderColor: 'rgb(0, 123, 255)',
                    data: [<?php for ($i = 0; $i < count($forecastingDataPattern); $i++) { ?><?php $forecastingDataPattern[$i] = explode(',', $forecastingDataPattern[$i]); $forecastingDataPattern[$i] = implode('', $forecastingDataPattern[$i]);?><?php if($i < count($forecastingDataPattern) - 1): ?><?= '"' . $forecastingDataPattern[$i] . '", '; ?><?php else: ?><?= '"' . $forecastingDataPattern[$i] . '"'; ?><?php endif; ?><?php }; ?>],
                }
            ]
        },

        // Configuration options go here
        options: {}
    });
</script>
</body>

</html> 