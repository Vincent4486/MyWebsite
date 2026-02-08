<?php
// Blog post metadata
$blogTitle = 'My First Blog Post';
$blogDate = '2026-02-08';
$formattedDate = date('F j, Y', strtotime($blogDate));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="/assets/icons/WebIcon.png">
  <link rel="stylesheet" href="/style/style.css">
  <title><?php echo htmlspecialchars($translation['title']); ?> | Blog</title>
  <script src="/script/i18n.js" defer></script>
</head>
<body>
  <!-- Language Chooser Section -->
  <div class="language-chooser">
        <label for="language-select" data-i18n="nav.chooseLang">Choose your language:</label>
        <select id="language-select" onchange="changeLanguage()">
        </select>
        <span class="nav-separator">|</span>
        <div class="dropdown">
          <button class="nav-link dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" data-i18n="nav.home">
            Home
          </button>
          <div class="dropdown-menu" role="menu">
            <a href="https://www.vyang.org/index.html" class="dropdown-item" role="menuitem" data-i18n="nav.welcome">Welcome</a>
            <a href="https://www.vyang.org/index.html#contents" class="dropdown-item" role="menuitem" data-i18n="nav.contents">Contents</a>
            <a href="https://www.vyang.org/index.html#news" class="dropdown-item" role="menuitem" data-i18n="nav.news">News</a>
          </div>
        </div>
        <div class="dropdown">
          <button class="nav-link dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" data-i18n="nav.about">
            About
          </button>
          <div class="dropdown-menu" role="menu">
            <a href="https://www.vyang.org/about.html" class="dropdown-item" role="menuitem" data-i18n="nav.aboutMe">About me</a>
            <a href="https://www.vyang.org/coding.html" class="dropdown-item" role="menuitem" data-i18n="nav.coding">Coding</a>
            <a href="https://www.vyang.org/mc_art.html" class="dropdown-item" role="menuitem" data-i18n="nav.mcArt">Minecraft Arts</a>
          </div>
        </div>
        <a href="https://www.vyang.org/contact.html" class="nav-link" data-i18n="nav.contact">Contact</a>
        <a href="/index.php" class="nav-link" data-i18n="nav.blog">Blog</a>
        <a href="https://music.vyang.org" class="nav-link" data-i18n="nav.music">Music</a>
        <a href="https://support.vyang.org" class="nav-link" data-i18n="nav.support">Support</a>
  </div>

    <br>
    
    <!-- Blog Post Content -->
    <article class="blog-post">
        <header class="blog-header">
            <a href="/index.php" class="back-link" data-i18n="blog.backToList">← Back to Blog List</a>
            <h1><?php echo htmlspecialchars($translation['title']); ?></h1>
            <time class="blog-date"><?php echo $formattedDate; ?></time>
        </header>
        
        <div class="blog-content">
            <?php echo $translation['content']; ?>
        </div>
        
        <footer class="blog-footer">
            <a href="/index.php" class="back-link" data-i18n="blog.backToList">← Back to Blog List</a>
        </footer>
    </article>

    <div class="end_section">
        <p data-i18n="blog.footerQuote">The Blogs</p>
        <p class="copyright" data-i18n="footer.copyright">&copy; 2026 Vincent Yang. All rights reserved.</p>
    </div>

    <script>
        // Store language preference in cookie when changed
        function changeLanguage() {
            var select = document.getElementById('language-select');
            var selectedLang = select.value;
            document.cookie = 'preferredLanguage=' + selectedLang + '; path=/; max-age=31536000';
            
            // Trigger the existing i18n language change
            if (window.i18n && window.i18n.load) {
                window.i18n.load(selectedLang);
            }
            
            // Reload page to update PblogTitle
            location.reload();
        }
    </script>
</body>
</html>
blogTitle); ?></h1>
            <time class="blog-date"><?php echo $formattedDate; ?></time>
        </header>
        
        <div class="blog-content">
            <p>Welcome to my first blog post! This is an exciting moment as I start sharing my thoughts and experiences with the world.</p>
            
            <h2>Why Start a Blog?</h2>
            <p>I decided to start this blog to document my journey and share insights about technology, coding, and life in general. Writing helps me organize my thoughts and hopefully provides value to others.</p>
            
            <h2>What to Expect</h2>
            <p>In future posts, you can expect:</p>
            <ul>
                <li>Technical tutorials and coding tips</li>
                <li>Personal reflections and experiences</li>
                <li>Creative projects and experiments</li>
                <li>Updates on my latest work</li>
            </ul>
            
            <h2>Stay Tuned</h2>
            <p>Thank you for reading! More posts are coming soon. Feel free to check back regularly for new content.</p