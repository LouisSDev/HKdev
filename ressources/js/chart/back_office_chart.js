/**
 * Created by home on 29/05/2017.
 */

$('document').ready(function () {
    /**
     *
      * @type {jQuery}
     */
    margin = {top: 40, right: 20, bottom: -50, left: 200},
        width = 600 - margin.left - margin.right;
        height = 800 - margin.top - margin.bottom;
        titleSize = 60;
    var dataSensor = $("#sensorStock").attr('value');
    var dataEffector =$("#effectorStock").attr('value');

    var sensorDataset = JSON.parse(dataSensor);

    var effectorDataset =JSON.parse(dataEffector);

    EffectorStock(effectorDataset);
    sensorStock(sensorDataset);

    //displayDiagramm(dataset);



   // var dataset = jsonValueToArray(dataJson);
    //console.log(jsonValueToArray(dataJson));

   // console.log(data);//[10,2,5,6,4,8,15,4,84,8,5,5,5];
   // console.log(dataset);
    //console.log(data);
   // console.log(dataJson);
    //console.log('bonjour');

    //back-office dashboard
 /*   var w = 500;
    var h = 300;
    barPadding  = 1;
    var svg = d3.select("body").append("svg")
        .attr("width", w )
        .attr("height", h)
        .append("g")

    // adding bar chart

    var bars = svg.selectAll("rect")
        .data(dataset)
        .enter()
        .append("rect");

    bars.attr("x", function(d) {
        return d.name;
    })
        .attr("y", function(d){
            return h - parseInt(d.value);
        })
        .attr("width",w/50 -barPadding)
        .attr("height", function(d){
            return parseInt(d.value*4) ;
        })
        .attr("fill", function(d){
                if(parseInt(d.value)<15){

                    return "rgb("+parseInt(d.value)+",255,0)";

                }
                else{
                    return "rgb(0,"+parseInt(d.value)+",0)";

                }
            }
        );
//
    /*svg.selectAll("text")
        .data(dataset)
        .enter()
        .append("text")
        .text(function(d){
            return parseInt(d.value);
        })

        .attr("y",function(d){
            return h - (parseInt(d.value*4))+15 ;
        });

    var dmax = d3.max([dataset,function(d){
        return parseInt(d.value);
    }]);

    var yScale = d3.scale.linear()
        .domain(0,dmax)
        .range([0,h]);


    var xScale =  x.domain(dataset.map(function (d) {
        return d.name;
    }));
    var xAxis = d3.svg.axis()
                    .scale(xScale)
                    .orient("bottom");

svg.append("g")
        .call(xAxis)

*/


})


function EffectorStock($dataset) {


    var margin = {top: 120, right: 30, bottom: 30, left: 380},
        width = 900 - margin.left - margin.right,
        height = 300 - margin.top - margin.bottom;

    var x = d3.scaleBand().rangeRound([0, width], .1);

    var y = d3.scaleLinear().range([height, 0]);


    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var xAxis = d3.axisBottom()
        .scale(x);

    var yAxis = d3.axisLeft()
        .scale(y)
        .ticks(10);
    x.domain($dataset.map(function(d) { return d.name; }));
        y.domain([0, d3.max($dataset, function(d) { return parseInt(d.value); })]);

        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);


    svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 5)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("Stocks");


    svg.selectAll(".bar")
            .data($dataset)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", function(d) { return x(d.name); })
            .attr("y", function(d) { return y(parseInt(d.value)); })
            .attr("height", function(d) { return height - y(parseInt(d.value)); })
            .attr("width", x.bandwidth())

}


function sensorStock($dataset) {



    var margin = {top: 150, right: 30, bottom: 30, left: 380},
        width = 900 - margin.left - margin.right,
        height = 300 - margin.top - margin.bottom;

    var x = d3.scaleBand().rangeRound([0, width], .08);

    var y = d3.scaleLinear().range([height, 0]);


    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");




    var xAxis = d3.axisBottom()
        .scale(x);

    var yAxis = d3.axisLeft()
        .scale(y)
        .ticks(10);
    x.domain($dataset.map(function(d) { return d.name; }));
    y.domain([0, d3.max($dataset, function(d) { return parseInt(d.value); })]);

    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);


    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis)
        .append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", 5)
        .attr("dy", ".72em")
        .style("text-anchor", "end")
        .text("Stocks");


    svg.selectAll(".bar")
        .data($dataset)
        .enter().append("rect")
        .attr("class", "bar")
       // .attr("transform", "translate(0," + height + ")")
        .attr("x", function(d) { return x(d.name); })
        .attr("y", function(d) { return  y(parseInt(d.value)); })
        .attr("height", function(d) { return height - y(parseInt(d.value)); })
        .attr("width", x.bandwidth())
}