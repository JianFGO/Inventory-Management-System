# Candy Atlas Inventory Management System

An inventory management web application built using Laravel and Bootstrap.

## Done
- Template remastering @Shelly855
- Category @Shelly855
- Products @Shelly855
- Login page mastering @JianFGO
- Authentication @JianFGO
- Orders @sumayyah19
- Users @sumayyah19

## Doing
- Invoice @SWE-SAM
- Dashboard @SWE-SAM
- Supporting multiple users @Shelly855
- Styling @Shelly855
- Supporting multiple branches @sumayyah19


## Need to be Done
- Personal Profile @JianFGO
- Reports @sumayyah19
- Prevent self-deletion of account
- Testing
- Other


## For Team
Make sure to have **Laravel Artisan**, **composer**, **node.js etc.** installed, and that you have a **mysql** database created called **candy** in PHPMyAdmin.

### 1. After cloning into htdocs folder, run in VSC terminal (open using Ctrl + J if you have Windows):
1. composer install
2. cp .env.example .env
3. php artisan key:generate

### 2. npm install & npm run dev:
1. Create a *separate* VSC terminal using the + icon
2. Run **npm install**
3. Run **npm run dev**
4. Keep this terminal, don't delete it. Use other terminals for running the website

### 3. Modify env. file (not env.example) to link to the mysql database:
- DB_CONNECTION name is **mysql**
- DB_DATABASE name is **candy**
- Username is usually **root**, and password is empty
- If there are migrations, run **php artisan migrate** in terminal
- If there are seeders, run **php artisan db:seed**

### 4. Running the website:
1. Start **XAMPP Apache** & **MySQL**
2. Run in terminal **php artisan serve** and **Ctrl + Click** on the link that appears
- Any antivirus you have active may cause issues

### 5. To backup your changes:
1. Create a new repository
2. Run in VSC terminal: **git remote add backup your-backup-repo-url**
3. Then: **git push --mirror backup** (If you have backed up your changes before, just use this step)

## Acknowledgements
- [Bootstrap](https://getbootstrap.com)
- [Laravel Framework](https://laravel.com)
- [Stisla Bootstrap Admin Template](https://github.com/stisla/stisla)
- [DataTables](https://datatables.net)
