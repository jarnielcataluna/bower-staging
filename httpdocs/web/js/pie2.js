AmCharts.makeChart("pie2", {
    "type": "pie",
    "theme": "light",
    "dataProvider": [{
        "title": "Agent Jobs",
        "value": 50
    }, {
        "title": "Non-Agent Jobs",
        "value": 125
    }],
    "fontSize": 10,
    "titleField": "title",
    "valueField": "value",
    "maxLabelWidth": 90,
    "labelRadius": 50,
    "legend":{
        "position":"right",
        "autoMargins":false
    },
    "colors": ["#BBCF0F", "#06BAF5", "#D7005B", "#AA53F0", "#ff7900", "#fe4a4b", "#ffcf11" ,"#a993b7" , "#86cbc6", "#ff7ca8", "#e4c785" , "#0071e3"],

    "radius": "42%",
    "innerRadius": "70%",
    "labelText": "",
});