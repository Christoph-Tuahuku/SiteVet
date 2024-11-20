CREATE DATABASE sitevetdb;
USE sitevetdb;
CREATE TABLE Diseases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    symptoms TEXT NOT NULL,
    causes TEXT,
    prevention TEXT,
    treatment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE Disease_Submissions (
    submission_id INT AUTO_INCREMENT PRIMARY KEY,
    disease_id INT,
    sample_details TEXT NOT NULL,
    date_submitted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    result TEXT,
    FOREIGN KEY (disease_id) REFERENCES Diseases(id) ON DELETE SET NULL
);
CREATE TABLE Treatment_Records (
    record_id INT AUTO_INCREMENT PRIMARY KEY,
    disease_id INT,
    treatment_details TEXT NOT NULL,
    date_treated DATE NOT NULL,
    treated_by VARCHAR(100),
    FOREIGN KEY (disease_id) REFERENCES Diseases(id) ON DELETE SET NULL
);
CREATE TABLE Vaccination_Schedule (
    vaccine_id INT AUTO_INCREMENT PRIMARY KEY,
    disease_id INT,
    vaccine_name VARCHAR(100) NOT NULL,
    scheduled_date DATE NOT NULL,
    notes TEXT,
    FOREIGN KEY (disease_id) REFERENCES Diseases(id) ON DELETE SET NULL
);
CREATE TABLE Disease_Reports (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    disease_id INT,
    report_summary TEXT NOT NULL,
    date_generated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (disease_id) REFERENCES Diseases(id) ON DELETE SET NULL
);

INSERT INTO Diseases (name, symptoms, causes, prevention, treatment)
VALUES 
    ('Canine Parvovirus', 'Vomiting, lethargy, anorexia, bloody diarrhea', 
     'Virus, direct contact, contaminated feces', 
     'Vaccination, hygiene, disinfection', 
     'Hospitalization, IV fluids, anti-nausea medication'),
     
    ('Feline Leukemia Virus', 'Loss of appetite, weight loss, poor coat condition', 
     'Virus, saliva, blood, urine, feces', 
     'Keep indoors, vaccination, avoid contact with infected cats', 
     'Supportive care, medications, regular monitoring');
select * from diseases;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE contact_us (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phonenum VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


