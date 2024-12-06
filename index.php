<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ashish Reddy</title>
        <link rel="stylesheet" href="https://use.typekit.net/your-font-kit-id.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="styles.css">
        <style>
          .hero {
    height: 100vh;
    background: url('pic4.jpg') center/cover no-repeat fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #ffffff;
    text-align: center;
    position: relative;
}
.captured-moments h2 {
  font-size: 2.5rem;
  margin-bottom: 20px;
  color: #ffffff;
  font-size: 40px;
  font-family: Helvetica, sans-serif;
  font-weight: bold;
}
.hero-text {
    /* background: rgba(0, 0, 0, 0.5); */
    padding: 20px;
    border-radius: 10px;
}
          .classa {
  color: inherit; 
  text-decoration: none; 
  cursor: pointer; 
  height: 400px;
}

.classa:hover {
  text-decoration: none; 
  color: inherit; 
}
.social-icons{
	padding:30px;
	background-color:black;
  text-align: center;
}
.social-icons a{
	color:#fff;
  line-height:30px;
  font-size:30px;
  margin: 0 5px;
  text-decoration:none;
  
}
.social-icons a i{
	line-height:30px;
  font-size:30px;
  -webkit-transition: all 200ms ease-in;
  -webkit-transform: scale(1); 
  -ms-transition: all 200ms ease-in;
  -ms-transform: scale(1); 
  -moz-transition: all 200ms ease-in;
  -moz-transform: scale(1);
  transition: all 200ms ease-in;
  transform: scale(1);
}
.social-icons a:hover i{
  box-shadow: 0px 0px 150px #000000;
  z-index: 2;
  -webkit-transition: all 200ms ease-in;
  -webkit-transform: scale(1.5);
  -ms-transition: all 200ms ease-in;
  -ms-transform: scale(1.5);   
  -moz-transition: all 200ms ease-in;
  -moz-transform: scale(1.5);
  transition: all 200ms ease-in;
  transform: scale(1.5);
}
#video-highlight {
    background: #121212;
    color: #fff;
    padding: 60px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 30px;
}

.video-section-wrapper {
    display: flex;
    align-items: center;
    gap: 40px;
    max-width: 1200px;
    margin: auto;
}

.video-content {
    flex: 1;
    max-width: 500px;
    text-align: left;
}

.video-content h2 {
    font-size: 2.8rem;
    margin-bottom: 15px;
    color: #ff6f61;
    font-weight: bold;
}

.video-content p {
    font-size: 1.2rem;
    margin-bottom: 20px;
    color: #e0e0e0;
}

.video-content .cta-button {
    padding: 12px 30px;
    font-size: 1.1rem;
    color: #fff;
    background: #ff6f61;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s ease;
    display: inline-block;
}

.video-content .cta-button:hover {
    background: #ff4a3b;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 75, 59, 0.4);
}

.video-preview {
    flex: 1;
    max-width: 500px;
}

.video-preview img {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
}
.logo{
  display:flex;
}
.logo h2{
  padding-top:7px;
}
.cards main {
            display: flex;
            justify-content: center;
            padding: 50px;
            gap: 2rem; /* Space between cards */
            font-family: 'Roboto', sans-serif;
        }
        
        .cards .card {
            width: 24rem;
            height: 31rem;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            color: rgb(240, 240, 240);
            box-shadow: 0 10px 30px 5px rgba(0, 0, 0, 0.2);
        }

        .cards .card img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0.9;
            transition: opacity 0.2s ease-out;
        }

        .cards .card h2 {
            position: absolute;
            inset: auto auto 30px 30px;
            margin: 0;
            transition: inset 0.3s 0.3s ease-out;
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: bold;
            text-transform: uppercase;
        }

        .cards .card p, 
        .card a {
            position: absolute;
            opacity: 0;
            max-width: 80%;
            transition: opacity 0.3s ease-out;
        }

        .cards .card p {
            inset: auto auto 80px 30px;
        }

        .cards .card a {
            inset: auto auto 40px 30px;
            color: inherit;
            text-decoration: none;
        }

        .cards .card:hover h2 {
            inset: auto auto 220px 30px;
            transition: inset 0.3s ease-out;
        }

        .cards .card:hover p,
        .card:hover a {
            opacity: 1;
            transition: opacity 0.5s 0.1s ease-in;
        }

        .cards .card:hover img {
            transition: opacity 0.3s ease-in;
            opacity: 1;
        }

        .material-symbols-outlined {
            vertical-align: middle;
        }
        
.before-after-section {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
    background: #121212;
    color: #fff;
    overflow: hidden;
}

.split-container {
    display: flex;
    width: 90%;
    max-width: 1200px;
    height: 400px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
}

.split {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: flex 0.3s ease;
    overflow: hidden;
}

.split:hover {
    flex: 1.5;
}

.split:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-size: cover;
    background-position: center;
    transition: opacity 0.3s ease;
    opacity: 0.7;
}

.before-section:before {
    background-image: url('images/before.png');
}

.after-section:before {
    background-image: url('images/after.png');
}

.split-content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 20px;
    color: #fff;
    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    opacity: 0.9;
}

.split-content h2 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    text-transform: uppercase;
    font-weight: bold;
    letter-spacing: 1.5px;
    color: #f4f4f4;
}

.split-content p {
    font-size: 1rem;
    line-height: 1.6;
    color: #ddd;
}

.split:hover:before {
    opacity: 1;
}

.explore-link {
    margin-top: 30px;
}

.btn-explore {
    display: inline-block;
    padding: 12px 30px;
    font-size: 1.1rem;
    font-weight: bold;
    color: #fff;
    background: #ff6f61;
    border-radius: 25px;
    text-transform: uppercase;
    text-decoration: none;
    transition: background 0.3s ease, transform 0.2s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.btn-explore:hover {
    background: linear-gradient(135deg, #ff6f62, #ff6f61);
    transform: scale(1.1);
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
            <li><a href="#about">ABOUT</a></li>
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

    <section class="hero">
      
  </section>

  <section id="about" class="about-section">
      <div class="about-card">
          <img src="aboutme1.jpg" alt="My Photo" class="about-photo">
          <div class="about-content">
              <h2>About Me</h2>
              <p>Hi, I'm Ashish Reddy. I am passionate about photography and videography, which I have been learning and exploring for the past four years. </p>
              <p>Alongside capturing visuals, I have been practicing editing to enhance and refine my work. This portfolio showcases my creative journey, featuring a collection of my projects and before-and-after image samples.</p>
              <p> It reflects my dedication to continuously improving my skills and storytelling through visuals. I believe in the power of imagery to convey emotions and narratives effectively.</p>
          </div>
      </div>
  </section>


  
  <div class="cards">
  <div class="captured-moments">
    <h2>Stories in Frames..</h2>
  </div>
    <main>
        <div class="card">
            <img src="images/travel9.jpg" alt="">
            <div class="card-content">
                <h2>TRAVEL SERIES</h2>
                <p>Journey through untamed landscapes and vibrant cultures, 
                    where every frame is a postcard from an adventure waiting to be relived.</p>
                <a href="gallery.php?category=travel" class="button">Find out more</a>
            </div>
        </div>
        <div class="card">
            <img src="images/street5.jpg" alt="">
            <div class="card-content">
                <h2>STREET SERIES</h2>
                <p>The heartbeat of the city captured in fleeting 
                    moments—ordinary streets, extraordinary stories.</p>
                <a href="gallery.php?category=street" class="button">Find out more </a>
            </div>
        </div>
        <div class="card">
            <img src="images/wildlife5.jpg" alt="">
            <div class="card-content">
                <h2>WILDLIFE SERIES</h2>
                <p>A raw, untamed glimpse into the beauty of nature, 
                    where every frame captures the essence of the wild, untouched and free.</p>
                <a href="gallery.php?category=wildlife" class="button">Find out more</a>
            </div>
        </div>
        <div class="card">
            <img src="images/event38.jpg" alt="">
            <div class="card-content">
                <h2>EVENT SERIES</h2>
                <p>Every celebration, every emotion, immortalized in frames 
                    that let you relive the magic over and over again.</p>
                <a href="gallery.php?category=event" class="button">Find out more </a>
            </div>
        </div>
    </main>
</div>
<br><br>

  <section id="video-highlight">
    <div class="video-section-wrapper">
        <div class="video-content">
            <h2>Unveil the Magic of Motion</h2>
            <p>Experience creativity in motion with our curated video collection. Click below to explore!</p>
            <a href="videos.php" class="cta-button">Watch Now</a>
        </div>
        <div class="video-preview">
            <img src="images/videopreview1.jpg" alt="Video Preview">
        </div>
    </div>
</section>



  <section class="blog-section">
    <h2>Join the Conversation</h2>
    <p>Share your experiences, thoughts, and creativity with the world. View others' blogs or start creating your own.</p>
    <a href="blog.php" class="blog-link">Visit the Blog</a>
</section>
  <section id="before-after" class="before-after-section">
    <div class="split-container">
        <div class="split before-section">
            <div class="split-content">
                <h2>Before</h2>
                <p>See the raw, untouched moments before the magic happens.</p>
            </div>
        </div>
        <div class="split after-section">
            <div class="split-content">
                <h2>After</h2>
                <p>Witness the stunning transformation after the edit.</p>
            </div>
        </div>
    </div>
    <div class="explore-link">
        <a href="beforeafter.php" class="btn-explore">Explore Before & After</a>
    </div>
</section>


  <section id="contact">

  <div class="social-icons">
  <a href="#"  title="facebook"> <i class="fa fa-facebook-square" aria-hidden="true"></i></a>
  <a href="#" title="twitter"> <i class="fa fa-twitter-square" aria-hidden="true"></i></a>
  <a href="#" title="instagram">  <i class="fa fa-instagram" aria-hidden="true"></i></a>
  <a href="#" title="youtube"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
  <a href="#" title="linkedin"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
  <a href="#" title="pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
  <a href="#" title="camera"><i class="fa fa-camera-retro" aria-hidden="true"></i></a>
</div>
  </section>
  </body>
</html>