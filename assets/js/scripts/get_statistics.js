$(document).ready(function () {
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart;
    function fetchChartData(option) {
        var url = "../assets/ajax/get_data_statistics.php";
        var data = { option: option };

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(response) {
                var result = JSON.parse(response);

                var chartData = {
                    labels: result.labels,
                    datasets: [{
                        label: 'Visitors',
                        data: result.data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                };
                if (chart) {
                    chart.destroy();
                }
                chart = new Chart(ctx, {
                    type: 'bar',
                    data: chartData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(error) {
                console.log("Hiba adatainak lekérésekor: " + error);
            }
        });
    }
    document.getElementById('chartType').addEventListener('change', function () {
        var selectedOption = this.value;
        fetchChartData(selectedOption);
    });
    fetchChartData('days');
});
