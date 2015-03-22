<html>
<body style="  background-color: #6FE2F9;">
<h1>History</h1>
<hr>
<div style=" background-color: #FFF;    margin: 30px;    border-radius: 10px;    box-shadow: -3px -0px 30px 10px #EEE;">
<h2>Party</h2>
<table style="padding: 10px; width: 100%;">
<col width = "25%">
<col width = "25%">
<col width = "25%">
<col width = "25%">
<tr style="font-weight: bold;">
	<td> Payer </td>
	<td> Merchant </td>
	<td> Date</td>
	<td> Paid Amount </td>
</tr>
<tr>
	<td> Master Joe </td>
	<td> Food Store </td>
	<td> 22nd Mar 2015</td>
	<td> HKD 1000 </td>
</tr>
<tr>
	<td> Master Bill </td>
	<td> Food Store </td>
	<td> 12nd Mar 2015</td>
	<td> HKD 2000 </td>
</tr>
</table>
<hr>
<p style="padding: 10px; width: 70%;"><strong>Total: HKD 3000</strong></p>
<p style="padding: 10px; width: 70%;"><strong>To pay: HKD 500</strong></p>
<script>
	function gotoMoneySend()
	{
		location.href = "moneySend.php";
	}
</script>
<button onclick="gotoMoneySend()" style="margin: 20px;">Distribute</button>
</div>
</body>
</html>