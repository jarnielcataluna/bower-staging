var chart = AmCharts.makeChart("conversion", {
    "type": "serial",
    "theme": "light",
    
    "legend": {
        "equalWidths": false,
        "useGraphSettings": true,
        "valueAlign": "left"
    },

    "dataProvider": [{
        "branch": "Branch1",
        "conversion": 227,
        "cost": 40
    }, {
        "branch": "Branch2",
        "conversion": 371,
        "cost": 48
    }, {
        "branch": "Branch3",
        "conversion": 433,
        "cost": 56
    }, {
        "branch": "Branch4",
        "conversion": 345,
        "cost": 37
    }, {
        "branch": "Branch5",
        "conversion": 480,
        "cost": 50
    }],

    "valueAxes": [{
        "id": "distanceAxis",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left",
        "title": "conversion"
    }, {
        "id": "costAxis",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "right",
        "title": "cost"
    }],

    "graphs": [{
        "alphaField": "alpha",
        "balloonText": "[[value]] Conversions",
        "dashLengthField": "dashLength",
        "fillAlphas": 0.7,
        "legendValueText": "[[value]]",
        "title": "conversion",
        "type": "column",
        "valueField": "conversion",
        "valueAxis": "conversionAxis",
        "autoGridCount": false,
        "gridCount": 5
    }, {
        "bullet": "square",
        "bulletBorderAlpha": 1,
        "bulletBorderThickness": 1,
        "balloonText": "[[value]] Total Cost",
        "legendValueText": "Cost: [[value]]",
        "title": "cost",
        "fillAlphas": 0,
        "valueField": "cost",
        "valueAxis": "costAxis",
        "autoGridCount": false,
        "gridCount": 5
    }],
    
    "categoryField": "branch",
    "categoryAxis": {
        "autoGridCount": false,
        "axisColor": "#555555",
        "gridAlpha": 0.1,
        "gridColor": "#FFFFFF",
        "gridCount": 5,
        "labelRotation": 20
    }
});