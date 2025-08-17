-- Create the database
CREATE DATABASE IF NOT EXISTS voting_system;
USE voting_system;

-- Students table
CREATE TABLE students (
    student_id VARCHAR(20) PRIMARY KEY,
    name VARCHAR(100),
    class VARCHAR(10),
    password VARCHAR(100)
);

-- Admin table
CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(100)
);

-- Nominations table
CREATE TABLE nominations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20),
    role ENUM('CR', 'ACR'),
    approved BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);

-- Votes table
CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id_hash CHAR(64),
    role ENUM('CR', 'ACR'),
    candidate_id VARCHAR(20)
);

-- Sample admin
INSERT INTO admin (username, password) VALUES ('Sarah Angeline', '12345');

-- Sample students
INSERT INTO students (student_id, name, class, password) VALUES
('160622733126', 'Abia Azeem', 'CSE-C', '160622733126'),
('160622733127', 'Aduri Vandana', 'CSE-C', '160622733127'),
('160622733128', 'Aljapoor Sri Vaishnavi', 'CSE-C', '160622733128'),
('160622733129', 'Anagaya Sameeksha', 'CSE-C', '160622733129'),
('160622733130', 'Appadi Geethika', 'CSE-C', '160622733130'),
('160622733131', 'Ashamolla Harshika', 'CSE-C', '160622733131'),
('160622733132', 'Avangapuram Sreshta', 'CSE-C', '160622733132'),
('160622733133', 'Ayesha Fatima', 'CSE-C', '160622733133'),
('160622733134', 'B Prerana', 'CSE-C', '160622733134'),
('160622733135', 'Banoth Shirisha', 'CSE-C', '160622733135'),
('160622733136', 'Bettela Divya', 'CSE-C', '160622733136'),
('160622733137', 'Bijji Sathvika', 'CSE-C', '160622733137'),
('160622733138', 'Bontha Akshaya', 'CSE-C', '160622733138'),
('160622733139', 'Burgupally Reethu Reddy', 'CSE-C', '160622733139'),
('160622733140', 'C. Saavya', 'CSE-C', '160622733140'),
('160622733141', 'Cheruku Chandana', 'CSE-C', '160622733141'),
('160622733142', 'Choda Jaya Nandini', 'CSE-C', '160622733142'),
('160622733143', 'Dandu Rishitha', 'CSE-C', '160622733143'),
('160622733144', 'Dikshitha Modi', 'CSE-C', '160622733144'),
('160622733145', 'Eslavath Shivani', 'CSE-C', '160622733145'),
('160622733146', 'Fizza Ahmed Khan', 'CSE-C', '160622733146'),
('160622733147', 'Ganja Srividya', 'CSE-C', '160622733147'),
('160622733148', 'Govula Sowmya', 'CSE-C', '160622733148'),
('160622733149', 'Gurram Bhuvana', 'CSE-C', '160622733149'),
('160622733150', 'Hania Akber', 'CSE-C', '160622733150'),
('160622733152', 'Jammula Greeshma Reddy', 'CSE-C', '160622733152'),
('160622733153', 'K Jayanthi', 'CSE-C', '160622733153'),
('160622733154', 'K Deepika', 'CSE-C', '160622733154'),
('160622733155', 'K Anudeepthi', 'CSE-C', '160622733155'),
('160622733156', 'K Sri Vyshnavi', 'CSE-C', '160622733156'),
('160622733157', 'Keerthi Yadav Madasu', 'CSE-C', '160622733157'),
('160622733158', 'K Lalitha Rani', 'CSE-C', '160622733158'),
('160622733159', 'K Sri Sai Laxmi Snigdha', 'CSE-C', '160622733159'),
('160622733160', 'K Tejashwini', 'CSE-C', '160622733160'),
('160622733161', 'Maddi Vaishnavi', 'CSE-C', '160622733161'),
('160622733162', 'M Geetha Sri', 'CSE-C', '160622733162'),
('160622733163', 'Medishetty Satvika', 'CSE-C', '160622733163'),
('160622733164', 'Merugu Sanjana', 'CSE-C', '160622733164'),
('160622733165', 'N.Shreya', 'CSE-C', '160622733165'),
('160622733166', 'Nakka Ritisha', 'CSE-C', '160622733166'),
('160622733167', 'Nausheen Tarannum', 'CSE-C', '160622733167'),
('160622733168', 'P Shailaja', 'CSE-C', '160622733168'),
('160622733169', 'P Joshna', 'CSE-C', '160622733169'),
('160622733170', 'Pandiri Yamini', 'CSE-C', '160622733170'),
('160622733171', 'Payyavula Akhila', 'CSE-C', '160622733171'),
('160622733172', 'Putta Ramya', 'CSE-C', '160622733172'),
('160622733173', 'Rajam Akshayasri', 'CSE-C', '160622733173'),
('160622733174', 'Ravula Soumya', 'CSE-C', '160622733174'),
('160622733175', 'Saba Anjum', 'CSE-C', '160622733175'),
('160622733176', 'Sai Jyothika Alahari', 'CSE-C', '160622733176'),
('160622733177', 'Sanvisree K', 'CSE-C', '160622733177'),
('160622733178', 'Shamshabad Poojitha', 'CSE-C', '160622733178'),
('160622733179', 'Soha Jabeen', 'CSE-C', '160622733179'),
('160622733180', 'Surabhi Soumika', 'CSE-C', '160622733180'),
('160622733181', 'Syeda Kulsoom Hussaini', 'CSE-C', '160622733181'),
('160622733182', 'Tabasum Syed Tajamul', 'CSE-C', '160622733182'),
('160622733183', 'Thoutam Khushi', 'CSE-C', '160622733183'),
('160622733184', 'U.Charmikka', 'CSE-C', '160622733184'),
('160622733185', 'Vakiti Smanavi', 'CSE-C', '160622733185'),
('160622733186', 'Vishwanath Nikitha', 'CSE-C', '160622733186'),
('160622733187', 'Zoya Anjum', 'CSE-C', '160622733187'),
('160622733188', 'Ramagiri Meghana', 'CSE-C', '160622733188'),
('160622733189', 'Pandirla Nikitha', 'CSE-C', '160622733189'),
('160622733315', 'Polawar Snigdha', 'CSE-C', '160622733315'),
('160622733316', 'Tanzeela Rifath', 'CSE-C', '160622733316'),
('160622733317', 'Varma Polkonda Meenakshi', 'CSE-C', '160622733317'),
('160622733318', 'V Shashi', 'CSE-C', '160622733318'),
('160622733319', 'Vanam Shivani', 'CSE-C', '160622733319'),
('160622733320', 'Varikuppala Susanna', 'CSE-C', '160622733320'),
('160622733321', 'Vippari Neha', 'CSE-C', '160622733321');


ALTER TABLE nominations ADD COLUMN manifesto TEXT;
ALTER TABLE nominations 
ADD COLUMN status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
ADD COLUMN feedback VARCHAR(255);
UPDATE nominations SET status = 'pending' WHERE status IS NULL;


ALTER TABLE nominations ADD votes INT DEFAULT 0;
