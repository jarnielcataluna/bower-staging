var chart = AmCharts.makeChart("multipie", {
  "type": "pie",
  "startDuration": 0,
   "theme": "light",
  "addClassNames": true,

  "legend":{
   	"position":"right",
    "autoMargins":false
  },
  "colors": ["#BBCF0F", "#06BAF5", "#D7005B", "#AA53F0", "#ff7900", "#fe4a4b", "#ffcf11" ,"#a993b7" , "#86cbc6", "#ff7ca8", "#e4c785" , "#0071e3"],

  "radius": "42%",
  "innerRadius": "70%",
  "labelText": "",
  "labelRadius": 100,

  "dataProvider": [{
    "country": "Hanston, Ortigas",
    "litres": 501.9
  }, {
    "country": "Silver City, Pasig",
    "litres": 301.9
  }, {
    "country": "Sm Lanang, Davao",
    "litres": 201.1
  }, {
    "country": "SM City Bf Paranaque",
    "litres": 165.8
  }],
  "valueField": "litres",
  "titleField": "country"
});
