<?php
include 'data/news.php';
include 'includes/functions.php';
include 'includes/header.php';
include 'includes/navbar.php';

$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = searchNews($news, $query);
?>

<div class="category-page">
    
    <h1>Search Results</h1>

    <?php if ($query === ''): ?>
        <p>Please enter a keyword to search news.</p>
    <?php else: ?>
        <p class="results-count">
            Found <?php echo count($results); ?> result(s) for "<?php echo htmlspecialchars($query, ENT_QUOTES, 'UTF-8'); ?>"
        </p>

        <?php if (empty($results)): ?>
            <p>No news matched your search.</p>
        <?php else: ?>
            <?php foreach($results as $item): ?>
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
                            <?php echo $item['category']; ?> | <?php echo $item['author']; ?> | <?php echo formatDate($item['date']); ?>
                        </small>

                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
