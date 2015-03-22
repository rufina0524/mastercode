<?php

require_once('Controller/MasterPassController.php');
require_once('Controller/MasterPassHelper.php');

session_start();
$sad = unserialize($_SESSION['sad']);
$controller = new MasterPassController($sad);

$errorMessage = null;

if(isset($_GET["error"])) {
	$errorMessage = ' ';
}

try {
	$sad = $controller->setPairingToken(isset($_GET[MasterPassService::PAIRING_TOKEN]) ? $_GET[MasterPassService::PAIRING_TOKEN] : NULL);
	$sad = $controller->setPairingVerifier(isset($_GET[MasterPassService::PAIRING_VERIFIER]) ? $_GET[MasterPassService::PAIRING_VERIFIER] : NULL);
	
	$sad = $controller->getLongAccessToken();
	
	if (!empty($sad->longAccessToken)) {
		setcookie('longAccessToken', $sad->longAccessToken, time() + (60*60*24*7));
	}
	
} catch (Exception $e) {
	$errorMessage = MasterPassHelper::formatError($e->getMessage());
}

$_SESSION['sad'] = serialize($sad);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>
    	MasterPass Connect Pairing Checkout Flow
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="Content/Site.css">
    <script type="text/javascript" src="Scripts/jquery-1.5.1.js"></script>
    <script type="text/javascript" src="Scripts/tooltips/commonToolTips.js"></script>
    <script type="text/javascript" src="Scripts/tooltips/jquery-1.3.2.min.js"></script> <!-- Needed for tooltips only -->
	<script type="text/javascript" src="Scripts/tooltips/jquery.qtip-1.0.0-rc3.min.js"></script>
</head>
<body class="pairing">
    <div class="page">
        <div id="header">
            <div id="title">
                <h1>
                    MasterPass Connect Pairing Checkout Flow </h1>
            </div>
            <div id="logindisplay">
                &nbsp;
            </div>
        </div>
        <div id="main">
            <h1>
                Received Callback from Wallet Site
            </h1>
            <p>
                Data received from the Callback URL<br/>
                Use the Pairing Token and the Pairing Verifier to get the Long Access Token.
            </p>

             <fieldset>
            <legend>Data from the Callback URL</legend>
            <table>
                <tbody>
                    <tr>
                        <th>
                        Pairing Token 
                        </th>
                        <td>
                             <?php echo $sad->pairingToken ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Pairing Token Verifier 
                        </th>
                        <td>
                            <?php echo $sad->pairingVerifier ?>
                        </td>
                    </tr>
                </tbody>
               
            </table>
            </fieldset>
            
<?php if ($sad->longAccessToken != null): ?>            
            
            <h1>
                Received Long Access Token
            </h1>
            
            <fieldset>
            <legend>Sent</legend>
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
                        
                        <td class="formatUrl">
                        	<hr>
                           <code><?php echo $controller->service->signatureBaseString; ?></code>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            </fieldset>
             <fieldset>
            <legend>Sent to:</legend>
            <table>
             <tr>
                        <th>
                            Access Token URL 
                        </th>
                        <td>
                            <?php echo $sad->accessUrl; ?>
                        </td>
                    </tr>
            </table>
            </fieldset>
            
             <fieldset>
            <legend>Received:</legend>
                       
            <table>
             <tr>
                        <th>
                            Access Token 
                        </th>
                        <td>
                            <?php echo $sad->longAccessToken ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Oauth Secret 
                        </th>
                        <td>
                            <?php echo $sad->oAuthSecret; ?>
                        </td>
                    </tr>
            </table>
            </fieldset>

            <div class="preCheckoutDiv">
	            <form id="preCheckoutForm" method="POST" action="O5_PreCheckout.php">
		            <p>
	                    <input value="Retrieve Pre Checkout Data" type="submit">
		            </p>
	            </form>
            </div>
            <div class="expressCheckoutDiv">
	            <form id="expressCheckoutForm" method="POST" action="O5_PreCheckout.php?express=true">
	            <p>
	                    <input value="Retrieve Pre Checkout Data" type="submit">
		            </p>
	            </form>
            </div>
            
<?php else: ?>

            <h1 style="color:red">
                Unable to retrieve Long Access Token. You will not be able to request Precheckout Data.
            </h1>

                        
<?php endif; ?>            
            
        </div>
        <div id="footer">
        </div>
    </div>
    
    
             <script>
	            function getJsonFromUrl() {
	            	  var query = location.search.substr(1);
	            	  var result = {};
	            	  query.split("&").forEach(function(part) {
	            	    var item = part.split("=");
	            	    result[item[0]] = decodeURIComponent(item[1]);
	            	  });
	            	  return result;
            	}
	            
	            
	            $(document).ready(function(){
	            	var locationParams = getJsonFromUrl();
	            	if (locationParams.express) {
		            	console.log("express is true");
		            	$(".pairing").toggleClass("pairing express");
		            	$(".expressCheckoutDiv").css({display:"block"});
		            	$(".preCheckoutDiv").css({display:"none"});
		            	document.title = $("#title > h1").text('MasterPass Express Pairing Flow').text();
		            } else {
		            	$(".expressCheckoutDiv").css({display:"none"});
		            	$(".preCheckoutDiv").css({display:"block"});
		            }
	            })
	            
            </script>
            
    
</body>
</html>