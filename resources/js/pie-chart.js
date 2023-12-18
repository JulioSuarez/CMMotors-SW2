var artefactos = document.querySelectorAll('input[name="Venta_Tienda"]');
var Venta_Tienda = JSON.parse(artefactos[0].value);
const tienda1 = Venta_Tienda[0]['tienda'];
const tienda2 = Venta_Tienda[1]['tienda'];
const tienda3 = Venta_Tienda[2]['tienda'];
// console.log(tienda1, tienda2, tienda3);
const total = Venta_Tienda[0]['total_ventas'] + Venta_Tienda[1]['total_ventas'] + Venta_Tienda[2]['total_ventas'];
const porcentaje1 = (Venta_Tienda[0]['total_ventas'] / total) * 100;
const porcentaje2 = (Venta_Tienda[1]['total_ventas'] / total) * 100;
const porcentaje3 = (Venta_Tienda[2]['total_ventas'] / total) * 100;
// console.log(porcentaje1.toFixed(2), porcentaje2.toFixed(2), porcentaje3.toFixed(2));
// ApexCharts options and config
window.addEventListener("load", function () {
    const getChartOptions = () => {
        return {
            series: [porcentaje1, porcentaje2, porcentaje3],
            colors: ["#1C64F2", "#16BDCA", "#9061F9"],
            chart: {
                height: 420,
                width: "100%",
                type: "pie",
            },
            stroke: {
                colors: ["white"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    labels: {
                        show: true,
                    },
                    size: "100%",
                    dataLabels: {
                        offset: -25
                    }
                },
            },
            labels: [tienda1, tienda2, tienda3],
            dataLabels: {
                enabled: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                },
            },
            legend: {
                position: "bottom",
                fontFamily: "Inter, sans-serif",
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value + "%"
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function (value) {
                        return value + "%"
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
        }
    }

    if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
        chart.render();
    }
});
