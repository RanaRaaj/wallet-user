/*=========================================================================================
    File Name: line.js
    Description: Chartjs simple line chart
    ----------------------------------------------------------------------------------------
    Item Name: Chameleon Admin - Modern Bootstrap 4 WebApp & Dashboard HTML Template + UI Kit
    Version: 1.2
    Author: ThemeSelection
    Author URL: https://themeselection.com/
==========================================================================================*/

// Line chart
// ------------------------------
$(window).on("load", function(){

    //Get the context of the Chart canvas element we want to select
    var ctx = $("#line-chart");

    // Chart Options
    var chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'bottom',
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        },
        title: {
            display: true,
            text: ''
        }
    };

    // Chart Data
    var chartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Customer",
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderDash: [5, 5],
            borderColor: "#9C27B0",
            pointBorderColor: "#9C27B0",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }, {
            label: "Beneficiary",
            data: [28, 48, 40, 19, 86, 27, 90],
            fill: false,
            borderDash: [5, 5],
            borderColor: "#5175E0",
            pointBorderColor: "#5175E0",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }, {
            label: "Employee",
            data: [45, 25, 16, 36, 67, 18, 76],
            lineTension: 0,
            fill: false,
            borderColor: "#6610f2",
            pointBorderColor: "#6610f2",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        },
        {
            label: "Supplier",
            data: [45, 85, 36, 65, 48, 96, 15],
            lineTension: 0,
            fill: false,
            borderColor: "#1e9fc4",
            pointBorderColor: "#1e9fc4",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        },{
            label: "Partner",
            data: [12, 85, 96, 45, 75, 85, 100],
            lineTension: 0,
            fill: false,
            borderColor: "#5ed84f",
            pointBorderColor: "#5ed84f",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        },{
            label: "User",
            data: [43, 58, 85, 35, 75, 10, 25],
            lineTension: 0,
            fill: false,
            borderColor: "#e83e8c",
            pointBorderColor: "#e83e8c",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }
        ]
       
    };

    var config = {
        type: 'line',

        // Chart Options
        options : chartOptions,

        data : chartData
    };

    // Create the chart
    var lineChart = new Chart(ctx, config);
});