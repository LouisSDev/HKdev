

$(document).ready(function(e) {


    var parseTime = d3.timeParse("%y-%m-%d %h:%i:%s");
    var parseDate = d3.timeParse("%y-%m-%d");
    // set the dimensions of the canvas
    var margin = {top: 20, right: 20, bottom: 70, left: 40},
        width = 900 - margin.left - margin.right,
        height = 300 - margin.top - margin.bottom;


    // set the ranges
    var x = d3.scaleBand().rangeRound([0, width], .05);

    var y = d3.scaleLinear().range([height, 0]);

    // define the axis
    var xAxis = d3.axisBottom(x);


    var yAxis = d3.axisLeft(y)
        .ticks(10);


    // add the SVG element
    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");


// load the data


    $.post('http://localhost/HK/api/get/sensors/values',
        {
            'fromDate': '2017-05-01 00:00:00',
            'toDate': '2017-05-06 00:00:00',
            'roomId': '1'
        }, (function (response) {

            //data = JSON.parse(data);
            data = response.content.Capteur_d_humidité.values;


            data.forEach(function (d) {
                // If datas needs to be modified first individually
                // It must be done here
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
                .attr("transform", "rotate(-90)");

            svg.append("g")
                .attr("class", "y axis")
                .call(yAxis)
                .append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 5)
                .attr("dy", ".71em")
                .style("text-anchor", "end")
                .text("Frequency");


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


        }));
});
