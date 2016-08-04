AmCharts.ready(function() {

    // percent chart            
    var chart = new AmCharts.AmSerialChart(AmCharts.themes.none);
    chart.dataProvider = [{
        x: 1,
        y1: 29,
        y2: 71
    }];
    chart.categoryField = "x";
    chart.rotate = true;
    chart.autoMargins = false;
    chart.marginLeft = 0;
    chart.marginRight = 0;
    chart.marginTop = 0;
    chart.marginBottom = 0;

    var graph = new AmCharts.AmGraph();
    graph.valueField = "y1";
    graph.type = "column";
    graph.fillAlphas = 0.6;
    graph.fillColors = "#BBCF0F";
    graph.gradientOrientation = "horizontal";
    graph.lineColor = "#FFFFFF";
    graph.showBalloon = true;
    graph.balloonText = "[[value]]";
    chart.addGraph(graph);

    var graph2 = new AmCharts.AmGraph();
    graph2.valueField = "y2";
    graph2.type = "column";
    graph2.fillAlphas = 0.2;
    graph2.fillColors = "#000000";
    graph2.lineColor = "#FFFFFF";
    graph2.showBalloon = true;
    chart.addGraph(graph2);

    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.gridAlpha = 0;
    valueAxis.axisAlpha = 0;
    valueAxis.stackType = "100%"; // this is set to achieve that column would occupie 100% of the chart area
    chart.addValueAxis(valueAxis);

    var categoryAxis = chart.categoryAxis;
    categoryAxis.gridAlpha = 0;
    categoryAxis.axisAlpha = 0;
    chart.write("bracket1");

    // percent chart            
    var chart = new AmCharts.AmSerialChart(AmCharts.themes.none);
    chart.dataProvider = [{
        x: 1,
        y1: 77,
        y2: 23
    }];
    chart.categoryField = "x";
    chart.rotate = true;
    chart.autoMargins = false;
    chart.marginLeft = 0;
    chart.marginRight = 0;
    chart.marginTop = 0;
    chart.marginBottom = 0;

    var graph = new AmCharts.AmGraph();
    graph.valueField = "y1";
    graph.type = "column";
    graph.fillAlphas = 0.6;
    graph.fillColors = "#BBCF0F";
    graph.gradientOrientation = "horizontal";
    graph.lineColor = "#FFFFFF";
    graph.showBalloon = true;
    graph.balloonText = "[[value]]";
    chart.addGraph(graph);

    var graph2 = new AmCharts.AmGraph();
    graph2.valueField = "y2";
    graph2.type = "column";
    graph2.fillAlphas = 0.2;
    graph2.fillColors = "#000000";
    graph2.lineColor = "#FFFFFF";
    graph2.showBalloon = true;
    chart.addGraph(graph2);

    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.gridAlpha = 0;
    valueAxis.axisAlpha = 0;
    valueAxis.stackType = "100%"; // this is set to achieve that column would occupie 100% of the chart area
    chart.addValueAxis(valueAxis);

    var categoryAxis = chart.categoryAxis;
    categoryAxis.gridAlpha = 0;
    categoryAxis.axisAlpha = 0;
    chart.write("bracket2");

    // percent chart            
    var chart = new AmCharts.AmSerialChart(AmCharts.themes.none);
    chart.dataProvider = [{
        x: 1,
        y1: 53,
        y2: 47
    }];
    chart.categoryField = "x";
    chart.rotate = true;
    chart.autoMargins = false;
    chart.marginLeft = 0;
    chart.marginRight = 0;
    chart.marginTop = 0;
    chart.marginBottom = 0;

    var graph = new AmCharts.AmGraph();
    graph.valueField = "y1";
    graph.type = "column";
    graph.fillAlphas = 0.6;
    graph.fillColors = "#BBCF0F";
    graph.gradientOrientation = "horizontal";
    graph.lineColor = "#FFFFFF";
    graph.showBalloon = true;
    graph.balloonText = "[[value]]";
    chart.addGraph(graph);

    var graph2 = new AmCharts.AmGraph();
    graph2.valueField = "y2";
    graph2.type = "column";
    graph2.fillAlphas = 0.2;
    graph2.fillColors = "#000000";
    graph2.lineColor = "#FFFFFF";
    graph2.showBalloon = true;
    chart.addGraph(graph2);

    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.gridAlpha = 0;
    valueAxis.axisAlpha = 0;
    valueAxis.stackType = "100%"; // this is set to achieve that column would occupie 100% of the chart area
    chart.addValueAxis(valueAxis);

    var categoryAxis = chart.categoryAxis;
    categoryAxis.gridAlpha = 0;
    categoryAxis.axisAlpha = 0;
    chart.write("bracket3");

    // percent chart            
    var chart = new AmCharts.AmSerialChart(AmCharts.themes.none);
    chart.dataProvider = [{
        x: 1,
        y1: 16,
        y2: 84
    }];
    chart.categoryField = "x";
    chart.rotate = true;
    chart.autoMargins = false;
    chart.marginLeft = 0;
    chart.marginRight = 0;
    chart.marginTop = 0;
    chart.marginBottom = 0;

    var graph = new AmCharts.AmGraph();
    graph.valueField = "y1";
    graph.type = "column";
    graph.fillAlphas = 0.6;
    graph.fillColors = "#BBCF0F";
    graph.gradientOrientation = "horizontal";
    graph.lineColor = "#FFFFFF";
    graph.showBalloon = true;
    graph.balloonText = "[[value]]";
    chart.addGraph(graph);

    var graph2 = new AmCharts.AmGraph();
    graph2.valueField = "y2";
    graph2.type = "column";
    graph2.fillAlphas = 0.2;
    graph2.fillColors = "#000000";
    graph2.lineColor = "#FFFFFF";
    graph2.showBalloon = true;
    chart.addGraph(graph2);

    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.gridAlpha = 0;
    valueAxis.axisAlpha = 0;
    valueAxis.stackType = "100%"; // this is set to achieve that column would occupie 100% of the chart area
    chart.addValueAxis(valueAxis);

    var categoryAxis = chart.categoryAxis;
    categoryAxis.gridAlpha = 0;
    categoryAxis.axisAlpha = 0;
    chart.write("bracket4");

});