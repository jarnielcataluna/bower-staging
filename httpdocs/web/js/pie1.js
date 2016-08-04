AmCharts.makeChart("pie1", {
    "type": "pie",
    "theme": "light",
    "dataProvider": [{
        "title": "Google",
        "value": 50
    }, {
        "title": "Direct Traff",
        "value": 125
    }, {
        "title": "Yahoo",
        "value": 65
    }, {
        "title": "Bing",
        "value": 37
    }, {
        "title": "item1",
        "value": 20
    }, {
        "title": "item2",
        "value": 15
    }, {
        "title": "item3",
        "value": 45
    }, {
        "title": "item4",
        "value": 65
    }],
    "colors": ["#BBCF0F", "#06BAF5", "#D7005B", "#AA53F0", "#ff7900", "#fe4a4b", "#ffcf11" ,"#a993b7" , "#86cbc6", "#ff7ca8", "#e4c785" , "#0071e3"],
    "fontSize": 10,
    "titleField": "title",
    "valueField": "value",
    "maxLabelWidth": 90,
    "labelRadius": 50,
    "radius": "42%",
    "innerRadius": "90%",
    "labelText": "",
    "legend": {
        "position": "absolute",
        "maxColumns": 1,
        "top": 60,
        "align": "center"
    }
});