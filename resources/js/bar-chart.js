var artefactos = document.querySelectorAll('input[name="balanceMensual"]');
var balanceMensual = JSON.parse(artefactos[0].value);

// console.log(balanceMensual);

var sumatoria_ingresos = [];
var sumatoria_costo = [];
var meses = [];

balanceMensual.forEach(element => {
    sumatoria_ingresos.push(element['sumatoria_ingresos']);
    sumatoria_costo.push(element['sumatoria_costo']);
    meses.push(element['mes']);
});

// ApexCharts options and config
window.addEventListener("load", function() {
    var options = {
        series: [{
                name: "Income",
                color: "#31C48D",
                data: sumatoria_ingresos,
            },
            {
                name: "Expense",
                data: sumatoria_costo,
                color: "#F05252",
            }
        ],
        chart: {
            sparkline: {
                enabled: false,
            },
            type: "bar",
            width: "100%",
            height: 400,
            toolbar: {
                show: false,
            }
        },
        fill: {
            opacity: 1,
        },
        plotOptions: {
            bar: {
                horizontal: true,
                columnWidth: "100%",
                borderRadiusApplication: "end",
                borderRadius: 6,
                dataLabels: {
                    position: "top",
                },
            },
        },
        legend: {
            show: true,
            position: "bottom",
        },
        dataLabels: {
            enabled: false,
        },
        tooltip: {
            shared: true,
            intersect: false,
            formatter: function(value) {
                return "$" + value
            }
        },
        xaxis: {
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                },
                formatter: function(value) {
                    return "$" + value
                }
            },
            categories: meses,
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
        yaxis: {
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
            }
        },
        grid: {
            show: true,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: -20
            },
        },
        fill: {
            opacity: 1,
        }
    }

    if (document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("bar-chart"), options);
        chart.render();
    }
});
