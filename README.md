# Farmer Management System (Laravel 11)
# The Farmer Management System is a modular Laravel 11 application designed to manage farmers, loans, and extend functionality with dynamic modules. It includes an admin dashboard, module management capabilities, and a Loan Management module as a feature example.

---

## Features
### Admin Dashboard
- **View Registered Farmers:** Displays a table of all registered farmers.
- **Register Farmers:** Add new farmers to the system.
- **Edit or Delete Farmers:** Manage farmer records directly from the table.

### Module Management
- **Create Modules:** Use a frontend form or an Artisan command to create modules with predefined structure.
- **Upload Modules:** Upload a ZIP file containing a module.
- **Dynamic Registration:** Automatically register modules with routes, migrations, and views.
- **Activate/Deactivate Modules:** Enable or disable module functionality.
- **Delete Modules:** Completely remove modules from the system.

### Loan Management Module
- **Loan Disbursement:** Assign loans to registered farmers.
- **Loan Management:** Approve/reject loan applications and mark loans as repaid.
- **Dynamic Module Controls:** Deactivate or delete the Loan Management module as needed.

---

## Setup Instructions

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL or any supported database
- Node.js & npm (for frontend assets)
- Laravel 11
## Setup Instructions

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL or any supported database
- Node.js & npm (for frontend assets)
- Laravel 11

### Installation Steps
1. **Clone the Repository**
   ```bash
   git clone  https://github.com/Mafumu12/GNA-Farmer-Management-System.git
   cd  farmer-Management-system
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Setup Environment Variables**
   Copy `.env.example` to `.env` and configure the database and other settings.
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

 

6. **Start the Development Server**
   ```bash
   php artisan serve
   ```

7. **Access the Application**
   Open `http://localhost:8000` in your browser.

---
## Usage


### Module Management
#### Create a Module
- **Via Frontend:**
  1. Navigate to the "Create Module" page.
  2. Enter a module name and submit the form.
- **Via Artisan Command:**
  ```bash
  php artisan app:make-module {ModuleName}
  ```

#### Upload a Module
1. Navigate to the "Upload Module" page.
2. Upload a ZIP file containing the module.

#### Activate/Deactivate a Module
1. Go to the module management section.
2. Toggle activation for a module.

#### Delete a Module
1. In the module management section, delete a module.
2. Optionally, upload and reactivate the module later.

### Loan Management Module
1. Navigate to the Loan Management page.
2. Disburse, approve/reject, or mark loans as repaid.

---

## Module System

### Overview
Modules are independent packages that encapsulate functionality. Each module contains its own:
- Models
- Controllers
- Routes
- Views
- Migrations

### Module Structure
```
Modules/
└── {ModuleName}/
    ├── Controllers/
    ├── Models/
    ├── Views/
    ├── Routes/
    │   └── web.php
    └── Migrations/
```

### Creating a Module
Modules can be created via the frontend or using the `app:make-module` Artisan command.

### Uploading a Module
Upload a ZIP file with the required structure. The system extracts and registers the module automatically.

### Activation and Deactivation
- **Activate:** Registers routes, views, and migrations.
- **Deactivate:** Disables all associated functionality.

### Deleting Modules
Completely removes a module from the system. Deleted modules can be re-uploaded and reactivated later.

---
