# 🚗 VehicleCompare

VehicleCompare is a PHP-based web app that lets users compare vehicles side by side — specs, features, and pricing — to make a confident, informed choice before buying. Built with an MVC architecture (Controller/Model/Views) and a MySQL backend.

---

## ✨ Features

### Public Side
- **Home Page** — Landing page with featured vehicles and latest news carousel
- **Vehicle Browser** — Browse vehicles by brand, model, and version with detailed specs (engine, power, consumption, dimensions, price, etc.)
- **Vehicle Comparator** — Side-by-side comparison of two vehicles
- **Brand Directory** — Explore automotive brands with their origin, founding year, and headquarters
- **Reviews & Ratings** — Authenticated users can submit and read reviews for vehicles and brands, with pagination and filtering
- **News Section** — Automotive news articles with detailed pages and images
- **Buying Guide** — Editorial content with tips on maintenance, model selection, and purchase steps
- **Favorites** — Logged-in users can save and manage favorite vehicles on their profile
- **User Profiles** — Personal profile page with account info and saved favorites
- **Contact Page** — Contact form linked to a configurable admin email
- **Authentication** — Registration, login, logout, and session management

### Admin Dashboard
- Manage **vehicles** (add, edit, delete) with image upload
- Manage **brands** and **models/versions**
- Manage **news articles** and their detail sections
- Moderate **user reviews** (approve, reject, delete)
- Manage **users** (validate, block, filter)
- View user profiles from the admin panel

---

## 🛠️ Tech Stack

| Layer       | Technology                  |
|-------------|-----------------------------|
| Backend     | PHP 8 (MVC architecture)    |
| Database    | MySQL 8                     |
| Frontend    | HTML, CSS (custom stylesheet) |
| DB Tool     | phpMyAdmin                  |
| Server      | Apache / XAMPP / LAMP stack |

---

All routing is handled by a single `index.php` front controller using `?action=` GET parameters (e.g., `?action=comparateur`, `?action=marques&id=1`).

---

## 🗄️ Database

The database is named **`comparateur_vehicules`** and contains the following tables:

| Table           | Description                                  |
|-----------------|----------------------------------------------|
| `vehicule`      | Vehicle specs, price, engine, dimensions     |
| `marque`        | Brand info (origin, founding year, etc.)     |
| `modele`        | Models linked to brands                      |
| `version`       | Versions/trims linked to models              |
| `avis`          | User reviews with ratings and moderation status |
| `comparaison`   | Tracks which vehicle pairs have been compared |
| `news`          | News articles                                |
| `news_details`  | Detailed sections of a news article          |
| `conseil`       | Buying guide / editorial content             |
| `utilisateur`   | Users with roles (`admin`, `client`) and status |
| `favoris`       | User-saved favorite vehicles                 |
| `image`         | Centralized image path registry              |
| `parameters`    | App-level configuration (e.g., contact email) |

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.0+
- MySQL 8.0+
- Apache web server (XAMPP, WAMP, or LAMP recommended)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/BSoundos/vehicle-comparison-website.git
   cd vehicle-comparison-website
   ```

2. **Import the database**
   - Open phpMyAdmin (or your MySQL client)
   - Create a new database named `comparateur_vehicules`
   - Import the file `TDW.sql`

3. **Configure the database connection**
   - Locate the database connection settings in the `Model/` directory
   - Update the host, username, password, and database name to match your environment

4. **Serve the application**
   - Place the project folder inside your web server's root (e.g., `htdocs/` for XAMPP)
   - Start Apache and MySQL
   - Visit `http://localhost/vehicle-comparison-website/`

---

## 👤 Default Credentials

The seed data includes a default admin account:

| Field    | Value               |
|----------|---------------------|
| Username | `admin`             |
| Password | `admin`             |
| Role     | `admin`             |
| Email    | `admin@email.com`   |



---

## 📸 Supported Vehicle Categories

- Voiture (Car)
- Motocyclette (Motorcycle)
- Vélo (Bicycle)
