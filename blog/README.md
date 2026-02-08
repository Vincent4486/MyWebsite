# Blog System - How to Add a New Post

## Structure

Your blog is now PHP-based with the following structure:

```
blog/
├── .htaccess              # PHP routing / index fallback
├── index.php              # Main blog listing page
├── data/
│   └── blogs.php          # Blog posts metadata (titles/excerpts)
├── posts/
│   ├── _template.php      # Template for new posts
│   ├── first-blog-post.php
│   └── welcome-to-2026.php
├── locales/               # Translation files for UI labels
├── script/
│   └── i18n.js
└── style/
    └── style.css
```

## Adding a New Blog Post

### Step 1: Create the Blog Post File

1. Copy `/posts/_template.php` to a new file in the `/posts/` directory
2. Name it with a URL-friendly slug (e.g., `my-awesome-post.php`)
3. Edit the metadata at the top:
   ```php
   $blogTitle = 'Your Blog Title';
   $blogDate = '2026-02-08'; // YYYY-MM-DD format
   ```
4. Write your content in the `blog-content` div using HTML

### Step 2: Add to the Blog Index

Open `/data/blogs.php` and add a new entry to the array:

```php
[
    'slug' => 'my-awesome-post',  // Must match your filename (without .php)
    'date' => '2026-02-08',
    'translations' => [
        'en-us' => [
            'title' => 'My Awesome Post',
            'excerpt' => 'A brief description of what this post is about.'
        ],
        'zh-cn' => [
            'title' => '我的精彩文章',
            'excerpt' => '关于这篇文章的简要描述。'
        ],
        'ja-jp' => [
            'title' => '素晴らしい投稿',
            'excerpt' => 'この投稿についての簡単な説明。'
        ]
    ]
]
```

**Note:** Blog post content itself is English-only. Translations in `blogs.php` are only for:
- The title shown in the blog listing (index.php)
- The excerpt/preview shown in the blog listing

### Step 3: Test Your Post

1. Make sure your web server supports PHP
2. Visit `http://your-domain/blog/index.php` to see the listing
3. Click on your new post to view it

## Tips

- Use semantic HTML in your blog posts (h2, h3, p, ul, ol, etc.)
- Keep slug names lowercase with hyphens (e.g., `spring-boot-tutorial`)
- Blog posts are sorted by date (newest first) automatically
- The full blog post content is in English; only listing titles/excerpts are translated

## Example Workflow

1. Copy `_template.php` → `learning-php.php`
2. Edit `learning-php.php` with your title, date, and content
3. Add entry to `data/blogs.php`:
   ```php
   [
       'slug' => 'learning-php',
       'date' => '2026-02-10',
       'translations' => [
           'en-us' => [
               'title' => 'Learning PHP in 2026',
               'excerpt' => 'My journey into PHP development.'
           ],
           'zh-cn' => [
               'title' => '2026年学习PHP',
               'excerpt' => '我的PHP开发之旅。'
           ],
           'ja-jp' => [
               'title' => '2026年にPHPを学ぶ',
               'excerpt' => 'PHP開発への私の旅。'
           ]
       ]
   ]
   ```
4. Done! Your post will appear on the blog listing page.
