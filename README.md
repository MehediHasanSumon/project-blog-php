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

### Installation of PHPMailer

First, you need to install PHPMailer. The recommended way is via Composer:

```bash
composer require phpmailer/phpmailer
```

### Configuration of the `.env` File

Create a `.env` file in the root of your project and add the following content:

```
# Database connection
DB_HOST=your_database_host
DB_USER=your_database_user
DB_PASSWORD=your_database_password
DB_NAME=your_database_name

# Config for SMTP
MAIL_HOST=your_mail_host
MAIL_PORT=your_mail_port
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
```

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

This document provides an overview of the blog post project, including the technologies used, installation steps, configuration details, and a guide on how to run the project. It also highlights the key features of the project to ensure you have a comprehensive understanding of its structure and functionality.