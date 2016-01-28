<?php

require "host.php";
print_r($_POST);

if (isset($_POST['firstname'])) {
    $pwd = $_POST['password'];

//    //////// Check If User Name Exisits /////////////
//
//	
//	//$sql_check = "Select username Where username Like :checkUser";
//		$sql_check = "Select username From tbl_user Where username Like :checkUser";
//	
//	
//	$checkUserName = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
//	$sql_checkh = $pdo->prepare($sql_check);
//	$sql_checkh->bindparam(":checkUser",$checkUserName);
//	$checkrow = $sql_checkh->execute();
//	
//	$checkrow = $sql_checkh->fetch();
//	
//	if($sql_checkh->rowCount()>0)
//	{
//		unset($_POST);
//		header("Location: errorMessage.php");
//	}
//	
//	////////////////////////////////////
    //create sql statement
    $sql_stmt = "INSERT INTO tbl_blog "
            . "(firstname, "
            . "lastname, "
            . "email, "
            . "address, "
            . "city, "
            . "state, "
            . "zip, "
            . "password) "
            . "VALUES "
            . "(:firstname, "
            . ":lastname, "
            . ":email, "
            . ":address, "
            . ":city, "
            . ":state, "
            . ":zip, "
            . ":password)";

    //prepare the sql statement
    $sqlh = $pdo->prepare($sql_stmt);

    //sanitize the input
    $in_firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $in_lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $in_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $in_address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $in_city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    $in_state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
    $in_zip = filter_var($_POST['zip'], FILTER_SANITIZE_STRING);
    $in_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    //hash the password
    /*
     * NOTE THAT password_hash should go into a field that
     * is 255 in length.  It also includes a builtin random salt 
     * and it currently uses BCrypt.
     */
    $in_password = password_hash($in_password, PASSWORD_DEFAULT);

    //bind the parameters
    $sqlh->bindparam(":firstname", $in_firstname);
    $sqlh->bindparam(":lastname", $in_lastname);
    $sqlh->bindparam(":email", $in_email);
    $sqlh->bindparam(":address", $in_address);
    $sqlh->bindparam(":city", $in_city);
    $sqlh->bindparam(":state", $in_state);
    $sqlh->bindparam(":zip", $in_zip);
    $sqlh->bindparam(":password", $in_password);

    //excecute the sqlstatement
    $sqlh->execute();
}

//FORM      
else {

    echo"
        <div id='data'>

<form method='POST' action='user_registration.php' >
            
                <table width='450px'>
    </tr>
    <tr>
    <td valign = 'top'>
    <label for = 'firstname'>First Name *</label>
    </td>
    <td valign = 'top'>
    <input type = 'text' name = 'firstname' value = '' maxlength = '50' size = '30'>
    </td>
    </tr>

    <tr>
    <td valign = 'top'>
    <label for = 'lastname'>Last Name *</label>
    </td>
    <td valign = 'top'>
    <input type = 'text' name = 'lastname' value = '' maxlength = '50' size = '30'>
    </td>
    </tr>
    <tr>
    <td valign = 'top'>
    <label for = 'email'>Email Address *</label>
    </td>
    <td valign = 'top'>
    <input type = 'text' name = 'email' value = '' maxlength = '80' size = '30'>
    </td>
    <tr>
    <td valign = 'top'>
    <label for = 'email'>Password *</label>
    </td>
    <td valign = 'top'>
    <input type = 'password' name = 'password' value = '' maxlength = '80' size = '30'>
    </td>

    </tr>
    <tr>
    <td valign = 'top'>
    <label for = 'telephone'>Address</label>
    </td>
    <td valign = 'top'>
    <input type = 'text' name = 'address' value = '' maxlength = '30' size = '30'>
    </td>
    </tr>
    <tr>
    <td valign = 'top'>
    <label for = 'telephone'>City</label>
    </td>
    <td valign = 'top'>
    <input type = 'text' name = 'city' value = '' maxlength = '30' size = '30'>
    </td>
    </tr>
    <tr>
    <td valign = 'top'>
    <label for = 'telephone'>State</label>
    </td>
    <td valign = 'top'>
    <input type = 'text' name = 'state' value = '' maxlength = '30' size = '30'>
    </td>
    </tr>
    <tr>
    <td valign = 'top'>
    <label for = 'telephone'>Zip</label>
    </td>
    <td valign = 'top'>
    <input type = 'text' name = 'zip' value = '' maxlength = '30' size = '30'>
    </td>
    </tr>

    </tr>
    <tr>
    <td colspan = '2' style = 'text-align:center'>
    <input type = 'submit' value = 'Submit'>
    </td>
    </tr>
    </table>
    

    </form> 
    
    </div>";
    
    
    
    
    
}
?>