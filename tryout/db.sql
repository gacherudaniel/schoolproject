-- Table: users
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'contractor') NOT NULL
);

-- Table: projects
CREATE TABLE projects (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  start_date DATE,
  end_date DATE,
  manager_id INT,
  FOREIGN KEY (manager_id) REFERENCES users(id)
);

-- Table: tasks
CREATE TABLE tasks (
  id INT PRIMARY KEY AUTO_INCREMENT,
  project_id INT,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  deadline DATE,
  priority INT,
  progress INT,
  assigned_to INT,
  FOREIGN KEY (project_id) REFERENCES projects(id),
  FOREIGN KEY (assigned_to) REFERENCES users(id)
);

-- Table: messages
CREATE TABLE messages (
  id INT PRIMARY KEY AUTO_INCREMENT,
  sender_id INT,
  recipient_id INT,
  message TEXT,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (sender_id) REFERENCES users(id),
  FOREIGN KEY (recipient_id) REFERENCES users(id)
);

-- Table: performance_metrics
CREATE TABLE performance_metrics (
  id INT PRIMARY KEY AUTO_INCREMENT,
  contractor_id INT,
  rating INT,
  feedback TEXT,
  FOREIGN KEY (contractor_id) REFERENCES users(id)
);

-- Table: contractor_profiles
CREATE TABLE contractor_profiles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  fullName VARCHAR(255) NOT NULL,
  dateOfBirth DATE NOT NULL,
  skills VARCHAR(255) NOT NULL,
  workExperience TEXT NOT NULL,
  education TEXT NOT NULL,
  projectHistory TEXT NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE contractors (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  status ENUM('active', 'inactive') NOT NULL
);

CREATE TABLE contractor_assignments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  project_id INT,
  contractor_id INT,
  assignment_date DATE,
  FOREIGN KEY (project_id) REFERENCES projects(id),
  FOREIGN KEY (contractor_id) REFERENCES contractors(id)
);
