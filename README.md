# 🏆 Scoreboard Management System

A simple PHP-based scoreboard system for managing and displaying competition results. Built using the **LAMP stack** (Linux, Apache, MySQL, PHP) with HTML, CSS, JavaScript, and SQL.

---

## 🚀 Features

- 🛠 Admin panel to create and manage contests and scores  
- 🧑‍⚖️ Judge interface to submit participant scores  
- 📊 Real-time scoreboard view for participants/audience  
- 🎨 Clean and responsive UI using custom CSS  

---

## 🔧 Setup Instructions

### ✅ Prerequisites

- A LAMP environment (XAMPP, WAMP, MAMP, or a Linux server)
- PHP 7.x or higher
- MySQL 5.x or higher
- Apache Web Server

### 📥 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Masterkimaru/Score_Board.git
   cd Score_Board
2. Database Setup

Create a new MySQL database, e.g., scoreboard_db

Import the following SQL schema:
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'judge') NOT NULL
);

CREATE TABLE contests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  start_time DATETIME,
  end_time DATETIME
);

CREATE TABLE participants (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  contest_id INT NOT NULL,
  FOREIGN KEY (contest_id) REFERENCES contests(id) ON DELETE CASCADE
);

CREATE TABLE scores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  participant_id INT NOT NULL,
  judge_id INT NOT NULL,
  score DECIMAL(5,2) NOT NULL,
  FOREIGN KEY (participant_id) REFERENCES participants(id) ON DELETE CASCADE,
  FOREIGN KEY (judge_id) REFERENCES users(id) ON DELETE CASCADE
);

3. Configure the Database Connection

Open config.php and update with your database credentials:
$host = 'localhost';
$db   = 'scoreboard_db';
$user = 'your_db_user';
$pass = 'your_db_password';

4. Run the Application

Place the project folder in your web root directory (e.g., htdocs/ for XAMPP)

Start Apache and MySQL services

Visit http://localhost/scoreboard-system/ in your browser

📌 Assumptions Made
Judges and admins are manually added to the users table.

Each judge can score each participant only once per contest.

Participants are uniquely identified by name within each contest.

No user registration system; roles are predefined in the database.

📐 Design Choices
Database Normalization: Each entity (users, contests, participants, scores) is placed in a separate table with foreign key constraints to maintain integrity.

Role-Based Access Control: Roles (admin, judge) determine access level within the application.

PHP Constructs:

mysqli is used for database interaction due to its simplicity and error handling capabilities.

PHP sessions manage login sessions securely.

Input validation and basic error handling are implemented to improve reliability.

🌟 Future Improvements (Optional)
Add user registration with password_hash() and secure login.

Implement AJAX for live score updates without page reloads.

Add score export options (CSV, PDF).

Introduce countdown timers and contest status labels (upcoming, ongoing, ended).

Enhance UI/UX with Bootstrap or TailwindCSS for better responsiveness.

🌐 Public Demo Link
https://scoreboardsystem.infinityfreeapp.com/
