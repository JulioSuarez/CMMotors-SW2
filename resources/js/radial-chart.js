var ventas = document.querySelectorAll('input[name="ventas"]');
var venta = JSON.parse(ventas[0].value);

var porcentajeCompletado = (venta / 200) * 100;



var cotizaciones = document.querySelectorAll('input[name="cotizaciones"]');
var cotizacion = JSON.parse(cotizaciones[0].value);
// console.log(venta);

var fechaActual = new Date();
var diaActual = fechaActual.getDate();
var fechaActual = new Date();
var ultimoDiaDelMes = new Date(fechaActual.getFullYear(), fechaActual.getMonth() + 1, 0);
var diasRestantes = ultimoDiaDelMes.getDate() - diaActual;
// console.log(diasRestantes);


var totalDiasEnMes = ultimoDiaDelMes.getDate();

// Calcular el progreso en porcentaje
var progresoPorcentaje = (diaActual / totalDiasEnMes) * 100;

// console.log("Progreso del tiempo transcurrido en el mes:", progresoPorcentaje.toFixed(2) + "%");

var nombresMeses = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
];

// Obtener el nombre del mes actual
var nombreMesActual = nombresMeses[fechaActual.getMonth()];

// ApexCharts options and config
window.addEventListener("load", function () {
    const getChartOptions = () => {
        return {
            series: [ progresoPorcentaje.toFixed(2), porcentajeCompletado.toFixed(2)],
            colors: ["#1C64F2", "#16BDCA", "#FDBA8C"],
            chart: {
                height: "380px",
                width: "100%",
                type: "radialBar",
                sparkline: {
                    enabled: true,
                },
            },
            plotOptions: {
                radialBar: {
                    track: {
                        background: '#E5E7EB',
                    },
                    dataLabels: {
                        show: false,
                    },
                    hollow: {
                        margin: 0,
                        size: "32%",
                    }
                },
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: -23,
                    bottom: -20,
                },
            },
            labels: [nombreMesActual + " Tiempo transcurrido", "Ventas" ],
            legend: {
                show: true,
                position: "bottom",
                fontFamily: "Inter, sans-serif",
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
                labels: {
                    formatter: function (value) {
                        return value + '%';
                    }
                }
            }
        }
    }

    if (document.getElementById("radial-chart") && typeof ApexCharts !== 'undefined') {
        var chart = new ApexCharts(document.querySelector("#radial-chart"), getChartOptions());
        chart.render();
    }
});
