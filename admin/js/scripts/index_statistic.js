$(document).ready(function () {
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart;
    var chart2;
    var ctx2 = document.getElementById('cityChart2').getContext('2d');

    function fetchCityChartData2() {
        var url = "../admin/ajax/get_city_statistics.php";

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(response) {
                var attNames = response.attNames;
                var visitorCounts = response.visitorCounts;

                var chartData2 = {
                    labels: attNames,
                    datasets: [{
                        label: 'Visitors',
                        data: visitorCounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };

                if (chart2) {
                    chart2.destroy();
                }

                chart2 = new Chart(ctx2, {
                    type: 'bar',
                    data: chartData2,
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
    function fetchChartData(option) {
        var url = "../admin/ajax/get_statistic.php";
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
    fetchCityChartData2();
});
