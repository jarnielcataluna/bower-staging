var chart = AmCharts.makeChart("visitchart", {
  "type": "serial",
  "theme": "light",
  "addClassNames": true,
  "autoMargins": false,
  "marginLeft": 30,
  "marginRight": 8,
  "marginTop": 10,
  "marginBottom": 50,

  "balloon": {
    "adjustBorderColor": false,
    "horizontalPadding": 10,
    "verticalPadding": 8,
    "color": "#ffffff"
  },
  "chartCursor": {
    "categoryBalloonDateFormat": "DD",
    "cursorAlpha": 0.1,
    "cursorColor":"#2198FA",
    "fullWidth":true,
    "valueBalloonsEnabled": false,
    "zoomable": false
  },


  "dataProvider": [{
    "branch": "MOA",
    "income": 23.5,
    "revenue": 5.5,
    "expenses": 21.1
  }, {
    "branch": "Megamall",
    "income": 26.2,
    "revenue": 25.5,
    "expenses": 30.5
  }, {
    "branch": "Glorietta",
    "income": 30.1,
    "revenue": 15.5,
    "expenses": 34.9
  }, {
    "branch": "Robinsons",
    "income": 29.5,
    "revenue": 9.5,
    "expenses": 31.1
  }, {
    "branch": "Trinoma",
    "income": 30.6,
    "revenue": 52.5,
    "expenses": 28.2
  }],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left"
  }],
  "startDuration": 1,
  "graphs": [{
    "alphaField": "alpha",
    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
    "fillAlphas": 1,
    "title": "Income",
    "type": "column",
    "valueField": "income",
    "lineColor":"#77BEDF",
    "fillColors": "#77BEDF",
    "dashLengthField": "dashLengthColumn"
  }, {
    "id": "graph2",
    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
    "bullet": "round",
    "lineThickness": 3,
    "lineColor":"#BBCF0F",
    "bulletSize": 7,
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFFFF",
    "useLineColorForBulletBorder": true,
    "bulletBorderThickness": 3,
    "fillAlphas": 0,
    "lineAlpha": 1,
    "title": "Expenses",
    "valueField": "expenses"
  }, {
    "id": "graph3",
    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
    "bullet": "round",
    "lineThickness": 3,
    "lineColor":"#FBA431",
    "bulletSize": 7,
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFFFF",
    "useLineColorForBulletBorder": true,
    "bulletBorderThickness": 3,
    "fillAlphas": 0,
    "lineAlpha": 1,
    "title": "Others",
    "valueField": "others"
  }, {
    "id": "graph4",
    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
    "fillAlphas": 1,
    "title": "Revenue",
    "type": "column",
    "valueField": "revenue",
    "lineColor":"#D7005B",
    "fillColors": "#D7005B",
    "dashLengthField": "dashLengthColumn"
  }],
  "categoryField": "branch",
  "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "labelRotation": 20,
    "tickLength": 10
  }
});
