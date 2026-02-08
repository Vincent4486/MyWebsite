<?php
// Infer slug from filename (e.g., posts/my-post.php => my-post)
$slug = basename(__FILE__, '.php');

// Load shared blog metadata
$blogs = include __DIR__ . '/../data/blogs.php';

// Find matching blog entry
$blogMeta = null;
foreach ($blogs as $b) {
  if ($b['slug'] === $slug) {
    $blogMeta = $b;
    break;
  }
}

// Fallback if not found
if (!$blogMeta) {
  $blogMeta = [
    'title' => 'Untitled Blog',
    'date' => date('Y-m-d'),
  ];
}

$blogTitle = $blogMeta['title'];
$blogDate = $blogMeta['date'];
$formattedDate = date('F j, Y', strtotime($blogDate));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="/assets/icons/WebIcon.png">
  <link rel="stylesheet" href="/style/style.css">
  <title><?php echo htmlspecialchars($blogTitle); ?> | Blog</title>
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
            <div class="blog-actions">
                <a href="/index.php" class="back-link" data-i18n="blog.backToList">← Back to Blog List</a>
                <a href="https://www.buymeacoffee.com/vincentyang" class="buy-coffee-link"><img src="https://img.buymeacoffee.com/button-api/?text=Buy me a coffee&emoji=&slug=vincentyang&button_colour=FFDD00&font_colour=000000&font_family=Cookie&outline_colour=000000&coffee_colour=ffffff" /></a>
            </div>
            <h1><?php echo htmlspecialchars($blogTitle); ?></h1>
            <time class="blog-date"><?php echo $formattedDate; ?></time>
        </header>
        
        <div class="blog-content">
            <!-- 
                Write your blog content here in HTML.
                You can use:
                - <p> for paragraphs
                - <h2>, <h3> for subheadings
                - <ul><li> for bullet lists
                - <ol><li> for numbered lists
                - <strong> for bold text
                - <em> for italic text
                - <a href="..."> for links
                - <img src="..." alt="..."> for images
                - <code> for inline code
                - <pre><code> for code blocks
            -->
            
            <p>Your introduction paragraph goes here...</p>
            
            <h2>First Section</h2>
            <p>Content for the first section...</p>
            
            <h2>Second Section</h2>
            <p>Content for the second section...</p>
            
            <h2>Conclusion</h2>
            <p>Your closing thoughts...</p>
        </div>
        
        <footer class="blog-footer">
            <div class="blog-actions">
                <a href="/index.php" class="back-link" data-i18n="blog.backToList">← Back to Blog List</a>
                <a href="https://www.buymeacoffee.com/vincentyang" class="buy-coffee-link"><img src="https://img.buymeacoffee.com/button-api/?text=Buy me a coffee&emoji=&slug=vincentyang&button_colour=FFDD00&font_colour=000000&font_family=Cookie&outline_colour=000000&coffee_colour=ffffff" /></a>
            </div>
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
            
            // Reload page to update PHP content
            location.reload();
        }
    </script>
</body>
</html>
