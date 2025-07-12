# FindFriendBook

A social media application project.

## Project Structure

This project is divided into several key directories:
- `/` - The main user-facing application (login, register, profile, etc.)
- `/php` - Core backend PHP scripts for database connection and logic.
- `/sql` - Database schema files.
- `/admin` - The admin panel for site management.
- `/creator` - High-privilege development tools.

## Setup Instructions

1.  **Database:**
    - Create a new MySQL database (e.g., `findfriendbook`).
    - Import the `sql/findfriendbook.sql` file to set up the required tables.
    - Update the database credentials in `php/db.php`.

2.  **Web Server:**
    - Place the project files in a web server root (e.g., htdocs in XAMPP, www in WampServer).
    - Ensure your server is running PHP and MySQL.

3.  **Dependencies:**
    - This project uses standard PHP and JavaScript, with no external frameworks required for this basic build.

4.  **Permissions:**
    - Ensure the `uploads/` directory is writable by the web server so profile photos can be saved.

## Usage

- Navigate to `register.html` to create a new user account.
- Navigate to `login.html` to log in.
- The `index.html` serves as the main dashboard after logging in.
