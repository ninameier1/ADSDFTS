# README

## System Requirements
To successfully run the Festibus website, the following system requirements apply:

### Platform Support
The website is designed to function well on desktops, tablets, and mobile devices.

### Hardware
- A computer, tablet, or mobile phone with at least 4 GB RAM and a modern processor.

### Software
- An operating system that supports PHP and MySQL, such as macOS, Windows, or Linux.

### Required Software and Tools
- **PHP**: Minimum version 8.2
- **Composer**: For managing PHP dependencies
- **Laravel**: Automatically downloaded via Composer
- **MySQL**: For the database

### Network Connection
- A stable internet connection is required for external resources and updates, but not necessary for local use.

### Browser Requirements
The website supports modern and up-to-date browsers such as Google Chrome, Mozilla Firefox, Microsoft Edge, and Apple Safari. Older browsers are not fully supported as HTML5 and JavaScript ES6 are used.

### Server Environment
For local development, a local server that supports PHP and MySQL is required.

---

## Installation Steps
Follow these steps to install the project locally:

### 1. Download the Project Files
- **Via ZIP**: Download the zip file of the project and extract it.
- **Via GitHub**: Clone the repository to your local machine:
  ```bash
  git clone https://github.com/ninameier1/ADSDFTS.git
  cd ADSDFTS
  ```

### 2. Install Dependencies
Laravel uses Composer to manage PHP packages. Install the required dependencies by running:
```bash
composer install
```

### 3. Open the `.env` File
The `.env` file should already be included in the downloaded project. Open it in a text editor and adjust the database settings if needed, such as a different port number or database password.

### 4. Generate the Application Key
Run the following command to generate Laravel’s application key:
```bash
php artisan key:generate
```

### 5. Create the Database
Before running migrations, ensure the database exists. This can be done manually using MySQL CLI or phpMyAdmin:
```bash
mysql -u root -p
CREATE DATABASE fts;
EXIT;
```

### 6. Run Migrations and Seeders
Run the migrations to create the tables in the database:
```bash
php artisan migrate
```

Run the seeders to populate the tables with dummy data:
```bash
php artisan db:seed
```

### 7. Install Node.js Dependencies
To ensure Tailwind CSS and other frontend assets work correctly, install Node.js dependencies:
```bash
npm install
```

### 8. Create the Storage Link
Run the following command to create a symbolic link for the storage directory, making it publicly accessible:
```bash
php artisan storage:link
```

### 9. Set Permissions for the Storage Directory
```bash
chmod -R 775 storage
```

### 10. Start the Development Servers
Start the Laravel development server:
```bash
php artisan serve
```

Start the Vite development server for Tailwind CSS and frontend assets:
```bash
npm run dev
```

Make sure to keep both servers running during development.

---

## Running the Application
After installation, open your browser and navigate to:
[http://localhost:8000](http://localhost:8000)

Ensure that the local server is active and the database is properly configured.

---

## Admin credentials
By default, after running the migrations and seeding the database, a standard admin account is created. To log in to this account, use the following credentials:
- **E-mail**: admin@test.com
- **Password**: admin

---

## Troubleshooting
- **Database Connection Errors**: Check that the correct database credentials are entered in the `.env` file.
- **MySQL Issues**: Ensure the MySQL database is running and accessible.
- **Tailwind Not Working**: Verify that the Vite development server is running (`npm run dev`).

---

## Notes for Production
For deploying the application in a production environment, run:
```bash
npm run build
```
This will generate optimized CSS and JavaScript files for production use.

