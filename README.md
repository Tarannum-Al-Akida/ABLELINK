# Sprint 1: AbleLink Platform

## Overview

This directory (`Sprint 1`) contains the merged implementation of the core AbleLink features, built with **Laravel 12** and **Tailwind CSS**.

### Included Features
- **F1**: OTP Authentication & Admin System (Akida Lisi)
- **F2**: Role-Based Dashboards (Rifat Jahan Roza)
- **F3**: User Profile & Accessibility Preferences (Evan Yuvraj Munshi)
- **F4**: Caregiver Profile Management (Farhan Zarif)

---

## 📚 Documentation
For detailed developer guides, please check the `docs/` folder:
- [Git Collaboration Guide](../docs/Git_Collaboration_Guide.md) - **READ THIS BEFORE COMMITTING**
- [Feature Architecture](../docs/Sprint.md) - Deep dive into files and logic.

---

## ✨ Features Breakdown

### F1: OTP Authentication (Akida Lisi)
- **Secure Login**: OTP-based login via email/log.
- **Roles**: Admin, User (Disabled), Caregiver, Employer, Volunteer.
- **Validation**: Strict 11-digit phone number enforcement.
- **Dev Tools**: Built-in "Psst!" OTP revealer for easy testing.
- **Admin System**: Dedicated admin login and oversight.

### F2: Role-Based Dashboards (Rifat Jahan Roza)
- **Premium UI**: Modern Tailwind CSS designs.
- **Role Specifics**:
  - **Volunteer**: Task tracking and gamification.
  - **Employer**: Hiring management and posting.
  - **Admin**: Platform statistics and user oversight.
  - **Caregiver/User**: Specialized views for their needs.

### F3: User Profile & Accessibility (Evan Yuvraj Munshi)
- **Profile Management**: Bio, Address, Avatar upload.
- **Refined UI**: Readonly email protection & structured Grid layout for Emergency Contacts.
- **Accessibility Suite**: Global preferences for:
  - Font Size (Small -> XL)
  - Contrast (High, Inverted)
  - Color Blind Helper
  - Reduced Motion

### F4: Caregiver Management (Farhan Zarif)
- **Connection System**: Send requests to link with patients.
- **Proxy Management**: Edit patient profiles and settings on their behalf.
- **Privacy**: User must approve connection requests.

---

## 📂 Updated File Structure

The project follows a modular structure for better collaboration:

```
Sprint 1/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── AdminController.php (F1)
│   │   │   ├── Caregiver/
│   │   │   │   ├── CaregiverController.php (F4)
│   │   │   │   └── ConnectionController.php (F4)
│   │   │   ├── Profile/
│   │   │   │   ├── ProfileController.php (F3)
│   │   │   │   └── AccessibilityController.php (F3)
│   │   │   ├── Auth/ (F1)
│   │   │   └── DashboardController.php (F2)
│   ├── Models/
│   │   ├── User.php (Shared)
│   │   ├── UserProfile.php (F3/F4)
│   │   └── OtpCode.php (F1)
│   └── Middleware/
│       └── AdminMiddleware.php (F1)
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php (Tailwind Master Layout)
│   │   ├── dashboards/ (F2)
│   │   ├── profile/ (F3)
│   │   └── caregiver/ (F4)
│   └── css/
│       └── app.css (Tailwind)
└── routes/
    └── web.php (Shared Route Definitions)
```

---

## 🚀 Installation

### 1. Environment Setup
```bash
cp .env.example .env
```
Edit `.env`:
```
DB_DATABASE=ablelink
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Generate Key & Migrate
```bash
php artisan key:generate
php artisan migrate
```

### 4. Seed Database (Optional)
```bash
php artisan db:seed --class=AdminSeeder
```

### 5. Start Server
```bash
npm run dev  # For Tailwind
php artisan serve
```

---

## 🧪 Testing Flows

1.  **Authentication**: Register as a User -> Verify OTP -> Land on User Dashboard.
2.  **Profile**: Go to Profile -> Upload Avatar -> Change Font Size (Verify text gets bigger).
3.  **Caregiver**: Register as Caregiver -> Dashboard -> "Connect to Patient" -> Enter Patient Email.
4.  **Admin**: Login at `/admin/login` -> View Dashboard Stats.
