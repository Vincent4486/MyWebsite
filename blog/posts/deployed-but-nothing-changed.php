<?php
// 1. Load Parsedown
require_once __DIR__ . '/../../lib/Parsedown.php';
$Parsedown = new Parsedown();

// 2. Infer slug from filename
$slug = basename(__FILE__, '.php');

// 3. Load shared blog metadata
$blogs = include __DIR__ . '/../data/blogs.php';

// 4. Find matching blog entry
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
  <div class="language-chooser">
        <label for="language-select" data-i18n="nav.chooseLang">Choose your language:</label>
        <select id="language-select" onchange="changeLanguage()">
        </select>
        <span class="nav-separator">|</span>
        <div class="dropdown">
          <button class="nav-link dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" data-i18n="nav.home">Home</button>
          <div class="dropdown-menu" role="menu">
            <a href="https://www.vyang.org/index.html" class="dropdown-item" role="menuitem" data-i18n="nav.welcome">Welcome</a>
            <a href="https://www.vyang.org/index.html#contents" class="dropdown-item" role="menuitem" data-i18n="nav.contents">Contents</a>
            <a href="https://www.vyang.org/index.html#news" class="dropdown-item" role="menuitem" data-i18n="nav.news">News</a>
          </div>
        </div>
        <div class="dropdown">
          <button class="nav-link dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" data-i18n="nav.about">About</button>
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

    <article class="blog-post">
        <header class="blog-header">
            <div>
                <div class="blog-actions-back">
                    <a href="/index.php" class="back-link" data-i18n="blog.backToList">← Back to Blog List</a>
                </div>
                <div class="blog-actions-coffee">
                    <a href="https://buymeacoffee.com/vincentyang" class="read-more" style="font-style: italic;">Support via Buy Me a Coffee →</a>
                </div>
            </div>
            <h1><?php echo htmlspecialchars($blogTitle); ?></h1>
            <time class="blog-date"><?php echo $formattedDate; ?></time>
        </header>
        
        <div class="blog-content">
            <?php
            // Look for the .md file in the data/posts folder
            $mdFilePath = __DIR__ . "/../../data/posts/{$slug}.md";

            if (file_exists($mdFilePath)) {
                $markdown = file_get_contents($mdFilePath);
                // Parsedown converts MD to HTML that inherits your .blog-content CSS
                echo $Parsedown->text($markdown);
            } else {
                echo "<p><em>Error: Content file for '{$slug}' not found.</em></p>";
            }
            ?>
        </div>
        
        <footer class="blog-footer">
            <div class="blog-footer-div">
                <div class="blog-actions-back">
                    <a href="/index.php" class="back-link" data-i18n="blog.backToList">← Back to Blog List</a>
                </div>
                <div class="blog-actions-coffee">
                    <a href="https://support.vyang.org" class="read-more" style="font-style: italic;">More ways to support →</a>
                </div>
            </div>
        </footer>
    </article>

    <div class="end_section">
        <p data-i18n="blog.footerQuote">The Blogs</p>
        <p class="copyright" data-i18n="footer.copyright">&copy; 2026 Vincent Yang. All rights reserved.</p>
    </div>

    <script>
        function changeLanguage() {
            var select = document.getElementById('language-select');
            var selectedLang = select.value;
            document.cookie = 'preferredLanguage=' + selectedLang + '; path=/; max-age=31536000';
            if (window.i18n && window.i18n.load) {
                window.i18n.load(selectedLang);
            }
            location.reload();
        }
    </script>
</body>
</html>