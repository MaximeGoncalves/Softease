(function ($) {
    $('.field-input').focus(function () {
        $(this).parent().addClass('is-focus has-label');
    })
    $('.field-input').blur(function () {
        if($(this).val() == ''){
            $(this).parent().removeClass('has-label');
        }
        $(this).parent().removeClass('is-focus');
    })
    $('.field-input').each(function () {
        if ($(this).val() != '') {
            $(this).parent().addClass('has-label');
        }
    })
    $('#trumbowyg').trumbowyg({
        btns: ['strong', 'em', '|', 'underline', 'viewHTML','removeformat'],
        autogrow: true,
        lang: 'fr',
        semantic: false
    });
    // Customers
    $.ajax({
        url: "admin/customers",
        method: 'GET',
        success: function (data) {

            var tab = Object.keys(data).map(function (k) {
                return data[k];
            })
            var pie = document.getElementById('customers');
            var pieChart = new Chart(pie, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(data),
                    datasets: [
                        {
                            data: tab,
                            backgroundColor: ['rgba(231,76,60,0.8)', 'rgba(231,76,40,0.8)'],
                            hoverBackgroundColor: ['#ccc', '#333'],
                        }
                    ]
                }
            })
        },
        error: function (data) {
            console.log('erreur ! (softease.js)')
        }
    });
//Technician
    $.ajax({
        url: "admin/technicians",
        method: 'GET',
        success: function (data) {
            console.log(data)
            var tab = Object.keys(data).map(function (k) {
                return data[k];
            })
            var pie = document.getElementById('technicians');
            var pieChart = new Chart(pie, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(data),
                    datasets: [
                        {
                            data: tab,
                            backgroundColor: ['rgba(231,76,60,0.8)', 'rgba(231,76,40,0.8)'],
                            hoverBackgroundColor: ['#ccc', '#333'],
                        }
                    ]
                }
            })
        },
        error: function (data) {
            console.log('erreur ! (softease.js)')
        }
    });


    $.ajax({
        url: "admin/chart",
        method: 'GET',
        success: function (data) {
            var month = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'septembre', 'Octobre', 'Novembre', 'Décembre']
            var ctx = $("#line")
            var chartdata = {
                labels: month,
                datasets: [
                    {
                        label: 'Ticket',
                        borderColor: "rgba(231,76,60,0.8)",
                        pointBorderColor: "rgba(231,76,60,0.8)",
                        pointBackgroundColor: "rgba(231,76,60,0.8)",
                        pointHoverBackgroundColor: "rgba(231,76,60,0.8)",
                        pointHoverBorderColor: "rgba(231,76,60,0.8)",
                        pointBorderWidth: 2,
                        pointHoverRadius: 5,
                        pointHoverBorderWidth: 1,
                        pointRadius: 3,
                        fill: false,
                        borderWidth: 4,
                        data: [data['01'] == undefined ? "0" : data['01'].length,
                            data['02'] == undefined ? "0" : data['02'].length,
                            data['03'] == undefined ? "0" : data['03'].length,
                            data['04'] == undefined ? "0" : data['04'].length,
                            data['05'] == undefined ? "0" : data['05'].length,
                            data['06'] == undefined ? "0" : data['06'].length,
                            data['07'] == undefined ? "0" : data['07'].length,
                            data['08'] == undefined ? "0" : data['08'].length,
                            data['09'] == undefined ? "0" : data['09'].length,
                            data['10'] == undefined ? "0" : data['10'].length,
                            data['11'] == undefined ? "0" : data['11'].length,
                            data['12'] == undefined ? "0" : data['12'].length]
                    }
                ]
            }
            var lineGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                    borderWidth: 2,
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold",
                                beginAtZero: true,
                                // maxTicksLimit: 6,
                                padding: 20
                            },
                            gridLines: {
                                drawTicks: false,
                                display: false
                            },
                        }],
                        yAxes: [{
                            gridLines: {
                                zeroLineColor: "transparent"

                            },
                            ticks: {
                                padding: 20,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold"
                            },
                            borderWidth: 5,
                            gridLines: {
                                display: false
                            }
                        }]
                    }
                }
            })
        },
        error: function (users) {
            console.log('erreur ! (softease.js)')
        }
    });
})
(jQuery)




