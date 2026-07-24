<?php
function getNews()
{
    $news = require __DIR__ . '/../data/news.php';

    return is_array($news) ? $news : [];
}

function findNewsById(array $news, int $id)
{
    foreach ($news as $item) {
        if ($item['id'] === $id) {
            return $item;
        }
    }
    return null;
}

function getNewsByCategory(array $news, string $category)
{
    return array_filter($news, function ($item) use ($category) {
        return strcasecmp($item['category'], $category) === 0;
    });
}

function searchNews(array $news, string $query)
{
    $query = trim(mb_strtolower($query));

    if ($query === '') {
        return [];
    }

    return array_filter($news, function ($item) use ($query) {
        $title = mb_strtolower($item['title']);
        $category = mb_strtolower($item['category']);
        $summary = mb_strtolower($item['summary'] ?? '');

        return str_contains($title, $query)
            || str_contains($category, $query)
            || str_contains($summary, $query);
    });
}

function formatDate(string $date)
{
    return date('M d, Y', strtotime($date));
}
