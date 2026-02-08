<?php
// Load blog posts data
$blogs = include __DIR__ . '/data/blogs.php';

// Sort blogs by date (newest first)
usort($blogs, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="/assets/icons/WebIcon.png">
  <link rel="stylesheet" href="/style/style.css">
  <title data-i18n="blog.title">Blog | English</title>
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
    <h1 data-i18n="blog.heading">Blogs</h1>
   
    <!-- Blog Posts List -->
    <div class="blog-list">
        <?php foreach ($blogs as $blog): ?>
            <?php 
                $formattedDate = date('F j, Y', strtotime($blog['date']));
            ?>
            <article class="blog-post-preview">
                <h2>
                <span class="blog-title">
                    <?php echo htmlspecialchars($blog['title']); ?>
                </span>
                </h2>
                <time class="blog-date"><?php echo $formattedDate; ?></time>
                <p class="blog-excerpt"><?php echo htmlspecialchars($blog['excerpt']); ?></p>
                <a href="/posts/<?php echo htmlspecialchars($blog['slug']); ?>.php" class="read-more" data-i18n="blog.readMore">Read More →</a>
            </article>
        <?php endforeach; ?>
    </div>

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
            
            // Reload page to update PHP content
            location.reload();
        }
    </script>
</body>
</html>
