/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

    'use strict';

    $('#calendar').datepicker({language: 'pt-BR', todayHighlight:'TRUE',});
    var loading = `<div style="top: 40%;text-align: center;position: relative;font-size: 22px;">
                        <i class="fa fa-spin fa-spinner"></i> Aguarde
                    </div>`;
    var errorTemplate = `<div style="top: 40%;text-align: center;position: relative;font-size: 22px;">
                        <i class="fa fa-warning"></i> Erro ao exibir Gráfico
                    </div>`;
    $.ajax({
        url: 'site/charts',
        type: 'GET',
        data: {id:10},
        beforeSend: function(){
            $('#tarefas-chart').html('').html(loading);
            $('#tipos-chart').html('').html(loading);
        },
        success: function(result, status) {
            var dados = JSON.parse(result);
            Highcharts.chart('tarefas-chart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Tarefas últimos 06 meses'
                },
                xAxis: {
                    categories: ['202003','202004', '202005', '202006', '202007', '202008']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Quantidade'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                        }
                    }
                },
                legend: {
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 25,
                    floating: true,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                        }
                    }
                },
                series: [{
                    name: 'Nova',
                    data: [5, 3, 4, 7, 2, 5],
                    color: '#00a65a'
                }, {
                    name: 'Alteração',
                    data: [2, 2, 3, 2, 1, 4],
                    color: '#f39c12'
                }, {
                    name: 'Correção',
                    data: [3, 4, 4, 2, 5, 6],
                    color: '#dd4b39'
                }]
            });
            Highcharts.chart('tipos-chart', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'Tipos de Tarefas'
                },
                tooltip: {
                    pointFormat: 'Quantidade: {point.y} <br>{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        // allowPointSelect: true,
                        // cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true,
                        colors: ['#00a65a', '#f39c12','#dd4b39'],
                    }
                },
                series: [{
                    name: 'Percentual',
                    colorByPoint: true,
                    data: //dados.tipos
                        [{
                        name: 'Nova',
                        y: 654,
                            color: '#00a65a'
                    }, {
                        name: 'Alteração',
                        y: 248,
                            color: '#f39c12'
                    }, {
                        name: 'Correção',
                        y: 158,
                            color: '#dd4b39'
                    }]
                }]
            });
        },
        complete: (result, status) => {},
        error: function(result, status, error){
            $('#tarefas-chart').html('').html(errorTemplate);
            $('#tipos-chart').html('').html(errorTemplate);
        }
    });
});
