var chart = AmCharts.makeChart("leadschart", {
    "type": "serial",
    "theme": "light",
    "dataDateFormat": "YYYY-MM-DD",
    "pathToImages": "amcharts/images/",
    "valueAxes": [{
        "id": "v1",
        "axisAlpha": 0,
        "position": "left"
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0
    },
    "export": {
        "enabled": true
    },
    "graphs": [{
        "id": "g1",
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "lineColor": "#06BAF5",
        "bulletSize": 5,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "title": "red line",
        "useLineColorForBulletBorder": true,
        "valueField": "value",
        "balloonText": "<div style='margin:5px; font-size:19px;'><span style='font-size:13px;'>[[category]]</span><br>[[value]]</div>"
    }],
    "chartScrollbar": {
        "graph": "g1",
        "oppositeAxis":false,
        "offset":30,
        "scrollbarHeight": 20,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount":true,
        "gridAlpha": 0.5,
        "color":"#AAAAAA"
    },
    "chartCursor": {
        "pan": true,
        "valueLineEnabled": true,
        "valueLineBalloonEnabled": true,
        "cursorAlpha":0,
        "valueLineAlpha":0.2
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "dataProvider": [{
        "date": "2015-07-01",
        "value": 60
    }, {
        "date": "2015-07-02",
        "value": 67
    }, {
        "date": "2015-07-03",
        "value": 64
    }, {
        "date": "2015-07-04",
        "value": 66
    }, {
        "date": "2015-07-05",
        "value": 60
    }, {
        "date": "2015-07-06",
        "value": 63
    }, {
        "date": "2015-07-07",
        "value": 61
    }, {
        "date": "2015-07-08",
        "value": 60
    }, {
        "date": "2015-07-09",
        "value": 65
    }, {
        "date": "2015-07-10",
        "value": 75
    }, {
        "date": "2015-07-11",
        "value": 77
    }, {
        "date": "2015-07-12",
        "value": 78
    }, {
        "date": "2015-07-13",
        "value": 70
    }, {
        "date": "2015-07-14",
        "value": 70
    }, {
        "date": "2015-07-15",
        "value": 73
    }, {
        "date": "2015-07-16",
        "value": 71
    }, {
        "date": "2015-07-17",
        "value": 74
    }, {
        "date": "2015-07-18",
        "value": 78
    }, {
        "date": "2015-07-19",
        "value": 85
    }, {
        "date": "2015-07-20",
        "value": 82
    }, {
        "date": "2015-07-21",
        "value": 83
    }, {
        "date": "2015-07-22",
        "value": 88
    }, {
        "date": "2015-07-23",
        "value": 85
    }, {
        "date": "2015-07-24",
        "value": 85
    }, {
        "date": "2015-07-25",
        "value": 80
    }, {
        "date": "2015-07-26",
        "value": 87
    }, {
        "date": "2015-07-27",
        "value": 84
    }, {
        "date": "2015-07-28",
        "value": 83
    }, {
        "date": "2015-07-29",
        "value": 84
    }, {
        "date": "2015-07-30",
        "value": 81
    }]
});

chart.addListener("rendered", zoomChart);

zoomChart();

function zoomChart() {
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
}