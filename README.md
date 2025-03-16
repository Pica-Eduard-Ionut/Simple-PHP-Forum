# SiteOSA (Operating Systems Project)

## Overview
This is a simple forum website built using PHP, MariaDB, and Apache. Users can register, log in, create posts, view posts, reply to posts, and edit/delete their own posts.

## Features
- User authentication (login and registration)
- Create new posts
- View posts with replies
- Edit and delete posts
- Reply to posts

## Installation

### Prerequisites
- Apache Web Server
- PHP
- MariaDB

### Setup Steps
1. Clone or download the repository to your web server directory:
   ```bash
   git clone https://github.com/your-repo/forum-project.git
   ```
   or manually place the files in your web server directory (e.g., `/var/www/html/forum/`).

2. Start your Apache and MySQL services.
   ```bash
   sudo service apache2 start
   sudo service mysql start
   ```

3. Create a database named `forum` in MySQL:
   ```sql
   CREATE DATABASE forum;
   ```

4. Create the necessary tables:
   ```sql
   USE forum;
   
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL
   );

   CREATE TABLE posts (
       id INT AUTO_INCREMENT PRIMARY KEY,
       poster VARCHAR(50) NOT NULL,
       post_title VARCHAR(255) UNIQUE NOT NULL,
       post_description TEXT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE replies (
       id INT AUTO_INCREMENT PRIMARY KEY,
       poster VARCHAR(50) NOT NULL,
       post_title VARCHAR(255) NOT NULL,
       reply TEXT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

5. Configure database connection in PHP files if needed.

6. Open your browser and navigate to `http://localhost/forum/`.

## Future Improvements
- Add user roles (admin, moderators, regular users)
- Improve UI with CSS/Bootstrap
- Implement notifications for replies
- Allow users to edit their own replies
