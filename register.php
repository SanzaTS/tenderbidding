<?php
  
  include("connection.php");
  include("session.php");

  $error = "";

  if(isset($_POST['save']))
  {
     $name = mysqli_real_escape_string($con,$_POST['name']);
     $surname =  mysqli_real_escape_string($con,$_POST['surname']);
     $idNum =  mysqli_real_escape_string($con,$_POST['id']);
     $email =  mysqli_real_escape_string($con,$_POST['email']);
     $phone =  mysqli_real_escape_string($con,$_POST['phone']);
     $username =  mysqli_real_escape_string($con,$_POST['username']);
     $password1 =  mysqli_real_escape_string($con,$_POST['password']);
     $password2 =  mysqli_real_escape_string($con,$_POST['password2']);
     $company = mysqli_real_escape_string($con,$_POST['company']);
     $industry = mysqli_real_escape_string($con,$_POST['industry']);

     if(!empty($name)|| !empty($surname) || !empty($idNum) || !empty($email) || !empty($phone) || !empty($username) || empty($password1) ||empty($password2)||empty($industry))
     {
        if (preg_match("/^[a-zA-Z][0-9a-zA-Z_!$@#^&]{5,20}$/", $username))
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (preg_match("/^[a-zA-Z ]*$/",$name))
                {
                    if (preg_match("/^[a-zA-Z ]*$/",$surname))
                    {
                        if(strlen($name) >= 3)
                        {
                            if(strlen($surname) >= 3)
                            {
                                if (is_numeric($idNum)){

                                    if (is_numeric($phone)){
                                       $code = substr($phone,0,1);

                                       if($code =="0")
                                       { 
                                          $second = substr($phone,1,1);
                                          if($second == "7" || $second =="8" || $second =="1" || $second =="6")
                                          {
                                               $third = substr($phone,2,1);
                                               if($third == "0"||$third == "1"||$third == "2" || $third == "3" || $third == "4" || $third == "6" ||$third == "8"|| $third == "9")
                                               { 
                                                   if($password1 == $password2)
                                                   {        
                                                       if(strlen($idNum) == 13)
                                                       { 
                                                           if(strlen($phone) == 10)
                                                           {
                                                            $check1 = mysqli_query($con,"SELECT * FROM users WHERE username = '$username'");
                                                            if(mysqli_num_rows($check1)== 0)
                                                            {
                                                                $check2 = mysqli_query($con,"SELECT * FROM bidder WHERE email = '$email'");
                                                                if(mysqli_num_rows($check2)== 0)
                                                                {
                                                                    $date = date("Y-m-d");
                                                                    $sql1 = "INSERT INTO users(username,password,role,createdAt,Active) VALUES('$username','$password1','Bidder','$date','online')";
                                                                    if(mysqli_query($con,$sql1) or die(mysqli_error($con)))
                                                                    {
                                                                        $id = mysqli_insert_id($con);
                                                                        $sql2 = "INSERT INTO `bidder`(`name`, `surname`, `id_num`, `company`, `industry`, `email`, `contact_no`, `user_id`) VALUES('$name','$surname','$idNum','$company','$industry','$email',$phone,$id)";
                                                                        
                                                                        if(mysqli_query($con,$sql2) or die(mysqli_error($con))){

                                                                            $_SESSION['username'] = $username;
                                                                           // $error ="Successfully loaded";
                                                                           header("location:bidder.php");
                                                                        }
                                                                    }
        
                                                                }
                                                                else{
                                                                    $error="Email already exists";
                                                                }
                                                            }
                                                            else{
                                                                $error = "Username already exists";
                                                            }

                                                           }
                                                           else{
                                                               $error = "Phone number must be 10 digits ";
                                                           }

                                                       }
                                                       else{
                                                           $error = "Id Number must be 13 digits";
                                                       }

                                                   }
                                                   else{
                                                       $error ="Password do not match";
                                                   }

                                               }
                                               else{
                                                   $error = "Invalid phone format";
                                               }
                                                
                                               
                                            }
                                          else{
                                              $error = "Phone number code should be 07,08,01or 06";
                                          }

                                       }
                                       else{
                                         $error = "Phone number should start with 0" ; 
                                       }


                                    }
                                    else{
                                        $error = "Phone number must be digit";
                                    }
                                    
                                }
                                else{
                                    $error="Id mus be digit";
                                }
                            }
                            else{
                                $error="surname must have minimum of 3 charecters";
                            }
                        }else{
                            $error = "name must have minimum of 3 charecters";
                        }
                    }
                    else{
                        $error = "Only letters allowed in surname";
                    }
                }
                else{
                    $error = "Only letters allowed in name";
                }
            }
            else{
                $error="Invalid email";
            }
        }
        
        else
        {
             $error = "Username must start with a charecter <br> The lenght be 5 to 20 charecters";
        }
     }
     else
     {
         $error = "All fields must be filled";
     }

  }


?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tender Bidding System</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Tender Bidding  System</strong></h1>
                            <div class="description">
                            	<p>
	                            	Welcome to Tender Bidding System(TBS)  
	                            	
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Create account</h3>
                            		<p>Enter your details to be able to access the system:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="register.php" method="post" class="login-form">
                                   <label style="color:red;"><?php echo $error; ?></label>
                                <div class="form-group">
			                    		<label class="sr-only" for="name" >Name</label>
			                        	<input type="text" maxlength="20" name="name" placeholder="name..." class="form-name form-control" id="name">
                                    </div>
                                    <div class="form-group">
			                    		<label class="sr-only" for="surname" >Surname</label>
			                        	<input type="text"  maxlength="20" name="surname" placeholder="surname..." class="form-surname form-control" id="surname">
                                    </div>
                                    <div class="form-group">
			                    		<label class="sr-only" for="id" >ID Number</label>
			                        	<input type="text" maxlength="13" name="id" placeholder="id number..." class="form-id form-control" id="id">
                                    </div>
                                    <div class="form-group">
			                    		<label class="sr-only" for="id" >Company Name</label>
			                        	<input type="text" maxlength="25" name="company" placeholder="Company..." class="form-id form-control" id="company">
                                    </div>
                                    <div class="form-group">
			                    		<label class="sr-only" for="id" >Industry</label>
			                        	<select name="industry" class="form-id form-control" >
                                         <option>---Select your business type---</option>
                                         <option value="Infomation Technology">Infomation Technology<option>
                                         <option value="Construction">Construction</option>
                                         <option value="Health">Health<option>
                                         <option value="Hospitality">Hospitality<option>
                                         <option value="Manufacture">Manufacture<option>
                                        </select>
                                    </div>

                                    <div class="form-group">
			                    		<label class="sr-only" for="email">Email</label>
			                        	<input type="text" name="email" maxlength="30" placeholder="email..." class="form-email form-control" id="email">
                                    </div>
                                    <div class="form-group">
			                    		<label class="sr-only" for="phone">Contact Number</label>
			                        	<input type="text"  maxlength="10" name="phone"  placeholder="Contact Number..." class="form-username form-control" id="phone">
                                    </div>
                                    
			                    	<div class="form-group">
			                    		<label class="sr-only" for="username">Username</label>
			                        	<input type="text" maxlength="30" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="password">Password</label>
			                        	<input type="password"  name="password" placeholder="Password..." class="form-password form-control" id="password">
                                    </div>
                                    <div class="form-group">
			                        	<label class="sr-only" for="password2">Re-Type Password</label>
			                        	<input type="password" name="password2" placeholder="Re-Type Password..." class="form-password2 form-control" id="password2">
                                    </div>
                                    
                                    <button type="submit" name="save" class="btn">Sign in!</button>
                                    <a href="index.php">Already have an account?</a>
			                    </form>
		                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<!--<h3>...or login with:</h3>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-google-plus"></i> Google Plus
	                        	</a>-->
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>