# Blog Post Project

## Technologies Used

- HTML
- CSS
- JavaScript
- PHP
- JQuery
- Bootstrap
- Prism
- Highlight.js

## Packages Used

- PHPMailer

## Directory Structure

```
project
├───admin
│   ├───assets
│   ├───categories.php
│   ├───change-password.php
│   ├───change-post-thumb.php
│   ├───change-user-password.php
│   ├───create-category.php
│   ├───create-post.php
│   ├───create-user.php
│   ├───css
│   │   ├───app.css
│   │   ├───bootstrap.css
│   │   ├───fontawesome.css
│   │   └───sidebar.css
│   ├───edit-category.php
│   ├───edit-post.php
│   ├───edit-user.php
│   ├───include
│   │   ├───footer.php
│   │   ├───header.php
│   │   └───sidebar.php
│   ├───index.php
│   ├───js
│   │   ├───all.min.js
│   │   ├───apps.js
│   │   ├───bootstrap.js
│   │   ├───jquery.js
│   │   ├───popper.min.js
│   │   └───sidebar.js
│   ├───posts.php
│   ├───request
│   │   ├───category.php
│   │   ├───post.php
│   │   └───user.php
│   └───users.php
├───config
│   ├───.env
│   ├───config.php
│   ├───functions.php
├───css
│   ├───all.css
│   ├───app.css
│   ├───bootstrap.css
│   ├───github-dark.min.css
│   ├───prism-tomorrow.min.css
├───error
│   ├───401.php
│   ├───404.php
│   ├───500.php
├───images
│   ├───15805684.jpg
│   ├───User_Icon.png
├───include
│   ├───category.php
│   ├───footer.php
│   ├───header.php
│   ├───navbar.php
│   ├───search.php
├───js
│   ├───all.js
│   ├───app.js
│   ├───bootstrap.bundle.js
│   ├───bootstrap.js
│   ├───highlight.min.js
│   ├───jquery.js
│   ├───popper.min.js
│   ├───prism-c.min.js
│   ├───prism.min.js
├───request
│   ├───authentication.php
│   ├───post.php
│   ├───user.php
├───uploads
│   ├───posts
│   └───user
├───category.php
├───change-password.php
├───change-profile-picture.php
├───change-thumb.php
├───comment.php
├───composer.json
├───composer.lock
├───edit-post.php
├───edit-profile.php
├───forget-password.php
├───index.php
├───login.php
├───logout.php
├───new-post.php
├───post.php
├───profile.php
├───reset-password.php
├───search.php
├───signup.php
└───user-post.php
```

## How to Run the Project

1. **Install XAMPP:** Download and install XAMPP from the [official website](https://www.apachefriends.org/index.html).

2. **Start XAMPP Control Panel:** Open the XAMPP control panel and start the Apache and MySQL servers.

3. **Create Database:**
   - Open PHPMyAdmin by visiting `http://localhost/phpmyadmin`.
   - Create a new database named `blogtd`.

4. **Import Database:**
   - Import the `blogtd.sql` file into the `blogtd` database.

5. **Configure Project:**
   - Ensure the `.env` file in the `config` directory contains the correct database configuration settings.

6. **Run the Project:**
   - Place the project files in the `htdocs` directory of your XAMPP installation.
   - Open your browser and go to `http://localhost/project`.

## Features

1. **Multi-User Role:** Supports different user roles (admin/user).
2. **Admin Panel:** Provides an admin panel for managing categories, posts, and users.
3. **Function-Based Architecture:** Utilizes function-based programming for modularity and reusability.

---

By following the above instructions and structure, you should be able to set up and run the blog post project seamlessly. The project is designed to be extensible and maintainable, leveraging a combination of modern web technologies and best practices. Enjoy building and customizing your blog!