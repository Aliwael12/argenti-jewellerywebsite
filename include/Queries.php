<?php

//---------------------- Lama Al-Ghamdi - 2190002418 - Functions ----------------------
//display all products (used in Admin Home)
function products_display($dbc)
{

   $query = "SELECT p_id, name, picture, price FROM product";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");


   // query Products database
   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error($dbc) . "</body></html>");
   } // end if

   if (mysqli_num_rows($result) > 0) {
      return $result;
   } else {
      return 0;
   }
   mysqli_close($dbc);
}

//display only four most stock products (used in Admin Home)
function featured_products_display($dbc)
{

   $query = "SELECT p_id, name, picture, price FROM product ORDER BY stock DESC LIMIT 4";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");


   // query Products database
   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error($dbc) . "</body></html>");
   } // end if

   if (mysqli_num_rows($result) > 0) {
      return $result;
   }
   mysqli_close($dbc);
}

//Search for products by name (used in Admin Home)
function search($dbc, $search)
{
   $search = trim($search);

   if ($search == "") {
      return ("no value");;
   }

   $query = "SELECT * FROM product WHERE name like'%$search%'";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");


   // query Products database
   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error($dbc) . "</body></html>");
   } // end if

   if (mysqli_num_rows($result) > 0) {
      return $result;
   } else {
      return ("none");
   }
   mysqli_close($dbc);
}

//Delete products by id (used in Admin Home)
function delete_product($dbc, $id)
{
   $query = "DELETE FROM product WHERE p_id='$id'";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");

   // query Products database
   if (!(mysqli_query($dbc, $query))) {
      die(mysqli_error($dbc) . "</body></html>");
   }
   mysqli_close($dbc);
}

//Display messages need to reply to (used in Customer Services)
function customer_service_messages($dbc)
{
   $query = "SELECT * FROM customer_service WHERE Done='0'";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");

   // query Products database
   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error($dbc) . "</body></html>");
   }

   if (mysqli_num_rows($result) > 0) {
      return $result;
   } else {
      return 0;
   }

   return $result;

   mysqli_close($dbc);
}

//Display messages already done replying to (used in Customer Services)
function customer_service_messages_done($dbc)
{
   $query = "SELECT * FROM customer_service WHERE Done = '1' ";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");

   // query Products database
   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error($dbc) . "</body></html>");
   }

   if (mysqli_num_rows($result) > 0) {
      return $result;
   } else {
      return 0;
   }

   mysqli_close($dbc);
}

//Modify messages Checkbox (used in Customer Services)
function done_undone_message($dbc, $id, $action)
{
   $done_query = "UPDATE customer_service SET done = '1' WHERE id ='$id'";
   $undone_query = "UPDATE customer_service SET done = '0' WHERE id = '$id'";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");

   if ($action == "done") {
      if (!(mysqli_query($dbc, $done_query))) {
         print("<p>Could not execute query!</p>");
         die(mysqli_error($dbc) . "</body></html>");
      }
   }

   if ($action == "undone") {
      if (!(mysqli_query($dbc, $undone_query))) {
         print("<p>Could not execute query!</p>");
         die(mysqli_error($dbc) . "</body></html>");
      }
   }

   mysqli_close($dbc);
}


//----------------------Nour almatroudi 2190004840 & Hajar Bawazir 2190009128-----------------------------
//Modify products by id (Button in Admin Home - Action in Modify Products)
function products_display_id($dbc, $id)
{

   $query = "SELECT * FROM product WHERE p_id='$id'";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");


   // query Products database
   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error($dbc) . "</body></html>");
   } // end if

   if (mysqli_num_rows($result) > 0) {
      return $result;
   }
   mysqli_close($dbc);
}


//----------------------Sahar Saeed Al-Zahrani	2190003270 -----------------------------
//open database to check the-- Admin authentication --
function Admin_authentication($dbc, $A_id, $A_password)
{
   $query = "select * from admin where admin_id='" . $A_id . "' and Password='" . $A_password . "'";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");


   // query amethyst store database
   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error($dbc) . "</body></html>");
   } // end if
   mysqli_close($dbc);

   return $result;
}


//----------------------Asma Abdullah Al-Hajri 219001399 & Teaf Bashamakh 2190005515-----------------------------
function getData($dbc)
{
   $query = "SELECT *  FROM product";
   $result = mysqli_query($dbc, $query);

   //check the connection with database
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");

   mysqli_close($dbc);

   if (mysqli_num_rows($result) > 0) {
      return $result;
   }
}


//----------------------Wadha Mohammed Alhajri 2190004335-----------------------------
function contact_us($dbc, $Name, $Email, $Msg)
{
   $sql = "INSERT into customer_service (Name,Email,Message) VALUES('" . $Name . "','" . $Email . "','" . $Msg . "')";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");

   if (!(mysqli_query($dbc, $sql))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error());
}else{
      return true;
   }

   mysqli_close($dbc);
   die();
    
}

//----------------------Teaf Bashamakh 2190005515-----------------------------
function updateStock($dbc, $id, $stock)
{
   $query = "UPDATE product SET stock=$stock WHERE p_id=$id";
   $result = mysqli_query($dbc, $query);
   //check the connection with database
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");

   mysqli_close($dbc);


   return $result;
}

//----------------------Waad Alsobi 219003735-----------------------------
function addProduct($ID, $name, $image, $type, $price, $stock, $description, $dbc)
{
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");

   try {
      $query = "INSERT INTO product(p_id, name, picture, category, price, stock, description) VALUES 
		 ('$ID','$name','images/$image','$type','$price','$stock','$description')";
   } catch (mysqli_sql_exception $e) {
      var_dump($e);

      exit;
   }

   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error() . "</body></html>");
   } // end if


   // if (mysqli_num_rows($result) > 0) 
   //  return $result;
   mysqli_close($dbc);
}

function checkID($dbc, $ID)
{
   $query = "SELECT p_id FROM product WHERE p_id = $ID";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");


   // query Products database
   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error() . "</body></html>");
   } // end if

   if (mysqli_num_rows($result) != 0) {
      return 1;
   } else
      return 0;

   mysqli_close($dbc);
}
function checkName($dbc, $name)
{
   $query = "SELECT name FROM product WHERE name = '$name'";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, "amethyst_store"))
      die("Could not open products database </body></html>");


   // query Products database
   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error() . "</body></html>");
   } // end if


   if (mysqli_num_rows($result) != 0) {
      return 1;
   } else
      return 0;

   mysqli_close($dbc);
}


//----------------------Nour almatroudi 2190004840-----------------------------
function modify_product_edit($dbc, $id, $picture, $name, $price, $stock, $descrip, $category)
{

   $query = "UPDATE product SET name='$name',picture='images/$picture',category='$category',price='$price',stock='$stock',description='$descrip' WHERE p_id='$id'";

   // Connect to MySQL 
   if (!($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)))
      die("Could not connect to database </body></html>");

   // open Products database
   if (!mysqli_select_db($dbc, DB_NAME))
      die("Could not open products database </body></html>");

   // query Products database
   if (!($result = mysqli_query($dbc, $query))) {
      print("<p>Could not execute query!</p>");
      die(mysqli_error() . "</body></html>");
   } // end if

   mysqli_close($dbc);
}
