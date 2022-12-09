<?php include_once 'includes/header.php' ?>

    <!-- end header section -->
    <!-- coding aria -->

    <div class="container">
      <form>
        <label for="fname" class="f">First Name :</label><br>
        <input type="text" id="fname" name="firstname" placeholder="Your name" class="f"><br>
    
        <label for="lname" class="f">Last Name :</label><br>
        <input type="text" id="lname" name="lastname" placeholder="Your last name" class="f"><br>

        <label for="bname" class="f">Email :</label><br>
        <input type="email" id="bname" name="email" placeholder="Your email" class="f"><br>

        <label for="cname" class="f">Phone :</label><br>
        <input type="phone" id="cname" name="phone" placeholder="Your phone number" class="f"><br>

        <label for="subject" class="f">Message :</label><br>
        <textarea id="subject" name="subject" placeholder="Write something" style="height:200px" class="f"></textarea><br>
    
        <input type="submit" value="Submit">
        
    
      </form>
    </div>
    <!-- end of coding aria -->
 
    <?php include_once 'includes/footer.php' ?>