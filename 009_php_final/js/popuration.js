const disp = "#disp";
const _blank = null;
const init_w = 100; 
const init_h = 100;
const $time_init = "10";
const $initial_init = "10";
const $growth_rate_init = "0.999";
const $capacity_init = "100";
const $time = $("#time");
const $initial = $("#initial");
const $growth_rate = $("#growth_rate");
const $capacity = $("#capacity");
const malthus = 'マルサスモデル';
const logistic = 'ロジスティック関数';
const fibonacci = 'フィボナッチ数';

function format_json(json){
  const arr_malthus = json[malthus];
  const arr_logistic = json[logistic];
  const arr_fibonacci = json[fibonacci];
  return [[malthus, arr_malthus],[logistic, arr_logistic],[fibonacci, arr_fibonacci]];
}

function drowGraph(json){
  const dataset = format_json(json);
  const time = $time.val();
  const capacity = $capacity.val();

  drawLine(dataset,time,capacity);
}

function drawLine(dataset, xAxisMax, yAxisMax) {
  d3.select("svg").remove();

  var margin = {top: 30, right: 20, bottom: 30, left: 40},
      width = 400 - margin.left - margin.right,
      height = 400 - margin.top - margin.bottom;

  var svg = d3.select(disp).append("svg")
     .attr("width", width + margin.left + margin.right)
     .attr("height", height + margin.top + margin.bottom)
     .append("g")
     .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  var xScale = d3.scale.linear()
      .domain([0,xAxisMax])
      .range([0,width]);

  var yScale = d3.scale.linear()
      .domain([0,yAxisMax])
      .range([height,0]);

  var colorArr = ['#E74C3C','#3498DB','#2ECC71','#9B59B6','#34495e','#449248','#652681'];

  var xAxis = d3.svg.axis()
      .scale(xScale)
      .orient("bottom")
      .tickSize(6, -height)
      .tickFormat(function(d){ return d+"年"; });

  var yAxis = d3.svg.axis()
      .ticks(5)
      .scale(yScale)
      .orient("left")
      .tickSize(6, -width);

  // lineの設定。
  var line = d3.svg.line()
      .x(function(d) { return xScale(d["time"]); })
      .y(function(d) { return yScale(d["rate"]); })
      .interpolate("cardinal");

  if(dataset){
    for(var i = 0; i < dataset.length; i++) {
      var label = dataset[i][0];
      var data = dataset[i][1];
      var color = d3.rgb(colorArr[i]);

      // line表示。 
      svg.append("path")
         .datum(data)
         .attr("class", "line")
         .attr("stroke", function(d){ return color; })
         .attr("stroke-width", "2px")
         .attr("fill", "none")
         .attr("d", line)
         .append("text")
         .attr("y", -10)
         .attr("x",10)
         .style("text-anchor", "end")
         .text(label);
    }
  }

  svg.append("g")
     .attr("class", "y axis")
     .call(yAxis)
     .append("text")
     .attr("y", -10)
     .attr("x",10)
     .style("text-anchor", "end")
     .text("人口");

  svg.append("g")
     .attr("class", "x axis")
     .attr("transform", "translate(0," + height + ")")
     .call(xAxis)
     .append("text")
     .attr("y", 0)
     .attr("x",width+20)
     .style("text-anchor", "end")
     .text("時間");   
}

function init(){
  $time.val($time_init);
  $initial.val($initial_init);
  $growth_rate.val($growth_rate_init);
  $capacity.val($capacity_init);
}

function resset(){
  drawLine(_blank,init_w,init_h); 
}

function validate(){ 
  if($time.val()===""
  || $initial.val()===""
  || $growth_rate.val()===""
  || $capacity.val()===""){
    return;
  }
}