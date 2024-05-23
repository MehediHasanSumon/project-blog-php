<?php
require_once "/xampp/htdocs/blogtd/config/functions.php";

if (isset($_REQUEST["createCat"])) {
    if (($_REQUEST['catName'] == '')) {
        redirect("../signup.php", "All fields are required.");
    } else {
        $cat_name = $_REQUEST["catName"];
        $slug = create_slug($cat_name);
        $data = [
            "name" => $cat_name,
            "slug" => $slug,
        ];

        if (insert_data("categories", $data)) {
            redirect("../categories.php", "Category has been added..");
        } else {
            redirect("../create-category.php", "Problem occurred..");
        }
    }
}
if (isset($_REQUEST["updateCat"])) {
    if (($_REQUEST['catName'] == '')) {
        redirect("../signup.php", "All fields are required.");
    } else {
        $cat_name = $_REQUEST["catName"];
        $slug = create_slug($cat_name);
        $catSlug = $_REQUEST["catSlug"];
        $data = [
            "name" => $cat_name,
            "slug" => $slug,
        ];
        if (update_data("categories",  $data, "slug", $catSlug)) {
            redirect("../categories.php", "Category has been Updated..");
        } else {
            redirect("../edit-category.php?category=$catSlug", "Problem occurred..");
        }
    }
}

if (isset($_REQUEST["delete"])) {
    $slug = $_REQUEST["slug"];
    if (delete_data("categories", "slug", $slug)) {
        redirect("../categories.php", "Category has been Deleted..");
    } else {
        redirect("../categories.php", "Problem occurred..");
    }
}
