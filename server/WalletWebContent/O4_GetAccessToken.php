<?php
require_once('Controller/MasterPassController.php');
require_once('Controller/MasterPassHelper.php');

session_start();
$sad = unserialize($_SESSION['sad']);
$controller = new MasterPassController($sad);

$errorMessage = null;

try {
	$sad = $controller->getAccessToken();
	
	} catch (Exception $e){
		$errorMessage = MasterPassHelper::formatError($e->getMessage());
	}

	$_SESSION['sad'] = serialize($sad);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>
    	Masterpass Standard Checkout Flow
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="Content/Site.css">
    <script type="text/javascript" src="Scripts/jquery-1.5.1.js"></script>
    <script type="text/javascript" src="Scripts/common.js"></script>
    <script type="text/javascript" src="Scripts/tooltips/commonToolTips.js"></script>
    <script type="text/javascript" src="Scripts/tooltips/jquery-1.3.2.min.js"></script> <!-- Needed for tooltips only -->
	<script type="text/javascript" src="Scripts/tooltips/jquery.qtip-1.0.0-rc3.min.js"></script>
</head>
<body class="postCheckout">
    <div class="page">
        <div id="header">
            <div id="title">
                <h1>
                   Masterpass Standard Checkout Flow</h1>
            </div>
            <div id="logindisplay">
                &nbsp;
            </div>
           
        </div>
        <div id="main">
            <h1>
                Retrieved Access Token
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
                Use the Request Token and Verifier retrieved in the previous step to request an Access Token.
            </p>
            
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
                        
                        <td >
                        	<hr>
                            <code><?php echo $controller->service->signatureBaseString;  ?></code>
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
                        	<?php echo $sad->accessToken; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Oauth Secret 
                        </th>
                        <td>
                        	<?php echo $sad->accessTokenResponse->oAuthSecret; ?>
                        </td>
                    </tr>
            </table>
            </fieldset>
            <form method="POST" action="O5_ProcessCheckout.php">
	            <p>
                    <input value="Retrieve Checkout Data" type="submit">
	            </p>
            </form>
        </div>
        <div id="footer">
        </div>
    </div>
</body>
</html>
