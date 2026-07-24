<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$currentCategory = isset($_GET['name']) ? trim($_GET['name']) : '';

$menuItems = [
    [
        'label' => 'ព័ត៌មានជាតិ',
        'href' => 'index.php',
        'active' => $currentPage === 'index.php',
    ],
    [
        'label' => 'ព័ត៌មានអន្តរជាតិ',
        'href' => 'category.php?' . http_build_query(['name' => 'ព័ត៌មានអន្តរជាតិ']),
        'active' => $currentPage === 'category.php' && $currentCategory === 'ព័ត៌មានអន្តរជាតិ',
    ],
    [
        'label' => 'សុខភាព',
        'href' => 'category.php?' . http_build_query(['name' => 'សុខភាព']),
        'active' => $currentPage === 'category.php' && $currentCategory === 'សុខភាព',
    ],
    [
        'label' => 'កីឡា',
        'href' => 'category.php?' . http_build_query(['name' => 'កីឡា']),
        'active' => $currentPage === 'category.php' && $currentCategory === 'កីឡា',
    ],
    [
        'label' => 'បច្ចេកវិទ្យា',
        'href' => 'category.php?' . http_build_query(['name' => 'បច្ចេកវិទ្យា']),
        'active' => $currentPage === 'category.php' && $currentCategory === 'បច្ចេកវិទ្យា',
    ],
];
?>

<div class="navbar">

    <?php foreach ($menuItems as $menuItem): ?>
        <a
            href="<?php echo $menuItem['href']; ?>"
            class="route-link <?php echo $menuItem['active'] ? 'active' : ''; ?>"
            data-route-link
        >
            <?php echo $menuItem['label']; ?>
        </a>
    <?php endforeach; ?>

</div>

<form class="search-bar" action="search.php" method="get">
    <input type="search" name="q" placeholder="Search news..." value="<?php echo htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <button type="submit">Search</button>
</form>
