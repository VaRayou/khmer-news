<?php
include 'data/news.php';
include 'includes/functions.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container">

    <!-- MAIN NEWS -->
    <div class="top-news">

        <!-- LEFT BIG NEWS -->
        <div class="big-news">

            <a href="content.php?id=<?php echo $news[0]['id']; ?>" class="feature-link">

                <img src="<?php echo $news[0]['image']; ?>">

                <div class="overlay">

                    <span class="tag">
                        <?php echo $news[0]['category']; ?>
                    </span>

                    <h1>
                        <?php echo $news[0]['title']; ?>
                    </h1>

                    <p>
                        <?php echo $news[0]['summary']; ?>
                    </p>

                    <small>
                        <?php echo $news[0]['author']; ?> | <?php echo formatDate($news[0]['date']); ?>
                    </small>

                </div>

            </a>

        </div>

        <!-- RIGHT NEWS -->
        <div class="side-news">

            <?php for($i=1; $i<min(3, count($news)); $i++): ?>

                <div class="card-news">

                    <a href="content.php?id=<?php echo $news[$i]['id']; ?>" class="card-link">

                        <img src="<?php echo $news[$i]['image']; ?>">

                        <div class="overlay-small">

                            <span class="tag">
                                <?php echo $news[$i]['category']; ?>
                            </span>

                            <h2>

                                <?php echo $news[$i]['title']; ?>

                            </h2>

                            <small>
                                <?php echo formatDate($news[$i]['date']); ?>
                            </small>

                        </div>

                    </a>

                </div>

            <?php endfor; ?>

        </div>

    </div>

    <!-- CATEGORY SECTION -->
    <div class="section-title">

        <span>ព័ត៌មានថ្មី</span>

    </div>

    <div class="news-grid">

        <?php foreach($news as $item): ?>

            <div class="grid-card">

                <a href="content.php?id=<?php echo $item['id']; ?>" class="grid-card-link">

                    <img src="<?php echo $item['image']; ?>">

                    <div class="grid-content">

                        <small>
                            <?php echo $item['category']; ?> | <?php echo formatDate($item['date']); ?>
                        </small>

                        <h3>

                            <?php echo $item['title']; ?>

                        </h3>

                        <p>
                            <?php echo $item['summary']; ?>
                        </p>

                    </div>

                </a>

            </div>

        <?php endforeach; ?>

    </div>

</div>

<?php

 include 'includes/footer.php'; 
 
 ?>
