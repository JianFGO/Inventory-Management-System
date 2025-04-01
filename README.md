# Candy Atlas Inventory Management System

An inventory management web application for a candy company built using Laravel and Bootstrap.

## Table of Contents

-   [Agile Roles](#agile-roles)
-   [Tech Stack](#tech-stack)
-   [How To Run](#how-to-run)
    -   [1. Setup](#1-after-cloning-into-htdocs-folder-run-in-vsc-terminal-open-using-ctrl--j-if-you-have-windows)
    -   [2. npm Install & Dev](#2-npm-install--npm-run-dev)
    -   [3. Database Setup](#3-database)
    -   [4. Environment File](#4-make-sure-env-file-is-linked-to-the-mysql-database)
    -   [5. Migrations & Seeders](#4-migrations--seeders)
    -   [6. Running the Website](#6-running-the-website)
-   [Login Details](#login-details)
-   [Acknowledgements](#acknowledgements)

**Documentation is available in the [`/docs`](./docs) folder.**

## Agile Roles

-   **Sprint 1**

    -   Scrum Master: [@SWE-SAM](https://github.com/SWE-SAM)
    -   Product Owner: [@sumayyah19](https://github.com/sumayyah19)

-   **Sprint 2**
    -   Scrum Master: [@JianFGO](https://github.com/JianFGO)
    -   Product Owner: [@Shelly855](https://github.com/Shelly855)

## Tech Stack

-   **Backend**: Laravel
-   **Frontend**: HTML, CSS, JavaScript, Bootstrap
-   **Database**: MySQL
-   **Testing**: WAVE Evaluation, Lighthouse, PHPUnit, OWASP ZAP
-   **Environment**: Visual Studio Code
-   **Version Control**: Git & GitHub

## How To Run

Make sure to have **Laravel Artisan (v11)**, **composer**, **node.js etc.** installed.

### 1. After cloning into htdocs folder, run in VSC terminal (open using Ctrl + J if you have Windows):

1. composer install
2. cp .env.example .env
3. php artisan key:generate

### 2. npm install & npm run dev:

1. Run **npm install**
2. Run **npm run dev**
3. Keep this terminal. When running the website, create a separate VSC terminal using the + icon

### 3. Database:

-   Create a MySQL database called **candy** in PHPMyAdmin

### 4. Make sure env. file is linked to the MySQL database:

-   DB_CONNECTION name is **mysql**
-   DB_DATABASE name is **candy**
-   Username is **root**
-   Password is empty

### 4. Migrations & Seeders:

1. Run **php artisan migrate** in terminal
2. Run **php artisan db:seed**

### 5. Install setasign/fpdf package:

1. Remove the semicolon from **;extension=gd** in your **php.ini** file
2. Run **composer require setasign/fpdf** in terminal

-   This is for invoice PDFs

### 6. Running the website:

1. Start **XAMPP Apache** & **MySQL**
2. Run in terminal **php artisan serve** and **Ctrl + Click** on the link that appears
3. If that does not work, manually launch the server using **php -S 127.0.0.1:8000 -t public**

## Login Details

### Admin Login (Sheffield Branch):

-   Email: **adel@gmail.com**
-   Password: **Password1**

### Manager Login (Manchester Branch):

-   Email: **mannie@gmail.com**
-   Password: **Password1**

### Sales Clerk Login (London Branch):

-   Email: **sal@gmail.com**
-   Password: **Password1**

## Acknowledgements

-   [Bootstrap](https://getbootstrap.com)
-   [Laravel Framework](https://laravel.com)
-   [Stisla Bootstrap Admin Template](https://github.com/stisla/stisla)
-   [DataTables](https://datatables.net)
