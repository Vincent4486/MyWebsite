<?php
// 1. Logic to fetch metadata
$slug = basename(__FILE__, '.php');
$blogs = include __DIR__ . '/../data/blogs.php';

$blogMeta = null;
foreach ($blogs as $b) {
  if ($b['slug'] === $slug) {
    $blogMeta = $b;
    break;
  }
}

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
        <select id="language-select" onchange="changeLanguage()"></select>
        <span class="nav-separator">|</span>
        <div class="dropdown">
          <button class="nav-link dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" data-i18n="nav.home">Home</button>
          <div class="dropdown-menu" role="menu">
            <a href="https://www.vyang.org/index.html" class="dropdown-item" role="menuitem" data-i18n="nav.welcome">Welcome</a>
            <a href="https://www.vyang.org/index.html#contents" class="dropdown-item" role="menuitem" data-i18n="nav.contents">Contents</a>
          </div>
        </div>
        <a href="https://www.vyang.org/about.html" class="nav-link" data-i18n="nav.about">About</a>
        <a href="/index.php" class="nav-link" data-i18n="nav.blog">Blog</a>
        <a href="https://support.vyang.org" class="nav-link" data-i18n="nav.support">Support</a>
  </div>

    <article class="blog-post">
        <header class="blog-header">
            <div class="header-top-row">
                <div class="blog-actions-back">
                    <a href="/index.php" class="back-link" data-i18n="blog.backToList">← Back to Blog List</a>
                </div>
                <div class="blog-actions-coffee">
                    <a href="https://buymeacoffee.com/vincentyang" class="buy-coffee-link">
                        <img src="https://img.buymeacoffee.com/button-api/?text=Buy me a coffee&emoji=&slug=vincentyang&button_colour=FFDD00&font_colour=000000&font_family=Cookie&outline_colour=000000&coffee_colour=ffffff" alt="Buy me a coffee" />
                    </a>
                </div>
            </div>
            <h1><?php echo htmlspecialchars($blogTitle); ?></h1>
            <time class="blog-date"><?php echo $formattedDate; ?></time>
        </header>
        
        <div class="blog-content">
            <p>Your introduction goes here...</p>

            <h2>Technical Deep Dive</h2>
            <p>Code and logic explanation...</p>
            
            <section class="newsletter-box">
                <h3 data-i18n="blog.subscribeTitle">Stay in the Loop</h3>
                <p data-i18n="blog.subscribeDesc">I send out updates on kernel safety and web engineering once a week.</p>
                <form action="YOUR_NEWSLETTER_FORM_URL" method="post" class="newsletter-form">
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <button type="submit" data-i18n="blog.subscribeBtn">Join the List</button>
                </form>
            </section>

            <div class="support-banner">
                <p data-i18n="blog.supportText">Found this helpful? Visit my <a href="https://support.vyang.org">Support Page</a> for more ways to help this project.</p>
            </div>
        </div>
        
        <footer class="blog-footer">
            <div class="blog-footer-div">
                <div class="blog-actions-back">
                    <a href="/index.php" class="back-link" data-i18n="blog.backToList">← Back to Blog List</a>
                </div>
                <div class="blog-actions-coffee">
                    <a href="https://buymeacoffee.com/vincentyang" class="buy-coffee-link">
                        <img src="https://img.buymeacoffee.com/button-api/?text=Buy me a coffee&emoji=&slug=vincentyang&button_colour=FFDD00&font_colour=000000&font_family=Cookie&outline_colour=000000&coffee_colour=ffffff" alt="Buy me a coffee" />
                    </a>
                </div>
            </div>
        </footer>
    </article>

    <div class="end_section">
        <p class="copyright" data-i18n="footer.copyright">&copy; 2026 Vincent Yang. All rights reserved.</p>
    </div>

    <script>
        function changeLanguage() {
            var select = document.getElementById('language-select');
            var selectedLang = select.value;
            document.cookie = 'preferredLanguage=' + selectedLang + '; path=/; max-age=31536000';
            location.reload();
        }
    </script>
</body>
</html>