AmCharts.makeChart("pie3",{
	"type": "pie",
	"adjustPrecision": true,
	"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
	"innerRadius": "50%",
	"radius": "30%",
	"labelText": "[[title]]<br>[[value]]",
	"labelRadius": 15,
	"maxLabelWidth": 60,
	"titleField": "category",
	"valueField": "column-1",
	"visibleInLegendField": "column-1",
	"theme": "light",
	"colors": ["#BBCF0F", "#06BAF5", "#D7005B", "#AA53F0", "#f7c809", "#fb698e", "#dc1a4c"],
	"allLabels": [
		{
			"id": "Label-1",
			"text": ""
		}
	],
	"balloon": {
		"adjustBorderColor": false,
		"disableMouseEvents": false
	},
	"legend": false,
	"titles": [],
	"dataProvider": [
		{
			"category": "MOA",
			"column-1": "350"
		},
		{
			"category": "Megamall",
			"column-1": "190"
		},
		{
			"category": "Glorietta",
			"column-1": "560"
		},
		{
			"category": "SM North",
			"column-1": "275"
		},
		{
			"category": "ATC",
			"column-1": "138"
		}
	]
});