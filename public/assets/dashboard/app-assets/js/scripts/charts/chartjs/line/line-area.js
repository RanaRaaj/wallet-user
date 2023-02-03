/*=========================================================================================
    File Name: line-area.js
    Description: Chartjs line area chart
    ----------------------------------------------------------------------------------------
    Item Name: Chameleon Admin - Modern Bootstrap 4 WebApp & Dashboard HTML Template + UI Kit
    Version: 1.2
    Author: ThemeSelection
    Author URL: https://themeselection.com/
==========================================================================================*/

// Line area chart
// ------------------------------
$(window).on("load", function(){

    //Get the context of the Chart canvas element we want to select
    var ctx = $("#area-chart");

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
            data: [0, 150, 140, 105, 190, 230, 270],
            backgroundColor: "rgba(209,212,219,.4)",
            borderColor: "transparent",
            pointBorderColor: "#D1D4DB",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }, {
            label: "Beneficiary",
            data: [0, 90, 120, 240, 140, 250, 190],
            backgroundColor: "rgba(255,145,73,.7)",
            borderColor: "transparent",
            pointBorderColor: "#5175E0",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        },
         {
            label: "Employee",
            data: [0, 80, 130, 240, 20, 30, 10],
            backgroundColor: "rgba(102,16,242,1)",
            borderColor: "transparent",
            pointBorderColor: "#6610f2",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }, {
            label: "Supplier",
            data: [0, 10, 400, 150, 30, 250, 40],
            backgroundColor: "rgba(30,159,196,1)",
            borderColor: "transparent",
            pointBorderColor: "#1e9fc4",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }, {
            label: "Partner",
            data: [0, 15, 36, 32, 140, 350, 400],
            backgroundColor: "rgba(94,216,79,1)",
            borderColor: "transparent",
            pointBorderColor: "#5ed84f",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }, {
            label: "User",
            data: [0, 50, 180, 290, 350, 450, 20],
            backgroundColor: "rgba(232,62,140,1)",
            borderColor: "transparent",
            pointBorderColor: "#e83e8c",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }]
    };

    var config = {
        type: 'line',

        // Chart Options
        options : chartOptions,

        // Chart Data
        data : chartData
    };

    // Create the chart
    var areaChart = new Chart(ctx, config);

});