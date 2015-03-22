<html>
<body style="background-color: #6FE2F9;">
<script>
	function gotoHistory()
	{
		location.href="history.php";
	}
</script>
<div style="background-color: #FFF;    margin: 30px;    border-radius: 10px;    box-shadow: -3px -0px 30px 10px #EEE;">
<h1>Order Confirmation</h1>
<table style="padding: 10px; width: 100%;">
<tr>
	<td> <strong>Recipient Name: </strong></td>
	<td> Master Joe </td>
</tr>
<tr>
	<td> <strong>Recipient Address:</strong></td>
	<td> Address 1 </td>
</tr>
<tr>
	<td> <strong>Recipient Phone: </strong></td>
	<td> 852-63463790</td>
</tr>
<tr>
	<td> <strong>Email Address: </strong></td>
	<td> silly_po@yahoo.com.hk</td>
</tr>
</table>

<h3> Select event for this transaction:</h3>
<input type="radio" name="sex" value="male">Party<br>
<input type="radio" name="sex" value="male">Trip to London<br>
<input type="radio" name="sex" value="male">Family Renovation<br>
<input type="radio" name="sex" value="male">No Event<br>

<button style="margin: 10px;" onclick="gotoHistory()">Complete Order</button>
</div>
</body>
</html>