function loadVis(arrayLev)
{
	var margin = 30,
		outerDiameter = window.innerWidth, //800,
		innerDiameter = window.innerHeight - margin - margin; //(outerDiameter - margin - margin);

	var x = d3.scale.linear()
		.range([0, innerDiameter]);

	var y = d3.scale.linear()
		.range([0, innerDiameter]);

	var color = d3.scale.linear()
		.domain([-1, 5])
		.range(["hsl(152,80%,80%)", "hsl(228,30%,40%)"])
		.interpolate(d3.interpolateHcl);

	var pack = d3.layout.pack()
		.padding(2)
		.size([innerDiameter, innerDiameter])
		.value(function(d) { return d.size; })

	var svg = d3.select("body").append("svg")
		.attr("width", outerDiameter)
		.attr("height", outerDiameter)
		.append("g")
		.attr("transform", "translate(" + margin + "," + margin + ")");

	d3.json("dbFunctionJson.php", function(data) 
	{
					for (var i = 0; i < data.length; i++) 
					{
						data[i].size = 500;
					}
					//console.log(data);	//for testing
				
					newData = {"name":"STARS", "children":[]}		//this will set the root node to be "name":"STARS" 
					//current query pulls: profile_type, school, state, gender, ethnicity, current_level,
					levels = arrayLev;
					//levels = (["state","school", "profile_type", "gender"]);

					// For each data row, loop through the expected levels traversing the output tree
					data.forEach(function(d){
						
						// Keep this as a reference to the current level
						var depthCursor = newData.children;
						
						// Go down one level at a time
						levels.forEach(function( property, depth )
						{
							// Look to see if a branch has already been created
							var index;
							
							depthCursor.forEach(function(child,i)
							{
								if ( d[property] == child.name ) index = i;
							});
							
							// Add a branch if it isn't there
							if ( isNaN(index) ) 
							{
								depthCursor.push({ name : d[property], children : []});
								index = depthCursor.length - 1;
							}
							
							// Now reference the new child array as we go deeper into the tree
							depthCursor = depthCursor[index].children;
							
							// This is a leaf, so add the last element to the specified branch
							if ( depth === levels.length - 1 ) depthCursor.push({ name : d.gpa, size : d.size });
						});
					});
  
		var focus = newData,
			nodes = pack.nodes(newData);

		svg.append("g").selectAll("circle")
			.data(nodes)
			.enter().append("circle")
			.attr("class", function(d) { return d.parent ? d.children ? "node" : "node node--leaf" : "node node--newData"; })
			.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
			.attr("r", function(d) { return d.r; })
			.style("fill", function(d) {return d.children ? color(d.depth) : null; })
			.on("click", function(d) { return zoom(focus == d ? newData : d); });

		svg.append("g").selectAll("text")
			.data(nodes)
			.enter().append("text")
			.attr("class", "label")
			.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
			.attr("text-anchor", "middle")
			.style("opacity", function(d) { return d.parent === newData ? 1 : 0; })
			.style("font-size", "16px") // initial guess
			//.style("font-size", function(d) { return ((2*d.r)/ (margin/5)) + "px";}) 	// /this.getComputedTextLength()*24 +"px";}) //(2 * d.r - 20) / this.getComputedTextLength() * 24 + "px";} )
			.text(function(d) { return d.name; });

		d3.select(window)
			.on("click", function() { zoom(newData); });

		function zoom(d, i) 
		{
			focus = d;

			var k = innerDiameter / d.r / 2;
			x.domain([d.x - d.r, d.x + d.r]);
			y.domain([d.y - d.r, d.y + d.r]);
			d3.event.stopPropagation();

			var transition = d3.selectAll("text,circle").transition()
				.duration(d3.event.altKey ? 7500 : 750)
				.attr("transform", function(d) { return "translate(" + x(d.x) + "," + y(d.y) + ")"; });

			transition.filter("circle")
				.attr("r", function(d) { return k * d.r; });

			transition.filter("text")
				.style("font-size", "16px") // initial guess
				//.style("font-size", function(d) { return ((2*d.r)/ (margin/5)) + "px";})
				.attr("text-anchor", "middle")
				.attr("class", "label")
				.style("opacity", function(d) { return d.parent === focus ? 1 : 0; });
		}
	});

	d3.select(self.frameElement).style("height", outerDiameter + "px");

}