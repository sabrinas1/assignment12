<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Jade Delight</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>
<script>

function MenuItem(name, cost)
{
	this.name = name;
	this.cost=cost;
}

menuItems = new Array(
	new MenuItem("Chicken Chop Suey", 4.5),
	new MenuItem("Sweet and Sour Pork", 6.25),
	new MenuItem("Shrimp Lo Mein", 6.25),
	new MenuItem("Moo Shi Chicken", 7.5),
	new MenuItem("Fried Rice", 2.85)
);

function makeSelect(name, minRange, maxRange)
{
	var t= "";
	t = "<select name='" + name + "' size='1'>";
	for (j=minRange; j<=maxRange; j++)
	   t += "<option>" + j + "</option>";
	t+= "</select>"; 
	return t;
}

function td(content, className="")
{
	return "<td class = '" + className + "'>" + content + "</td>";
}
	
</script>

<div id = "header">
	<h1>Jade Delight</h1>
</div>

<form>

	<p class="userInfo"><label>First Name:</label> <input type="text"  name='fname' /></p>
	<p class="userInfo"><label>Last Name*</label>:  <input type="text"  name='lname' /></p>
	<p class="userInfo address"><label>Street*</label>: <input type="text" name='street' /></p>
	<p class="userInfo address"><label>City*</label>: <input type="text" name='city' /></p>
	<p class="userInfo"><label>Phone*</label>: <input type="text"  name='phone' /></p>
	<p> 
		<input type="radio"  name="p_or_d" value = "pickup" checked="checked"/>Pickup  
		<input type="radio"  name='p_or_d' value = 'delivery'/>Delivery
	</p>
	<?php
	$server = "localhost";
	$userid = "ulg8kcxxl7e4g";
	$pw = "ujgfdgwgagux"; 
	$db= "db9qmhvsckkckt";
	
	// Create connection
	$conn = new mysqli($server, $userid, $pw );
	
	// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
	echo "Connected successfully<br>";
	
	//select the database
	$conn->select_db($db);
	
	//run a query
	$sql = "SELECT ItemName, Cost FROM Jade Delight Menu";
	$result = $conn->query($sql);
	
	//get results
	if ($result->num_rows > 0)
	{
	while($row = $result->fetch_assoc())
	{
	echo $row["Item Name"]. " " . $row["Cost"]. "<br>";
	}
	}
	else
	echo "no results";
	
	//close the connection
	$conn->close();

	?>

	<table border="0" cellpadding="3">
  	<tr>
    	<th>Select Item</th>
    	<th>Item Name</th>
    	<th>Cost Each</th>
    	<th>Total Cost</th>
  	</tr>
	<script>

  		var s = "";
  		for (i=0; i< menuItems.length; i++)
  		{
	  		s += "<tr>";
	  		s += td(makeSelect("quan" + i, 0, 10),"selectQuantity");
	  		s += td(menuItems[i].name, "itemName");
	  		s += td("$" +menuItems[i].cost.toFixed(2), "cost");
	  		s += td("$<input type='text' name='cost'/>", "totalCost");
	  		s+= "</tr>";
  		}
  		document.writeln(s);
	</script>
	</table>
	<p class="subtotal totalSection"><label>Subtotal</label>: 
   		$ <input type="text"  name='subtotal' id="subtotal" />
	</p>
	<p class="tax totalSection"><label>Mass tax 6.25%:</label>
  		$ <input type="text"  name='tax' id="tax" />
	</p>
	<p clas="total totalSection"><label>Total:</label> 
		$ <input type="text"  name='total' id="total" />
	</p>

	<input type = "button" value = "Submit Order" />

</form>
<?php
	//idk
?>
</body>
</html>
