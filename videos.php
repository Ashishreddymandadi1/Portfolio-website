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
      .container .horizontal-video .video{
    margin: 50px;
}
  .container .horizontal-video {
    width: 100%;
    margin-bottom: 20px; 
    position: relative;
    /* border: 2px solid #fff; */
    
}

.container .horizontal-video video {
    width: 100%;
    height: auto;
    border: 2px solid #fff;
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.7);
    cursor: pointer;
    transition: transform 0.3s ease;
}

.container .horizontal-video video:hover {
    transform: scale(1.02); 
}
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
        <h1>CONTENT WORK</h1>
        
    <div class="horizontal-video">
        <div class="video"><video src="images/video7.mp4" muted></video></div>
    </div>

    <div class="video-container">
        <div class="video"><video src="images/video1.mp4" muted></video></div>
        <div class="video"><video src="images/video2.mp4" muted></video></div>
        <div class="video"><video src="images/video3.mp4" muted></video></div>
        <div class="video"><video src="images/video4.mp4" muted></video></div>
        <div class="video"><video src="images/video5.mp4" muted></video></div>
        <div class="video"><video src="images/video6.mp4" muted></video></div>
    </div>

    <div class="popup-video" style="display: none;">
        <span>&times;</span>
        <video muted controls></video>
    </div>
</div>

    </div>
    <script>
const horizontalVideo = document.querySelector('.horizontal-video video');

horizontalVideo.addEventListener('mouseenter', () => {
    horizontalVideo.currentTime = 0; 
    horizontalVideo.play(); 
    setTimeout(() => {
        horizontalVideo.pause(); 
    }, 3000);
});

horizontalVideo.addEventListener('mouseleave', () => {
    horizontalVideo.pause(); 
    horizontalVideo.currentTime = 0; 
});

horizontalVideo.addEventListener('click', () => {
    const popup = document.querySelector('.popup-video');
    popup.style.display = 'block';
    const popupVideo = popup.querySelector('video');
    popupVideo.src = horizontalVideo.getAttribute('src');
    popupVideo.play(); 
});

document.querySelectorAll('.video-container .video').forEach(videoDiv => {
    const video = videoDiv.querySelector('video');

    videoDiv.addEventListener('mouseenter', () => {
        video.currentTime = 0;
        video.play();
        setTimeout(() => {
            video.pause();
        }, 3000);
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

