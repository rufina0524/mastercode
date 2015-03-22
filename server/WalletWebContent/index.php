<?php
require_once('Controller/MasterPassController.php');

$profiles = MasterPassController::getShippingProfiles();
$data = array();

foreach($profiles as $value)
{
	$settings = parse_ini_file(MasterPassData::RESOURCES_PATH.MasterPassData::PROFILE_PATH.$value.MasterPassData::CONFIG_SUFFIX);

	$data[$value][] = $settings;
}

$sad = new MasterPassData();
$controller = new MasterPassController($sad);

session_start();
$_SESSION['sad'] = serialize($sad);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>MasterPass SDK Sample Application</title>
	<link rel="stylesheet" type="text/css" href="Content/Site.css">
	<script type="text/javascript" src="Scripts/jquery-1.5.1.js"></script> 
	<script type="text/javascript" src="Scripts/index.js"></script>
	<script type="text/javascript" src="Scripts/tooltips/jquery-1.3.2.min.js"></script> <!-- Needed for tooltips only -->
	<script type="text/javascript" src="Scripts/tooltips/jquery.qtip-1.0.0-rc3.min.js"></script>
	<script type="text/javascript" src="Scripts/tooltips/commonToolTips.js"></script>
	<script type="text/javascript">
	
	 
	</script>
</head>
<body>
	<div class="page">
		<div id="header">
			<div id="title">
				<h1>MasterPass SDK Sample Application</h1>
			</div>
			<div id="logindisplay">&nbsp;</div>
		</div>
		
		<div id="main">
			<h1>Configuration Information</h1>
			<p>Following is the information that will be used to interact with
				the MasterCard API:</p>
				
			<h3 class = "error">
				Please note: For this sample app to work end to end, the host file <u>MUST</u> be updated with the callback URL. See ReadMe file for more details.
				<span class='tooltip' id='hostFile'>[?]</span>
			</h3>
			
			<fieldset>
				<legend>Config File Data</legend>
				<table>
					<tbody>
						<tr>
							<td>
								Consumer Key
								<span class='tooltip' id='conKey'>[?]</span>
							</td>
							<td id="consumerKey">
								<?php echo $sad->consumerKey; ?>
							</td>
						</tr>
						<tr>
							<td>
								Checkout Identifier
									<span class='tooltip' id='chkId'>[?]</span>
							</td>
							<td id="checkoutIdentifier">
								<?php echo $sad->checkoutIdentifier; ?>
							</td>
						</tr>
						<tr>
							<td>
								Keystore Path 
								<span class='tooltip' id='keyStorepath' >[?]</span>	
							</td>
							<td id="keystorePath">
								<?php echo $sad->keystorePath; ?>
							</td>
						</tr>
						<tr>
							<td>
								Keystore Password
								<span class='tooltip' id='keyStorepass'>[?]</span>
							</td>
							<td id="keystorePassword">
								<?php echo $sad->keystorePassword; ?>
							</td>
						</tr>
						<tr>
							<td>
								Callback URL
								<span class='tooltip' id='callback'>[?]</span>
							</td>
							<td id="callBackUrl">
								<?php echo $sad->callbackUrl; ?>
							</td>
						</tr>
						<tr>
							<td>
								Request Token URL
								<span class='tooltip' id='requestEndpoint'>[?]</span>	
							</td>
							<td id="requestUrl">
								<?php echo $sad->requestUrl; ?>
							</td>
						</tr>
						<tr>
							<td>
								Shopping Cart URL
								<span class='tooltip' id='shopEndpoint' >[?]</span>
							</td>
							<td id="shoppingCartUrl">
								<?php echo $sad->shoppingCartUrl; ?>
							</td>
						</tr>
						<tr>
							<td>
								Access Token URL
								<span class='tooltip' id='accessEndpoint'>[?]</span>
							</td>
							<td id="accessUrl">
								<?php echo $sad->accessUrl; ?>
							</td>
						</tr>
						<tr>
							<td>
								Postback URL
								<span class='tooltip' id='postbackEndpoint'>[?]</span>
							</td>
							<td id="postbackurl">
								<?php echo $sad->postbackUrl; ?>
							</td>
						</tr>
					</tbody>
				</table>
			</fieldset>
			<form id="merchantInfo" name="merchantInfo" method="POST">
				<fieldset>
					<legend>Redirect Options</legend>
					<table id="merchantOptions" class="ui-responsive">
						<tr>
							<td>
							</td>
							<td class="errorText">
								<span id="shippingSuppressionErrorMessage">Shipping Suppression cannot be used when Xml Version is less then v2.</span>
							</td>
							<td class="errorText">
								<span id="rewardsProgramErrorMessage">Rewards Program cannot be used when Xml Version is less then v4.</span>
							</td>
							<td class="errorText">
								<span id="authLevelErrorMessage">Authentication Level Basic cannot be used when Xml Version is less then v3.</span>
							</td>
							<td class="errorText">
								<span id="shippingProfileErrorMessage">Shipping Profiles cannot be used when Xml Version is less then v4.</span>
							</td>
							<td>
							</td>
						</tr>
						<tr>
							<td>
								XML Version
								<span class='tooltip' id='xmlversion'>[?]</span>
							</td>
							<td>
								<select name="xmlVersionDropdown" id="xmlVersionDropdown">
										<option selected="selected"  value="v6">v6</option>
										<!--<option value="v5">v5</option>
										<optionvalue="v4">v4</option>
										<option value="v3">v3</option>
										<option value="v2">v2</option>
										<option value="v1">v1</option>
										 -->
								</select>
							</td>
							<td>
								Suppress Shipping Address Enable
								<span class='tooltip' id='shippingsuppression'>[?]</span>
							</td>
							<td>
								<select name="shippingSuppressionDropdown" id="shippingSuppressionDropdown">
									<option value="true">True</option>
									<option selected="selected" value="false">False</option>
								</select>
							</td>
							<td>
								Loyalty Enabled
								<span class='tooltip' id='rewards'>[?]</span>
							</td>
							<td>
								<select name="rewardsDropdown" id="rewardsDropdown">
									<option value="true">True</option>
									<option selected="selected" value="false">False</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Request Basic Checkout
								<span class='tooltip' id='authlevel'>[?]</span>
							</td>
							<td>
								<input type="checkbox" name="authenticationCheckBox" id="authenticationCheckBox">
							</td>						
						</tr>
						<tr>
							<td>
								Allowed Card Types
								<span class='tooltip' id='acceptedcards'>[?]</span>
							</td>
							<td width=150>
								<table >
									<tr>
										<td>
											<input type="checkbox" name="acceptedCardsCheckbox[]" value="master" id="master" checked="checked">MasterCard 
										</td>
										<td>
											<input type="checkbox" name="acceptedCardsCheckbox[]" value="amex" id="amex" checked="checked">Amex
										</td>
										<td>	
											<input type="checkbox" name="acceptedCardsCheckbox[]" value="diners" id="diners" checked="checked">Diners
										</td>
									</tr>
									<tr>
										<td>	 
											<input type="checkbox" name="acceptedCardsCheckbox[]" value="discover" id="discover" checked="checked">Discover
										</td>
										<td>	 
											<input type="checkbox" name="acceptedCardsCheckbox[]" value="maestro" id="maestro" checked="checked">Maestro
										</td>
										<td>	 
											<input type="checkbox" name="acceptedCardsCheckbox[]" value="visa" id="visa" checked="checked">Visa
										</td>
									</tr>
								</table>
							</td>
							<td>
								Private Label Card
								<span class='tooltip' id='privatelabel'>[?]</span>
							</td>
							<td>
								<input type="text" name="privateLabelText" id="privateLabelText">
							</td>	
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>User Flows</legend>
					<p>Click the Checkout, Pairing, or Cart Example buttons below to begin an SDK demo.</p>
					<input id="checkout" value="Checkout Flow" type="submit"> 
					<input id="pairing" value="Pairing Flow" type="submit">
					<input id="example" value="Cart Example Flow" type="submit">
				</fieldset>
				
			</form>
		</div>
		<div id="footer"></div>
	</div>
	
    
	<script>
	$('#checkout').click(function(event) {
		 var checkedCheckboxes = $('input[name="acceptedCardsCheckbox[]"]:checked').length;
		 
			if(checkedCheckboxes == 0){
				alert("There are no Cards selected");
					event.preventDefault();
			}
			else{
				$("#merchantInfo").attr("action", "O1_GetRequestToken.php");
				$("#merchantInfo").submit();
			}
	});
		
	$('#pairing').click(function(event) {
		var checkedCheckboxes = $('input[name="acceptedCardsCheckbox[]"]:checked').length;
		 
		if(checkedCheckboxes == 0){
			alert("There are no Cards selected");
				event.preventDefault();
		}
		else{
			$("#merchantInfo").attr("action", "P1_Pairing.php");
			$("#merchantInfo").submit();
		}
	});
	
	
	$('#example').click(function(event) {
		var checkedCheckboxes = $('input[name="acceptedCardsCheckbox[]"]:checked').length;
		 
		if(checkedCheckboxes == 0){
			alert("There are no Cards selected");
				event.preventDefault();
		}
		else{
			$("#merchantInfo").attr("action", "C1_Cart.php");
			$("#merchantInfo").submit();
		}
	});
	
	
	</script>

</body>
</html>