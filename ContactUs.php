<!DOCTYPE html>
<html lang="en">
    <head>
         <title> Contact Us | Page </title>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="Draft.css">
                <script src="JV.js"></script>

    </head>
    <body>
        
    <?php include 'header.php'; ?>

    <section class="banner">
        <div class="bat35">
<h1 style="text-align:center;">Contact Us</h1>
<br>
        <div id="content">
        <div id="left"><h2 style="text-align: left; color: black">
            &emsp; Send us a message</h2> <br> &emsp;
            <div class="contactus-form">
                          <form class="contact" action="fill" method="post">
                              <input type="text" name="name" class="text-box" placeholder="Your Full Name" required>
                              <input type="email" name="email" class="text-box" placeholder="Your Email Address" required>
                              <input type="number" name="number" class="text-box" placeholder="Your Phone Number" required> &emsp;
                              <textarea name="text" rows="5"  placeholder="Send us a message..." required></textarea>
                              <input type="submit" name="submit" class="sendbtnn" value="submit">
                </form>
            </div>
            


</div>
             <div id="right"><h2 style="text-align: center; color: black">&emsp; Contact Information</h2><br><hr class="hori"><br><br><i class="fa-solid fa-location-dot"> </i>&emsp;&emsp; Location<br><br><br><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&emsp;&emsp;&emsp; Mail<br><br><br>&emsp;&emsp;&emsp;<i class="fa-solid fa-phone"> </i>&emsp; Phone Number
  <br> <br> <hr class="hori"> <br> <br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 
                 
<a style="font-size: 25px; color: black; " href="https://www.twitter.com"><i class="fab fa-facebook-f"></i></a>&emsp;
<a style="font-size: 25px; color: black; padding-left: 50px;" href="https://www.facebook.com"><i class="fab fa-twitter"></i></a>&emsp;
<a style="font-size: 25px; color: black; padding-left: 50px;" href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                </div>
        <div id="bottom"></div>
      </div>
        </div>
    </section>

        
    <div class="wrapper" style="height:700px;">
    </div>
        

            <hr style="width: auto">

            <?php include 'footer.php'; ?>

        
    </body>    
</html>