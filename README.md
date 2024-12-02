# Candy Atlas Inventory Management System

An inventory management web application built using Laravel and Bootstrap.

## Done
- Template remastering @Shelly855

## Doing
- Category Crud @Shelly855 - sidebar + web.php will be modified

## Need to be Done
- Login page mastering @JianFGO or someone
- Authentication @JianFGO or someone
- Products, maybe Unit @Shelly855
- Invoice @SWE-SAM
- Reports @SWE-SAM or someone
- Dashboard @SWE-SAM
- Users @sumayyah19 ?
- Branches @sumayyah19 or someone
- Personal Profile?
- Orders?
- Other

## For Team
Make sure to have **Laravel Artisan**, **composer etc.** installed, and that you have a **mysql** database created called **candy** in PHPMyAdmin.

### 1. After cloning into htdocs folder, run in VSC terminal (open using Ctrl + J if you have Windows):
- composer install
- cp .env.example .env
- php artisan key:generate

### 2. Modify env. file (not env.example) to link to the mysql database:
- DB_CONNECTION name is **mysql**
- DB_DATABASE name is **candy**
- Username is usually **root**, and password is empty
- If there are migrations, run **php artisan migrate** in terminal
- If there are seeders, run **php artisan db:seed**

### 3. Running the website:
- Start **XAMPP Apache** & **MySQL**
- Run in terminal **php artisan serve** and **Ctrl + Click** on the link that appears
- Any antivirus you have active may cause issues

### 4. If you encounter an error related to vite:
- Create a *separate* VSC terminal using the + icon
- Run **npm install**
- Run **npm run dev**
- Keep this terminal, don't delete it. Use other terminals for running the website

### 5. To backup your changes:
- Create a new repository
- Run in VSC terminal: **git remote add backup your-backup-repo-url**
- Then: **git push --mirror backup** (If you have backed up your changes before, just use this step)

## Acknowledgements
- [Bootstrap](https://getbootstrap.com)
- [Laravel Framework](https://laravel.com)
- [Stisla Bootstrap Admin Template](https://github.com/stisla/stisla)
