
function loadVis(arrayLev){	
		$("body").empty();
		var w = 1280,
			h = 800,
			r = 720,
			x = d3.scale.linear().range([0, r]),
			y = d3.scale.linear().range([0, r]),
			node,
			root;

		var pack = d3.layout.pack()
			.size([r, r])
			.value(function(d) { return d.size; })

		var vis = d3.select("body").insert("svg:svg", "h2")
			.attr("width", w)
			.attr("height", h)
			.append("svg:g")
			.attr("transform", "translate(" + (w - r) / 2 + "," + (h - r) / 2 + ")");
		
		var	newData;
		var i = 0;
		

		//This AJAX call is going to perform a POST on the url indicated by url:
		//On Success it will format the data(From JSON data) and build the circle packing layout for visualization
		$.ajax({
			url:"./dbFunctionJson.php",
			type: "POST",
			success: function(data){	//on success, the data returned from the php file will be put into this callback function for further processing
			
				//Current fields being pulled: profile_type, school, state, gender, ethnicity, current_level, gpa
				
				//This for loop will set a static size of 500
				for (var i = 0; i < data.length; i++) 
				{
					data[i].size = 500;
				}
				//console.log(data);	//for testing
			
				newData = {"name":"STARS", "children":[]}		//this will set the root node to be "name":"STARS" 
			
				levels = arrayLev;

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

				//console.log(newData);  //for testing
			
				//d3.json(newData, function(data) { 	//this was taken out from the original
				
				//console.log(newData);	 //for testing.
				
				//From here down, the circle packing starts to take place with the tree formatted from above.
				node = root = newData;

				var nodes = pack.nodes(root);

				vis.selectAll("circle")
					.data(nodes)
					.enter().append("svg:circle")
					.attr("class", function(d) { return d.children ? "parent" : "child"; })
					.attr("cx", function(d) { return d.x; })
					.attr("cy", function(d) { return d.y; })
					.attr("r", function(d) { return d.r; })
					.on("click", function(d) { return zoom(node == d ? root : d); });

				vis.selectAll("text")
					.data(nodes)
					.enter().append("svg:text")
					.attr("class", function(d) { return d.children ? "parent" : "child"; })
					.attr("x", function(d) { return d.x; })
					.attr("y", function(d) { return d.y; })
					.attr("dy", ".35em")
					.attr("text-anchor", "top")
					.style("opacity", function(d) { return d.r > 20 ? 1 : 0; })
					.text(function(d) { return d.name; });

				d3.select(window).on("click", function() { zoom(root); });
				
				//this function performs the zoom functions
				function zoom(d, i) {
					var k = r / d.r / 2;
					x.domain([d.x - d.r, d.x + d.r]);
					y.domain([d.y - d.r, d.y + d.r]);

					var t = vis.transition()
						.duration(d3.event.altKey ? 7500 : 750);

					t.selectAll("circle")
						.attr("cx", function(d) { return x(d.x); })
						.attr("cy", function(d) { return y(d.y); })
						.attr("r", function(d) { return k * d.r; });

					t.selectAll("text")
						.attr("x", function(d) { return x(d.x); })
						.attr("y", function(d) { return y(d.y); })
						.style("opacity", function(d) { return k * d.r > 20 ? 1 : 0; });

					node = d;
					d3.event.stopPropagation();
				}
			}
		
		});
	}