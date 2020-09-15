<?php
include("includes/header.php");
?>

        <div class="user-info">
            <div class="user-info-profile-pic-container">
                <a href=""> <img class="user-info-profile-pic" src="<?php echo $user['profile_pic']; ?>" alt="profile_picture"> </a>
            </div>
            <div class="user-info-info">
            <?php echo $user['first_name'] ." ". $user['last_name']; ?><br>
            Posts: 0<br>
            Bumps: 0
            </div>
            
        </div>

        <div class="feed">Feed</div>
        <div class="hashtags">Hashtags</div>


    </div>
</body>
</html>