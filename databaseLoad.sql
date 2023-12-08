-- Users Table
CREATE TABLE Users (
    UIN INT PRIMARY KEY,
    First_Name VARCHAR(255),
    M_Initial CHAR(1),
    Last_Name VARCHAR(255),
    Username VARCHAR(255),
    Passwords VARCHAR(255),
    User_Type VARCHAR(255),
    Email VARCHAR(255),
    Discord_Name VARCHAR(255)
);

-- College Student Table
CREATE TABLE College_Student (
    UIN INT PRIMARY KEY,
    Gender VARCHAR(255),
    Hispanic_Latino BINARY,
    Race VARCHAR(255),
    US_Citizen BINARY,
    First_Generation BINARY,
    DoB DATE,
    GPA FLOAT,
    Major VARCHAR(255),
    Minor1 VARCHAR(255),
    Minor2 VARCHAR(255),
    Expected_Graduation SMALLINT,
    School VARCHAR(255),
    Classification VARCHAR(255),
    Phone INT,
    Student_Type VARCHAR(255),
    FOREIGN KEY (UIN) REFERENCES Users(UIN)
);

-- Classes Table
CREATE TABLE Classes (
    Class_ID INT PRIMARY KEY,
    Name VARCHAR(255),
    Description VARCHAR(255),
    Type VARCHAR(255)
);

-- Class Enrollment Table
CREATE TABLE Class_Enrollment (
    -- CE_Num INT PRIMARY KEY,
    CE_Num INT PRIMARY KEY AUTO_INCREMENT,
    UIN INT,
    Class_ID INT,
    Status VARCHAR(255),
    Semester VARCHAR(255),
    Year YEAR,
    FOREIGN KEY (UIN) REFERENCES Users(UIN),
    FOREIGN KEY (Class_ID) REFERENCES Classes(Class_ID)
);

-- Internship Table
CREATE TABLE Internship (
    Intern_ID INT PRIMARY KEY,
    Name VARCHAR(255),
    Description VARCHAR(255),
    Is_Gov BINARY
);

-- Intern App Table
CREATE TABLE Intern_App (
    -- IA_Num INT PRIMARY KEY,
    IA_Num INT PRIMARY KEY AUTO_INCREMENT,
    UIN INT,
    Intern_ID INT,
    Status VARCHAR(255),
    Year YEAR,
    FOREIGN KEY (UIN) REFERENCES Users(UIN),
    FOREIGN KEY (Intern_ID) REFERENCES Internship(Intern_ID)
);

-- Certification Table
CREATE TABLE Certification (
    -- Cert_ID INT PRIMARY KEY,
    Cert_ID INT PRIMARY KEY AUTO_INCREMENT,
    Level VARCHAR(255),
    Name VARCHAR(255),
    Description VARCHAR(255)
);

-- Programs Table
CREATE TABLE Programs (
    Program_Num INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Description VARCHAR(255),
    IsVisible BOOLEAN DEFAULT 1
);

-- Cert Enrollment Table
CREATE TABLE Cert_Enrollment (
    -- CertE_Num INT PRIMARY KEY,
    CertE_Num INT PRIMARY KEY AUTO_INCREMENT,
    UIN INT,
    Cert_ID INT,
    Status VARCHAR(255),
    Training_Status VARCHAR(255),
    Program_Num INT,
    Semester VARCHAR(255),
    YEAR YEAR,
    FOREIGN KEY (UIN) REFERENCES Users(UIN),
    FOREIGN KEY (Cert_ID) REFERENCES Certification(Cert_ID),
    FOREIGN KEY (Program_Num) REFERENCES Programs(Program_Num)
);

-- Track Table
CREATE TABLE Track (
    -- Tracking_Num INT PRIMARY KEY,
    Tracking_Num INT PRIMARY KEY AUTO_INCREMENT,
    Program_Num INT,
    UIN INT,    
    FOREIGN KEY (UIN) REFERENCES Users(UIN),
    FOREIGN KEY (Program_Num) REFERENCES Programs(Program_Num)
);

-- Applications Table
CREATE TABLE Applications (
    App_Num INT PRIMARY KEY,
    Program_Num INT,
    UIN INT,
    Uncom_Cert VARCHAR(255),
    Com_Cert VARCHAR(255),
    Purpose_Statement LONGTEXT,
    FOREIGN KEY (Program_Num) REFERENCES Programs(Program_Num),
    FOREIGN KEY (UIN) REFERENCES Users(UIN)
);

-- Document Table
CREATE TABLE Documentation (
    Doc_Num INT PRIMARY KEY,
    App_Num INT,
    Link VARCHAR(255),
    Doc_Type VARCHAR(255),
    FOREIGN KEY (App_Num) REFERENCES Applications(App_Num)
);

-- Event Table
CREATE TABLE Events (
    Event_ID INT PRIMARY KEY,
    UIN INT,
    Program_Num INT,
    Start_Date DATE,
    Start_Time TIME,
    Location VARCHAR(255),
    End_Date DATE,
    End_Time TIME,
    Event_Type VARCHAR(255),
    FOREIGN KEY (UIN) REFERENCES Users(UIN),
    FOREIGN KEY (Program_Num) REFERENCES Programs(Program_Num)
);

-- Event Tracking Table
CREATE TABLE Event_Tracking (
    ET_Num INT PRIMARY KEY,
    Event_ID INT,
    UIN INT,
    FOREIGN KEY (Event_ID) REFERENCES Events(Event_ID),
    FOREIGN KEY (UIN) REFERENCES Users(UIN)
);



-- -- -- -- -- Progress Tracking -- -- -- -- -- --

-- Indexes
CREATE INDEX idx_Track ON Track(UIN);
CREATE INDEX idx_Class_Enrollment ON Class_Enrollment(UIN);
CREATE INDEX idx_Cert_Enrollment ON Cert_Enrollment(UIN);
CREATE INDEX idx_Intern_App ON Intern_App (UIN);

CREATE INDEX idx_programs_name ON Programs (Name);


-- Views
CREATE VIEW StudentPrograms AS
SELECT p.Name AS ProgramName, t.UIN
FROM programs p
JOIN track t ON p.Program_Num = t.Program_Num;

CREATE VIEW ActivePrograms AS
SELECT Program_Num, Name, Description
FROM Programs
WHERE IsVisible = 1;

-- Sample Data
INSERT INTO `users` (`UIN`, `First_Name`, `M_Initial`, `Last_Name`, `Username`, `Passwords`, `User_Type`, `Email`, `Discord_Name`) VALUES
(111111111, 'Ryan', NULL, 'Pavlik', 'Ryan', 'Pavlik', 'Admin', NULL, NULL),
(222222222, 'Maharshi', NULL, 'Rathod', 'Maharshi', 'Rathod', 'Student', NULL, NULL),
(332003564, 'Arpan', '', 'Kumar', 'Arpan', 'Kumar', 'Admin', 'arpsku17@tamu.edu', 'ak101z2'),
(666666666, 'Ryan', '', 'Paul', 'Ryan', 'Paul', 'Student', 'rpaul@tamu.edu', 'rpaul');

INSERT INTO `college_student` (`UIN`, `Gender`, `Hispanic_Latino`, `Race`, `US_Citizen`, `First_Generation`, `DoB`, `GPA`, `Major`, `Minor1`, `Minor2`, `Expected_Graduation`, `School`, `Classification`, `Phone`, `Student_Type`) VALUES
(111111111, 'Male', 0x00, 'White', 0x00, 0x00, NULL, NULL, 'Mechanical Engineering', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(222222222, 'Male', 0x00, 'Black', 0x00, 0x01, NULL, NULL, 'Electrical Engineering', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(332003564, 'Male', 0x01, 'Asian', 0x01, 0x00, '0000-00-00', 3.93, 'Computer Science', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(666666666, 'Male', 0x01, 'Asian', 0x01, 0x01, NULL, NULL, 'Computer Science', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `programs` (`Program_Num`, `Name`, `Description`) VALUES
(0, 'CLDP', 'Commercial Law Development Program'),
(1, 'VICEROY', 'VICEROY trains future cyber leaders in critical defense technology areas, funded by the Office of the Undersecretary of Defense for Research and Engineering in collaboration with the Air Force Research Laboratory and Griffiss Institute.'),
(2, 'Pathways', 'The TAMUS Pathways Student Research Symposium serves as a platform for undergraduate and graduate students from all Texas A&M University System institutions to showcase and network their research across various categories.'),
(3, 'CyberCorps', 'Texas A&M University offers the Federal CyberCorps Scholarship for Service program, providing scholarships for Cybersecurity students with a post-graduation government service obligation.'),
(4, 'CySP', 'The DoD Cybersecurity Scholarship Program recruits and retains qualified cybersecurity professionals, managed by the NSA on behalf of the Department of Defense.');

INSERT INTO `classes` (`Class_ID`, `Name`, `Description`, `Type`) VALUES
(0, 'Beginner Spanish', 'Beginner Spanish', 'Core'),
(1, 'Intermediate Spanish', 'Intermediate Spanish', 'Additional'),
(4, 'Intro Data Science', 'Intro Data Science', 'Core'),
(5, 'Advanced Data Science', 'Advanced Data Science', 'Additional'),
(6, 'Intro Cryptography', 'Intro Cryptography', 'Core'),
(7, 'Mathematical Cryptography', 'Mathematical Cryptography', 'Additional');

INSERT INTO `certification` (`Cert_ID`, `Level`, `Name`, `Description`) VALUES
(0, 'Advanced', 'DoD 8570.01M', 'DoD 8570.01M'),
(1, 'Intermediate', 'CompTIA Security+', 'CompTIA Security+'),
(2, 'Intro', 'EC Council of Certified Ethical Hackers', 'EC Council of Certified Ethical Hackers');

INSERT INTO `internship` (`Intern_ID`, `Name`, `Description`, `Is_Gov`) VALUES
(0, 'Sandia National Laboratories\r\n', 'Sandia National Laboratories', 0x01),
(1, 'Los Alamos National Laboratories', 'Los Alamos National Laboratories', 0x01),
(2, 'Google', 'Google', 0x00),
(3, 'Facebook', 'Facebook', 0x00),
(4, 'Lawrence Livermore laboratories', 'Lawrence Livermore laboratories', 0x01),
(5, 'Hewlett Packard Enterprise', 'Hewlett Packard Enterprise', 0x00);
