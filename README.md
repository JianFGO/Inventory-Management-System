# Candy Atlas Inventory Management System

An inventory management web application for a candy company built using Laravel and Bootstrap.

## Done
- Usability testing @Shelly855
- Product unit test @Shelly855
- Order unit test @sumayyah19
- User acceptance testing @Shelly855
  
## Doing
- Security testing & explaining security measures took @JianFGO
- Performance testing @sumayyah19
- Defect report @everyone

## Need to be Done
- Stress testing @SWE-SAM
- Other unit tests (1 each) @SWE-SAM, @JianFGO
- Invite all module tutors to GitHub repo @JianFGO

## For Team
Make sure to have **Laravel Artisan (v11)**, **composer**, **node.js etc.** installed.

### 1. After cloning into htdocs folder, run in VSC terminal (open using Ctrl + J if you have Windows):
1. composer install
2. cp .env.example .env
3. php artisan key:generate

### 2. npm install & npm run dev:
1. Create a *separate* VSC terminal using the + icon
2. Run **npm install**
3. Run **npm run dev**
4. Keep this terminal, don't delete it. Use other terminals for running the website

### 3. Database:
- Create a MySQL database called **candy** in PHPMyAdmin

### 4. Modify env. file (not env.example) to link to the MySQL database:
- DB_CONNECTION name is **mysql**
- DB_DATABASE name is **candy**
- Username is **root**
- Password is empty

### 4. Migrations & Seeders:
1. Run **php artisan migrate** in terminal
2. Run **php artisan db:seed**

### 5. Install setasign/fpdf package:
1. Remove the semicolon from **;extension=gd** in your **php.ini** file
2. Run **composer require setasign/fpdf** in terminal
- This is for invoice PDFs

### 6. Running the website:
1. Start **XAMPP Apache** & **MySQL**
2. Run in terminal **php artisan serve** and **Ctrl + Click** on the link that appears
3. If that does not work, manually launch the server using **php -S 127.0.0.1:8000 -t public**
- Any antivirus you have active may cause issues

### 7. To backup your changes:
1. Create a new repository
2. Run in VSC terminal: **git remote add backup your-backup-repo-url**
3. Then: **git push --mirror backup** (If your backup repo is added and you haven't newly cloned, just use this step)

## Acknowledgements
- [Bootstrap](https://getbootstrap.com)
- [Laravel Framework](https://laravel.com)
- [Stisla Bootstrap Admin Template](https://github.com/stisla/stisla)
- [DataTables](https://datatables.net)
