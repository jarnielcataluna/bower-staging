 var chart = AmCharts.makeChart("rankingChart", {
    "type": "serial",
    "theme": "light",  
    "legend": {
        "useGraphSettings": true,
        "markerSize":12,
        "valueWidth":0,
        "verticalGap":0
    },
    "dataProvider": [{
        "month": "MAR",
        "ranking": 23.5
    }, {
        "month": "APR",
        "ranking": 26.2
    }, {
        "month": "MAY",
        "ranking": 30.1
    }, {
        "month": "JUN",
        "ranking": 29.5
    }, {
        "month": "JUL",
        "ranking": 24.6
    }],
    "valueAxes": [{
        "minorGridAlpha": 0.08,
        "minorGridEnabled": true,
        "position": "bottom",
        "axisAlpha":0
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b></span>",
        "title": "Ranking",
        "type": "column",
        "fillAlphas": 0.8,
        "valueField": "ranking"
    }],
    "categoryField": "month",
    "categoryAxis": {
        "gridPosition": "start"
    }

});