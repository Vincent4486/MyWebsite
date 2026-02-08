<?php
/**
 * Blog posts data structure
 * 
 * Each blog entry should have:
 * - slug: URL-friendly identifier (used in the URL)
 * - date: Publication date
 * - translations: Array of translated titles and excerpts for each language
 */

return [
    [
        'slug' => 'first-blog-post',
        'date' => '2026-02-08',
        'translations' => [
            'en-us' => [
                'title' => 'My First Blog Post',
                'excerpt' => 'This is my very first blog post. Welcome to my blog!'
            ],
            'zh-cn' => [
                'title' => '我的第一篇博客',
                'excerpt' => '这是我的第一篇博客文章。欢迎来到我的博客！'
            ],
            'ja-jp' => [
                'title' => '最初のブログ投稿',
                'excerpt' => 'これは私の最初のブログ投稿です。私のブログへようこそ！'
            ]
        ]
    ],
    [
        'slug' => 'welcome-to-2026',
        'date' => '2026-02-01',
        'translations' => [
            'en-us' => [
                'title' => 'Welcome to 2026',
                'excerpt' => 'A new year brings new opportunities and experiences.'
            ],
            'zh-cn' => [
                'title' => '欢迎来到2026年',
                'excerpt' => '新的一年带来新的机遇和体验。'
            ],
            'ja-jp' => [
                'title' => '2026年へようこそ',
                'excerpt' => '新しい年は新しい機会と経験をもたらします。'
            ]
        ]
    ]
    // Add more blog posts here
];
