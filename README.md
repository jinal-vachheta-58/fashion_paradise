# 👗 Fashion Paradise – E-Commerce Web Application

> A full-stack e-commerce web application for online fashion shopping, built using PHP, MySQL, HTML, CSS, and Bootstrap.

---

## 📌 Overview

**Fashion Paradise** is a dynamic online fashion store built with PHP and MySQL, offering a seamless shopping experience for users and full control for admins to manage products and orders. It supports complete user authentication, a cart and checkout system, and an admin dashboard to handle the backend operations.

---

## 🌐 Demo / Screenshots

> *Screenshots coming soon...*  
> *(You can add Google Drive links or GitHub image embeds here)*

---

## ✅ Features

### 👤 User Features
- Register and login with session-based authentication
- Browse product listings with categories
- Add products to cart and view total cost
- Place orders and view past order history

### 🛠️ Admin Features
- Secure login for admin dashboard
- Add, update, and delete products (CRUD operations)
- View all customer orders and manage order flow
- View and manage registered users
- Monitor sales and revenue reports (if implemented)

---

## 🛠️ Tech Stack

- **Frontend**: HTML, CSS, Bootstrap
- **Backend**: PHP
- **Database**: MySQL
- **Web Server**: Apache (XAMPP/WAMP)
- **Tools**: VS Code / Sublime Text, phpMyAdmin

---

## 🚀 Installation Instructions

Follow the steps below to run the project on your local machine:

1. **Install XAMPP or WAMP** from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)
2. Clone this repository or download the ZIP  
   `git clone https://github.com/jinal-vachheta-58/fashion_paradise`
3. Move the project folder to the `htdocs/` directory (XAMPP) or `www/` (WAMP)
4. Open **phpMyAdmin** from `http://localhost/phpmyadmin`
5. **Create a new database** (e.g., `fashion_db`)
6. **Import** the SQL file provided in the repo (`fashion_paradise.sql`)
7. Start Apache and MySQL in XAMPP/WAMP
8. Open your browser and go to  
   👉 `http://localhost/fashion_paradise`

---

## 🧱 Database Schema (Major Tables)

- `users` – stores customer login and profile details  
- `products` – stores product info like name, price, stock, image  
- `cart` – stores temporary cart data linked to user session  
- `orders` – stores confirmed orders  
- `order_items` – line items for each order  
- `admin` – login data for admin dashboard  

*(Note: table names may vary based on your SQL script.)*

---

## 📁 Folder Structure (Simplified)

