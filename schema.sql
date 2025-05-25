-- Create database
CREATE DATABASE IF NOT EXISTS scoredb;
USE scoredb;

-- Judges table
CREATE TABLE IF NOT EXISTS judges (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  display_name VARCHAR(100) NOT NULL
);

-- Participants table
CREATE TABLE IF NOT EXISTS participants (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

-- Scores table
CREATE TABLE IF NOT EXISTS scores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judge_id INT NOT NULL,
  participant_id INT NOT NULL,
  points INT NOT NULL CHECK (points BETWEEN 1 AND 100),
  submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (judge_id) REFERENCES judges(id) ON DELETE CASCADE,
  FOREIGN KEY (participant_id) REFERENCES participants(id) ON DELETE CASCADE
);

-- Seed initial participants
INSERT INTO participants (name) VALUES
('Alice'),
('Bob'),
('Charlie');