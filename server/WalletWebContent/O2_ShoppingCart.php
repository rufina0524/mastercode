<?php
require_once('Controller/MasterPassController.php');
require_once('Controller/MasterPassHelper.php');

session_start();
$sad = unserialize($_SESSION['sad']);
$controller = new MasterPassController($sad);

if($sad->requestToken == null){
	header("Location: ./" );
}

$errorMessage = null;

try {
	$sad = $controller->postShoppingCart();
	
} catch (Exception $e){
	$errorMessage = MasterPassHelper::formatError($e->getMessage());
}	

$_SESSION['sad'] = serialize($sad);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>
    	MasterPass Standard Flow
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="Content/Site.css">
    <script type="text/javascript" src="Scripts/jquery-1.5.1.js"></script>
    <script type="text/javascript" src="Scripts/common.js"></script>
    <script type="text/javascript" src="Scripts/tooltips/commonToolTips.js"></script>
    <script type="text/javascript" src="Scripts/tooltips/jquery-1.3.2.min.js"></script> <!-- Needed for tooltips only -->
	<script type="text/javascript" src="Scripts/tooltips/jquery.qtip-1.0.0-rc3.min.js"></script>
	<script type="text/javascript" src="<?php echo $sad->lightboxUrl ?>"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
	
</head>
<body class="standard">
    <div class="page">
        <div id="header">
            <div id="title">
                <h1>
                    MasterPass Standard Flow
                </h1>
            </div>
            <div id="logindisplay">
                &nbsp;
            </div>
            
        </div>
        <div id="main">
            <h1>
                Shopping Cart Data Submitted
            </h1>
<?php       
	if ( $errorMessage != null ){ 

	echo '<h2>Error</h2>
	<div class = "error">
		<p>
		    The following error occurred while trying to get the Request Token from the MasterCard API.
		</p>
		<p>		
<pre>
<code>',$errorMessage,
'</code>
</pre>
		</p></div>';

	}
?>       
            <p>
                This step sends the Merchants shopping cart data to MasterCard services for display in the Wallet.
            </p>
            
          <fieldset>
            <legend>Sent:</legend>
          	<table>
                 <tr>
                        <th>
                            Authorization Header 
                        </th>
                        <td>                      
							<code><?php echo $controller->service->authHeader; ?></code>
                        </td>
                    </tr> 
	              	<tr>
                        <th>
                            Signature Base String 
                        </th>
                        <td>
                        	<hr>
                            <code><?php echo $controller->service->signatureBaseString; ?></code>
                        </td>
                    </tr>  
                    <tr>
                        <th>
                            Shopping Cart XML 
                        </th>
                        <td>
<pre>                        
<code>                        
<?php echo MasterPassHelper::formatXML($sad->shoppingCartRequest); ?>
</code>
</pre>                            
                        </td>
                    </tr>  
           </table>
           </fieldset>
           <fieldset>
            <legend>Sent To:</legend>
           		<table>                     
                    <tr>
                        <th>
                            Shopping Cart URL 
                        </th>
                        <td>
                            <?php echo $sad->shoppingCartUrl; ?>
                        </td>
                    </tr>
                    
                 </table>  
                 </fieldset>
            <fieldset>
            <legend>Received:</legend>           
                    
           		<table>                     
                    <tr>
                        <th>
                            Shopping Cart Response 
                        </th>
                        <td>
<pre>                        
<code>                        
<?php echo MasterPassHelper::formatXML($sad->shoppingCartResponse); ?>
</code>
</pre>                           
                        </td>
                    </tr>
                     
                 </table>
                 </fieldset>
                <fieldset>
	                <legend>Standard Checkout</legend>
		            <br/>
		            <div id="checkoutButtonDiv" onClick="handleBuyWithMasterPass()">
						<a href="#">
							<img src="https://www.mastercard.com/mc_us/wallet/img/en/US/mcpp_wllt_btn_chk_147x034px.png" alt="Buy with MasterPass">
						</a>
					</div>
					<div style="padding-bottom: 20px">
						<a href="http://www.mastercard.com/mc_us/wallet/learnmore/en" target="_blank">Learn More</a>
					</div>
					<div>
	            		<fieldset>
	            		<legend>Javascript</legend>
<pre><code id="sampleCode"></code></pre>
	            		</fieldset>
	            	</div>
				</fieldset>
				<fieldset>
					<legend>Connected Checkout</legend>
					<br/>
					<div id="pairingCheckoutDiv">
						<form id="pairingCheckoutForm" method="POST">
							<input id="pairingCheckout" value="Checkout with Pairing Flow" type="submit">
						</form>
	                </div>
				</fieldset>
                
	            
	        <script>

			var showRewards = <?php echo $sad->rewardsProgram ?> == true;
	        
	        $(document).ready(function(){
	        	console.log("document ready");
	
				var sampleCodeString = "";
				if (showRewards) {
		        	sampleCodeString = 'MasterPass.client.checkout({\n\t"requestToken":<?php echo $sad->requestToken ?>,\n\t"callbackUrl":<?php echo $sad->callbackUrl ?>,\n\t"merchantCheckoutId":<?php echo $sad->checkoutIdentifier ?>,\n\t"allowedCardTypes":<?php echo $sad->acceptableCards ?>,\n\t"cancelCallback":<?php echo $sad->callbackDomain ?>,\n\t"suppressShippingAddressEnable":<?php echo $sad->shippingSuppression ?>,\n\t"loyaltyEnabled":<?php echo $sad->rewardsProgram ?>,\n\t"allowedLoyaltyPrograms":<?php echo $sad->allowedLoyaltyPrograms ?>,\n\t"requestBasicCheckout" : "<?php echo $sad->authLevelBasic?>",\n\t"version":"v6"\n});';
				} else {
					sampleCodeString = 'MasterPass.client.checkout({\n\t"requestToken":<?php echo $sad->requestToken ?>,\n\t"callbackUrl":<?php echo $sad->callbackUrl ?>,\n\t"merchantCheckoutId":<?php echo $sad->checkoutIdentifier ?>,\n\t"allowedCardTypes":<?php echo $sad->acceptableCards ?>,\n\t"cancelCallback":<?php echo $sad->callbackDomain ?>,\n\t"suppressShippingAddressEnable":<?php echo $sad->shippingSuppression ?>,\n\t"loyaltyEnabled":<?php echo $sad->rewardsProgram ?>,\n\t"requestBasicCheckout" : "<?php echo $sad->authLevelBasic?>",\n\t"version":"v6"\n});';
				}

	        	$("#sampleCode").text(sampleCodeString);
	        });
	        
	        $('#pairingCheckout').click(function(event) {
					$("#pairingCheckoutForm").attr("action", "P1_Pairing.php?checkout=true");
					$("#pairingCheckoutForm").submit();
			});
	        
	        function handleBuyWithMasterPass() {

		        if (showRewards) {
		        	MasterPass.client.checkout({
		       			 "requestToken":"<?php echo $sad->requestToken ?>",
		       			 "callbackUrl":"<?php echo $sad->callbackUrl ?>",
		       			 "merchantCheckoutId":"<?php echo $sad->checkoutIdentifier ?>",
		       			 "allowedCardTypes":"<?php echo $sad->acceptableCards ?>",
		       			 "cancelCallback" : "<?php echo $sad->callbackDomain ?>",
		       			 "suppressShippingAddressEnable": "<?php echo $sad->shippingSuppression ?>",
		       			 "loyaltyEnabled" : "<?php echo $sad->rewardsProgram ?>",
		       			 "allowedLoyaltyPrograms" : "<?php echo $sad->allowedLoyaltyPrograms ?>",
		       			 "requestBasicCheckout" : "<?php echo $sad->authLevelBasic?>",
		       		 	 "version":"v6"
		       		});

		        } else {
		       		MasterPass.client.checkout({
		       			 "requestToken":"<?php echo $sad->requestToken ?>",
		       			 "callbackUrl":"<?php echo $sad->callbackUrl ?>",
		       			 "merchantCheckoutId":"<?php echo $sad->checkoutIdentifier ?>",
		       			 "allowedCardTypes":"<?php echo $sad->acceptableCards ?>",
		       			 "cancelCallback" : "<?php echo $sad->callbackDomain ?>",
		       			 "suppressShippingAddressEnable": "<?php echo $sad->shippingSuppression ?>",
		       			 "loyaltyEnabled" : "<?php echo $sad->rewardsProgram ?>",
		       			 "requestBasicCheckout" : "<?php echo $sad->authLevelBasic?>",
		       		 	 "version":"v6"
		       		});
		        }
	        }
	        
	        
       </script> 
        
        </div>
    </div>
</body>
</html>