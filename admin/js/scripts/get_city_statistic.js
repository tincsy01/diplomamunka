var chart2;
var ctx2 = document.getElementById('cityChart2').getContext('2d');

function fetchCityChartData2() {
    var url = "/admin/ajax/get_city_statistics.php";

    $.ajax({
        type: "GET",
        url: url,
        success: function(response) {
            var result = JSON.parse(response);

            var attNames = result.attNames;
            var visitorCounts = result.visitorCounts;

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

// Hívd meg a fetchCityChartData2 függvényt a lap betöltésekor
$(document).ready(function () {
    fetchCityChartData2();
});