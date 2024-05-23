<?php
require_once 'config/functions.php';
$categories = get_all_data("categories");
?>

<div class="card mt-4">
    <div class="card-header">Category</div>
    <div class="card-body">
        <ul class="list-group">

            <?php

            if ($categories) {
                foreach ($categories as $category) {
                    echo '<a href="category.php?category=' . $category['slug'] . '" class="mb-1">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ' . $category['name'] . '
                    <span class="badge bg-primary rounded-pill">' . count_post($category['name']) . '</span>
                </li>
            </a>';
                }
            }
            ?>

        </ul>
    </div>
</div>