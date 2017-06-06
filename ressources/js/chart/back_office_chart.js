/**
 * Created by home on 29/05/2017.
 */

$('document').ready(function () {
    /**
     *
      * @type {jQuery}
     */

    var margin = {top: 80, right: 20, bottom: 10, left: 40};
        var width = 600 - (margin.left +margin.right);
        var height = 300 - (margin.top + margin.bottom);
    console.log(margin.top);
    var data = $("#sensorStock").attr('value');


    var dataJson = JSON.parse(data);
    var dataset = jsonValueToArray(dataJson);
    console.log(jsonValueToArray(dataJson));

    console.log(data);//[10,2,5,6,4,8,15,4,84,8,5,5,5];
   // console.log(dataset);
    //console.log(data);
   // console.log(dataJson);
    //console.log('bonjour');

    //back-office dashboard
    var w = 500;
    var h = 300;
    barPadding  = 1;
    var svg = d3.select("body").append("svg")
        .attr("width", w )
        .attr("height", h)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

    var bars = svg.selectAll("rect")
        .data(dataset)
        .enter()
        .append("rect");

    bars.attr("x", function(d) {
        return d.name;
    })
        .attr("y", function(d){
            return h - d.value;
        })
        .attr("width",w/50 -barPadding)
        .attr("height", function(d){
            return d.value*4 ;
        })
        .attr("fill",function(d){
                if(d.value<15){

                    return "rgb("+(d.value)+",255,0)";

                }
                else{
                    return "rgb(0,"+(d.value)+",0)";

                }
            }
        );

    svg.selectAll("text")
        .data(dataset)
        .enter()
        .append("text")
        .text(function(d){
            return d.value;
        })
        .attr("x",function(d,i){
            return i*(w/50)+4 ;
        })
        .attr("y",function(d){
            return h - (d.value*4)+15 ;
        });
    var dmax = d3.max([dataset,function(d){
        return d.value;
    }]);
    var yScale = d3.scale.linear()
        .domain(0,dmax)
        .range([0,h]);


    var xScale = d3.scale.linear()
        .domain([0,dataset.length])
        .range([0,w]);

    var xAxis = d3.svg.axis()
    .scale(xScale)
    .tickFormat(function(d) { return dataset[d].keywor; })
    .orient("bottom");

svg.append("g")
        .call(xAxis);


    function jsonValueToArray ( jsonData) {
       var jsonDataparseInt = jsonData;
       var array = [];
        for(var i=0;i<jsonData.length;i++){
            parseInt(jsonData[i].value);
            console.log(parseInt(jsonData[i].value));
            console.log((jsonDataparseInt[i].value));
            // array[i]=+ parseInt(jsonData[i].value);
        }
        return jsonData;

    }

})