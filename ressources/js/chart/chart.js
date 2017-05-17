

var parseTime = d3.timeParse("%Y-%m-%d %H:%M:%S"),
    dateFormatter = d3.timeFormat("%a %d %b"),


    // set the dimensions of the canvas

    margin = {top: 20, right: 20, bottom: 70, left: 40},
    width = 500 - margin.left - margin.right,
    height = 300 - margin.top - margin.bottom,
    titleSize = 40,

    types =
      [
          {
              "name" : "Capteur_d_humidité",
              "yAxisLabel" : "Humidité (%)",
              "chart" : true,
              "title" : "Humidité",
              "description" : "Humidité en %",
              "class" : "humidity"
          },
          {
              "name" : "Capteur_de_température",
              "yAxisLabel" : "Température (°C)",
              "chart" : true,
              "title" : "Température",
              "description" : "Température en °C",
              "class" : "temperature"
          },
          {
              "name" : "Capteur_de_luminosité",
              "yAxisLabel" : "Luminosité (%)",
              "chart" : true,
              "title" : "Luminosité",
              "description" : "Luminosité en %",
              "class" : "luminosity"
          },
          {
              "name" : "Capteur_de_présence",
              "yAxisLabel" : "Capteur de présence",
              "chart" : false,
              "title" : "Détecteur de Présence",
              "description" : "Quand la courbe est bleue, cela signifie qu'une présence a été détéctée sur les lieux",
              "class" : "presence"
          }


          ];


$(document).ready(function(e) {


    var d = document,
        g = d.getElementsByTagName('body')[0],
        x = g.clientWidth,
        y = g.clientHeight;

    width =  x/2 - 2*( margin.left + margin.right);
    height = y/2  - 2*(  margin.top + margin.bottom + titleSize);


    // load the data


    $.post('http://localhost/HK/api/get/sensors/values',
        {
            'fromDate': '2017-05-01 00:00:00',
            'toDate': '2017-05-06 00:00:00',
            'roomId': '1'
        }, (function (response) {

            //data = JSON.parse(data);
            data = response.content;
            var i = 1;

            types.forEach(function(type){
                printDiagramm(data, i, type);
                i++;
            });


        }));
});


function printDiagramm(data, ind, dataSpecs){

    data = data[dataSpecs.name].values;

    // set the ranges
    var x = d3.scaleBand().rangeRound([0, width], .05);

    var y = d3.scaleLinear().range([height, 0]);

    // define the axis
    var xAxis = d3.axisBottom(x);


    var yAxis = d3.axisLeft(y)
        .ticks(10);


    $(".chart-title" + ind).html(dataSpecs.title);
    $(".chart-description" + ind).html(dataSpecs.description);


    // add the SVG element
    var svg = d3.select("graph" + ind).append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

    data.forEach(function (d) {
        // If datas needs to be modified first individually
        // It must be done here
        if(dataSpecs.chart == false){
            if(d.state == false){
                d.value = 0;
            }else{
                d.value = 1;
            }
        }
    });

    // scale the range of the data
    x.domain(data.map(function (d) {
        return d.datetime;
    }));
    y.domain([0, d3.max(data, function (d) {
        return d.value;
    })]);


    // add axis
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis)
        .selectAll("text")
        .style("text-anchor", "end")
        .attr("dx", "-.8em")
        .attr("dy", "-.55em")
        .attr("transform", "rotate(-90)")
        .text(function(d){return dateFormatter(parseTime(d))});

    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis)
        .append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", 5)
        .attr("dy", ".71em")
        .style("text-anchor", "end")
        .text(dataSpecs.yAxisLabel);


    // Add bar chart
    svg.selectAll("bar")
        .data(data)
        .enter().append("rect")
        .attr("class", "bar")
        .attr("x", function (d) {
            return x(d.datetime);
        })
        .attr("width", x.bandwidth())
        .attr("y", function (d) {
            return y(d.value);
        })
        .attr("height", function (d) {
            return height - y(d.value);
        });
}