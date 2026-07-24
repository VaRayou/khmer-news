<?php
include 'data/news.php';
include 'includes/functions.php';
include 'includes/header.php';
include 'includes/navbar.php';

$category = isset($_GET['name']) ? trim($_GET['name']) : '';
$categoryNews = $category ? getNewsByCategory($news, $category) : [];
?>

<div class="category-page">
    <?php if (!$category): ?>
        <h1>Category not selected</h1>
        <p>Please choose a category from the menu.</p>
    <?php else: ?>
        <h1><?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?></h1>

        <?php if (empty($categoryNews)): ?>
            <p>No news found for this category.</p>
        <?php else: ?>
            <?php foreach($categoryNews as $item): ?>
                <div class="category-news">

                    <a href="content.php?id=<?php echo $item['id']; ?>" class="category-image">
                        <img src="<?php echo $item['image']; ?>">
                    </a>

                    <div>

                        <h2>
                            <a href="content.php?id=<?php echo $item['id']; ?>">
                                <?php echo $item['title']; ?>
                            </a>
                        </h2>

                        <p>
                            <?php echo $item['summary']; ?>
                        </p>

                        <small>
                            <?php echo $item['author']; ?> | <?php echo formatDate($item['date']); ?>
                        </small>

                        <p>
                            <a class="read-more" href="content.php?id=<?php echo $item['id']; ?>">Read more</a>
                        </p>

                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
