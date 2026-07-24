<?php
include 'data/news.php';
include 'includes/functions.php';
include 'includes/header.php';
include 'includes/navbar.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$item = findNewsById($news, $id);
$currentIndex = null;

foreach ($news as $index => $newsItem) {
    if ($newsItem['id'] === $id) {
        $currentIndex = $index;
        break;
    }
}

if (!$item):
?>

<div class="content-page">
    <h1>អត្ថបទមិនមាន</h1>
    <p>Sorry, the requested article was not found.</p>
</div>

<?php else: ?>

<div class="content-page">

    <img src="<?php echo $item['image']; ?>">

    <h1>
        <?php echo $item['title']; ?>
    </h1>

    <p>
        Category:
        <?php echo $item['category']; ?>

        |

        Author:
        <?php echo $item['author']; ?>

        |

        Published:
        <?php echo formatDate($item['date']); ?>
    </p>

    <p class="article-summary">
        <?php echo $item['summary']; ?>
    </p>

    <div class="text">
        <?php echo $item['content']; ?>
    </div>

    <?php if ($currentIndex !== null): ?>
        <?php
            $previous = $news[$currentIndex - 1] ?? null;
            $next = $news[$currentIndex + 1] ?? null;
        ?>

        <div class="article-nav">

            <?php if ($previous): ?>
                <a href="content.php?id=<?php echo $previous['id']; ?>">
                    &larr; <?php echo $previous['title']; ?>
                </a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>

            <?php if ($next): ?>
                <a href="content.php?id=<?php echo $next['id']; ?>">
                    <?php echo $next['title']; ?> &rarr;
                </a>
            <?php endif; ?>

        </div>
    <?php endif; ?>

</div>

<?php endif; ?>

<?php include 'includes/footer.php'; ?>
