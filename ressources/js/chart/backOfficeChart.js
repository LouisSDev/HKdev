/**
 * Created by home on 29/05/2017.
 */

$('document').ready(function () {
    /**
     *
      * @type {jQuery}
     */
    margin = {top: 40, right: 20, bottom: -50, left: 200},
        width = 600 - margin.left - margin.right,
        height = 800 - margin.top - margin.bottom,
        titleSize = 60;
    var dataSensor = $("#sensorStock").attr('value');
    var dataEffector =$("#effectorStock").attr('value');

    var sensorDataset = JSON.parse(dataSensor);

    var effectorDataset =JSON.parse(dataEffector);

    effectorStock(effectorDataset);
    sensorStock(sensorDataset);

});


function effectorStock($dataset) {


    var d = document,
        g = d.getElementsByTagName('body')[0],
        x = g.clientWidth,
        margin = {top: 120, right: 30, bottom: 30, left: 50},
        width = x - margin.right - margin.left -10,
        height = 350 - margin.top - margin.bottom;
    x = d3.scaleBand().rangeRound([0, width], .1);
    y = d3.scaleLinear().range([height, 0]);


    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
    svg.selectAll("text")
        .data($dataset)
        .enter()
        .append("text")
        .text("Stock d'éffecteurs")
        .attr("x", 600)
        .attr("y",height/1000-20

        );

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
        .attr("fill", function(d) {
            return colorSet(d);
        });

}


function sensorStock($dataset) {



    var d = document,
        g = d.getElementsByTagName('body')[0],
        x = g.clientWidth,
        margin = {top: 120, right: 30, bottom: 30, left: 50},
        width = x - margin.right - margin.left -10,
        height = 350 - margin.top - margin.bottom;
    x = d3.scaleBand().rangeRound([0, width], .1);
    y = d3.scaleLinear().range([height, 0]);

    var x = d3.scaleBand().rangeRound([0, width], .08);

    var y = d3.scaleLinear().range([height, 0]);


    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
       ;
    svg.selectAll("text")
        .data($dataset)
        .enter()
        .append("text")
        .text("Stock de capteurs")
        .attr("x", 600)
        .attr("y",height/1000

         );

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
        .style("text-anchor", "end");



    svg.selectAll(".bar")
        .data($dataset)
        .enter().append("rect")
        .attr("class", "bar")
        .attr("x", function(d) { return x(d.name); })
        .attr("y", function(d) { return  y(parseInt(d.value)); })
        .attr("height", function(d) { return height - y(parseInt(d.value)); })
        .attr("width", x.bandwidth())
        .attr("fill", function(d) {
           return colorSet(d);
        });


}

function colorSet(d, maxVal){
    if (d.value > 350 ){
        return "rgb("+10+","+(d.value/7)+","+0+")";

    }
    if(d.value > 150 && d.value <= 350) {
        return "rgb("+(d.value-100)+","+(d.value-100)+","+6+")";

    }
    if (d.value > 100 && d.value <= 150){
        return "rgb("+(d.value*10)+","+(d.value)+","+10+")";
    }
    else {
        return "rgb("+(d.value*20)+","+20+","+0+")";

    }
}