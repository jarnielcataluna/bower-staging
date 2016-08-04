 var chart = AmCharts.makeChart("trafficSource", {
    "type": "serial",
    "theme": "light",  
    "legend": {
        "useGraphSettings": true,
        "markerSize":12,
        "valueWidth":0,
        "verticalGap":0
    },
    "dataProvider": [{
        "souce": "Search Engines",
        "ranking": 23.5
    }, {
        "souce": "Direct Traffic",
        "ranking": 26.2
    }, {
        "souce": "Refferal Sites",
        "ranking": 30.1
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
    "categoryField": "souce",
    "categoryAxis": {
        "gridPosition": "start"
    }

});