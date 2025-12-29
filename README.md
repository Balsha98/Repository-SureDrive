# SureDrive - Car Dealership Web Application

A comprehensive car dealership web application with role-based access control. Browse, manage, and purchase vehicles all in one streamlined platform.

## Features

- **User Authentication** - Secure login and registration system.
- **Role-Based Access Control** - Four distinct user roles with specific permissions.
- **Vehicle Browsing** - Browse available cars with detailed information.
- **Purchase System** - Registered users can buy vehicles.
- **Inventory Management** - Add, update, and manage vehicle listings.
- **User Management** - Admin control over user accounts and roles.
- **Secure Transactions** - Protected purchase workflow.

## User Roles & Permissions

### Administrator

- Full system access and control.
- Create and manage all user types (including other admins).
- Add, update, and delete vehicles.
- Manage owners, sellers, and buyers.
- View all transactions and system data.

### Owner

- Manage dealership inventory.
- Add, update, and delete vehicles.
- View sales reports and statistics.
- Monitor dealership performance.

### Seller

- Add and update vehicle listings.
- View assigned inventory.
- Track sales and commissions.
- Manage vehicle details and pricing.

### Buyer

- Browse available vehicles.
- View detailed car information.
- Purchase vehicles.
- View purchase history.
- Manage personal profile.

## Tech Stack

- **PHP** - Server-Side Logic & Backend
- **MySQL** - Database Management
- **HTML5** - Structure & Content
- **CSS3** - Styling & Layout
- **JavaScript** - Client-Side Interactivity
- **jQuery** - DOM Manipulation & AJAX Requests

## Installation

### Prerequisites

- PHP 7.4 or higher.
- MySQL 5.7 or higher.
- Apache web server.
- MySQL server.
- Composer (optional, for dependencies).

### Setup Instructions

1. Clone the repository:

```bash
git clone https://github.com/Balsha98/Repository-SureDrive.git
```

2. Navigate to the project directory:

```bash
cd Repository-SureDrive/sure-drive
```

3. Import the database:

```bash
# Import the SQL file into your MySQL database
mysql -u root -p sure_drive < assets/sql/database.sql
```

4. Set up your web server to point to the project directory.

5. Access the application:

```
http://localhost/local-repository-directory
```

## Getting Started

1. **Sign Up**: Register as an Owner, Seller, or Buyer.
2. **Login**: Access the system with your credentials.
3. **Browse Vehicles**: View available cars (all users).
4. **Purchase**: Buy vehicles (registered buyers only).

## Project Structure

```
SureDrive/
│
├── sure-drive/         # Main application directory.
│   │
│   ├── api/            # API endpoints for request processing.
│   │
│   ├── assets/         # Application assets.
│   │   │
│   │   ├── classes/            # Helper PHP classes.
│   │   │
│   │   ├── css/                # Styling.
│   │   │
│   │   ├── email/              # Email templates.
│   │   │
│   │   ├── javascript/
│   │   │   ├── helpers/        # Helper functions.
│   │   │   ├── libraries/      # Third-party libraries (jQuery).
│   │   │   └── views/          # View-specific scripts.
│   │   │
│   │   ├── json/               # Dummy data (testimonials).
│   │   │
│   │   ├── media/              # Site visuals.
│   │   │
│   │   ├── sql/                # Database schema.
│   │   │
│   │   └── views/              # Main application views.
│   │
│   ├── .htaccess               # Custom routing configuration.
│   ├── configuration.php       # Application configuration.
│   └── index.php               # Application entry point.
│
└── README.md           # Project documentation.
```

## Database Schema

The application uses a relational database with the following main tables:

- **users** - User accounts and authentication.
- **descriptions** - User-related descriptions.
- **rols** - User role definitions.
- **cars** - Car inventory and details.
- **cars_bought** - Bought car inventory and details.
- **sales** - Transaction records.
- **shipments** - Shipment records.
- **owners** - Owner profiles.
- **sellers** - Seller profiles.
- **buyers** - Buyer profiles.
- **newsletters** - Newsletter information.
- **logs** - Application log information.

## Security Features

- Password hashing with PHP's `hash()` function.
- SQL injection prevention with prepared statements.
- Session management for user authentication.
- Role-based access control (RBAC).
- Input validation and sanitization.
- Secure purchase workflow.

## Future Enhancements

### Email Notifications (SMTP Integration)

- **Purchase Confirmations** - Email receipts for buyers.
- **Inventory Alerts** - Notifications for new vehicle listings.
- **Account Verification** - Email verification for new users.
- **Password Recovery** - Secure password reset via email.
- **Sales Notifications** - Alerts for sellers on successful sales.

### Additional Features

- **Payment Gateway** - Integrate Stripe/PayPal for online payments
- **Vehicle Comparison** - Side-by-side comparison tool.
- **Favorites/Wishlist** - Save vehicles for later viewing.
- **Reviews & Ratings** - Customer feedback system.
- **Export Reports** - Generate sales reports in PDF/Excel.

## Roadmap

- [x] User authentication and role-based access.
- [x] Vehicle browsing and management.
- [x] Purchase system for registered users.
- [x] Admin user management.
- [ ] SMTP email notification system.
- [ ] Payment gateway integration.
- [ ] Vehicle comparison feature.
- [ ] Customer review system.

## Let's Connect

If you enjoyed this project or have any questions, feel free to reach out!

[![Email](https://img.shields.io/badge/Email-D14836?style=for-the-badge&logo=gmail&logoColor=white)](mailto:balsa.bazovic@gmail.com)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/balsha-bazovich)
[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/Balsha98)

⭐ If you found this project helpful, please consider giving it a star!

---

Made with PHP, HTML5, CSS3, JavaScript (jQuery), and ❤️!
