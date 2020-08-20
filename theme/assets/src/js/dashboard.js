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
                    text: 'Tarefas últimos 12 meses'
                },
                subtitle: {
                    text: ''
                },
                credits: {
                    enabled: false
                },
                xAxis: {
                    categories: dados.tarefas.categories,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Quantidade'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Adesões',
                    data: dados.tarefas.data
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
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Percentual',
                    colorByPoint: true,
                    data: dados.tipos
                        /*[{
                        name: 'Usuário de Concessionária',
                        y: 654,
                    }, {
                        name: 'Usuário Avulso',
                        y: 248
                    }]*/
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
