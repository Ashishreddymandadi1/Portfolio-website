<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php?redirect_to=videos.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edits</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="videos.css">
    <style>
        .logo{
  display:flex;
}
.logo h2{
  padding-top:7px;
}
    </style>
</head>
<body>
<header>
      <nav class="taskbar">
          <div class="logo">
              <div><img src="logo.png" alt="Logo"></div>
              <div><h2>PORTFOLIO</h2></div>
          </div>
          
          <ul class="nav-links">
            <li><a href="index.php#about">ABOUT</a></li>
            <li class="dropdown"><a href="#photos" class="dropbtn">PHOTOS</a>
              <ul class="dropdown-content">
                <li><a href="gallery.php?category=travel">Travel</a></li>
                <li><a href="gallery.php?category=street">Street</a></li>
                <li><a href="gallery.php?category=commercial">Commercial</a></li>
                <li><a href="gallery.php?category=wildlife">Wildlife</a></li>
                <li><a href="gallery.php?category=event">Event</a></li>
              </ul>
            </li>
            
            <li><a href="beforeafter.php">PRESETS</a></li>
            <li><a href="videos.php">CONTENT</a></li>
            <li><a href="blog.php">BLOGS</a></li>
            <?php if (isset($_COOKIE['username'])): ?>
              <li>Hello, <?php echo htmlspecialchars($_COOKIE['username']); ?> | <a href="logout.php">LOGOUT</a></li>
            <?php else: ?>

            <li><a href="login.php">LOGIN</a></li>
        <?php endif; ?>
        </ul>
      </nav>
    </header>  
    <div class="container">
        <h1>PRESETS</h1>
        <div class="video-container">
            <div class="video"><video src="edits/edit1.mov" muted></video></div>
            <div class="video"><video src="edits/edit2.mov" muted></video></div>
            <div class="video"><video src="edits/edit3.mov" muted></video></div>
            <div class="video"><video src="edits/edit4.mov" muted></video></div>
            <div class="video"><video src="edits/edit5.mov" muted></video></div>
            <div class="video"><video src="edits/edit6.mov" muted></video></div>
            <div class="video"><video src="edits/edit7.mov" muted></video></div>
            <div class="video"><video src="edits/edit8.mov" muted></video></div>
            <div class="video"><video src="edits/edit9.mov" muted></video></div>
            <div class="video"><video src="edits/edit10.mov" muted></video></div>
            <div class="video"><video src="edits/edit11.mov" muted></video></div>
            <div class="video"><video src="edits/edit12.mov" muted></video></div>
            <div class="video"><video src="edits/edit13.mov" muted></video></div>
            <div class="video"><video src="edits/edit14.mov" muted></video></div>
            <div class="video"><video src="edits/edit15.mov" muted></video></div>
            <div class="video"><video src="edits/edit16.mov" muted></video></div>
        </div>

        <div class="popup-video" style="display: none;">
            <span>&times;</span>
            <video muted controls></video>
        </div>
    </div>
    <script>
document.querySelectorAll('.video-container .video').forEach(videoDiv => {
    const video = videoDiv.querySelector('video');

    // On hover: Play video for 3 seconds
    videoDiv.addEventListener('mouseenter', () => {
        video.currentTime = 0; 
        video.play(); 
        setTimeout(() => {
            video.pause(); 
        }, 4000);
    });

    videoDiv.addEventListener('mouseleave', () => {
        video.pause();
        video.currentTime = 0;
    });

    videoDiv.addEventListener('click', () => {
        const popup = document.querySelector('.popup-video');
        popup.style.display = 'block';
        const popupVideo = popup.querySelector('video');
        popupVideo.src = video.getAttribute('src');
        popupVideo.play(); 
    });
});


document.querySelector('.popup-video span').addEventListener('click', () => {
    const popup = document.querySelector('.popup-video');
    const popupVideo = popup.querySelector('video');
    popup.style.display = 'none';
    popupVideo.pause(); 
    popupVideo.src = ""; 
});

    </script>
</body>
</html>

