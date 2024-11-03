-- Create table MsAdmin
CREATE TABLE MsAdmin (
    admin_id VARCHAR(5) PRIMARY KEY,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    fullname VARCHAR(100),
    username VARCHAR(100)
);

-- Create table MsPatient
CREATE TABLE MsPatient (
    patient_id VARCHAR(5) PRIMARY KEY,
    name VARCHAR(100),
    dob DATE,
    gender VARCHAR(10),
    phone VARCHAR(15),
    email VARCHAR(100),
    nik VARCHAR(16),
    bpjs_card VARCHAR(30),
    address VARCHAR(100),
    is_registered INTEGER(1)
);

-- Create table MsDoctor
CREATE TABLE MsDoctor (
    doctor_id VARCHAR(5) PRIMARY KEY,
    name VARCHAR(100),
    type ENUM('Specialist', 'General')
);

-- Create table MsAppointment
CREATE TABLE MsAppointment (
    appointment_id VARCHAR(5) PRIMARY KEY,
    doctor_id VARCHAR(5),
    patient_id VARCHAR(5),
    date DATE,
    status VARCHAR(20),
    price INTEGER(10),
    FOREIGN KEY (doctor_id) REFERENCES MsDoctor(doctor_id),
    FOREIGN KEY (patient_id) REFERENCES MsPatient(patient_id)
);

-- Create table MsTest
CREATE TABLE MsTest (
    test_id VARCHAR(5) PRIMARY KEY,
    patient_id VARCHAR(5),
    type VARCHAR(50),
    name VARCHAR(30),
    price INTEGER(10),
    date DATE,
    status VARCHAR(20),
    FOREIGN KEY (patient_id) REFERENCES MsPatient(patient_id)
);

-- Create table MsCheckup
CREATE TABLE MsCheckup (
    checkup_id VARCHAR(5) PRIMARY KEY,
    patient_id VARCHAR(5),
    date DATE,
    status VARCHAR(20),
    details VARCHAR(30),
    price INTEGER(10),
    FOREIGN KEY (patient_id) REFERENCES MsPatient(patient_id)
);

-- Create table MsEmergency
CREATE TABLE MsEmergency (
    emergency_id VARCHAR(5) PRIMARY KEY,
    patient_id VARCHAR(5),
    payment_type VARCHAR(50),
    is_ambulance INTEGER(1),
    actions VARCHAR(100),
    FOREIGN KEY (patient_id) REFERENCES MsPatient(patient_id)
);

-- Create table MsRoomHeader
CREATE TABLE MsRoomHeader (
    room_id VARCHAR(5) PRIMARY KEY,
    name VARCHAR(30),
    total INTEGER(10),
    price INTEGER(10),
    date DATE,
    last_update DATE
);

-- Create table MsRoomDetails
CREATE TABLE MsRoomDetails (
    room_id VARCHAR(5),
    status VARCHAR(50),
    code INTEGER(10),
    PRIMARY KEY (room_id, code),
    FOREIGN KEY (room_id) REFERENCES MsRoomHeader(room_id)
);

-- Create table TransactionHeader
CREATE TABLE TransactionHeader (
    transaction_id VARCHAR(5) PRIMARY KEY,
    patient_id VARCHAR(5),
    admin_id VARCHAR(5),
    transaction_date DATE,
    FOREIGN KEY (patient_id) REFERENCES MsPatient(patient_id),
    FOREIGN KEY (admin_id) REFERENCES MsAdmin(admin_id)
);

-- Create table TransactionDetail
CREATE TABLE TransactionDetail (
    transaction_id VARCHAR(5),
    appointment_id VARCHAR(5),
    checkup_id VARCHAR(5),
    test_id VARCHAR(5),
    room_id VARCHAR(5),
    emergency_id VARCHAR(5),
    PRIMARY KEY (transaction_id, appointment_id, checkup_id, test_id, room_id, emergency_id),
    FOREIGN KEY (transaction_id) REFERENCES TransactionHeader(transaction_id),
    FOREIGN KEY (appointment_id) REFERENCES MsAppointment(appointment_id),
    FOREIGN KEY (checkup_id) REFERENCES MsCheckup(checkup_id),
    FOREIGN KEY (test_id) REFERENCES MsTest(test_id),
    FOREIGN KEY (room_id) REFERENCES MsRoomHeader(room_id),
    FOREIGN KEY (emergency_id) REFERENCES MsEmergency(emergency_id)
);

-- Insert dummy data for MsAdmin
INSERT INTO MsAdmin VALUES 
('AM001', 'password1', 'admin1@example.com', 'Admin One', 'adminone'),
('AM002', 'password2', 'admin2@example.com', 'Admin Two', 'admintwo'),
('AM003', 'password3', 'admin3@example.com', 'Admin Three', 'adminthree');

-- Insert dummy data for MsPatient
INSERT INTO MsPatient VALUES 
('PA001', 'John Doe', '1990-01-01', 'Male', '081234567890', 'john@example.com', '3651010000000001', 'BPS123', 'Address 1', 1),
('PA002', 'Jane Smith', '1985-05-15', 'Female', '081234567891', 'jane@example.com', '3651020000000002', 'BPS124', 'Address 2', 1),
('PA003', 'Bob Brown', '1992-08-20', 'Male', '081234567892', 'bob@example.com', '3651030000000003', 'BPS125', 'Address 3', 1),
('PA004', 'Alice Green', '1995-02-28', 'Female', '081234567893', 'alice@example.com', '3651040000000004', 'BPS126', 'Address 4', 0),
('PA005', 'Tom White', '1988-09-10', 'Male', '081234567894', 'tom@example.com', '3651050000000005', 'BPS127', 'Address 5', 1),
('PA006', 'Lucy Black', '1991-12-12', 'Female', '081234567895', 'lucy@example.com', '3651060000000006', 'BPS128', 'Address 6', 1),
('PA007', 'Mike Blue', '1987-07-07', 'Male', '081234567896', 'mike@example.com', '3651070000000007', 'BPS129', 'Address 7', 1),
('PA008', 'Sara Red', '1993-04-04', 'Female', '081234567897', 'sara@example.com', '3651080000000008', 'BPS130', 'Address 8', 0),
('PA009', 'Nick Gray', '1986-03-03', 'Male', '081234567898', 'nick@example.com', '3651090000000009', 'BPS131', 'Address 9', 1),
('PA010', 'Emma Orange', '1989-10-10', 'Female', '081234567899', 'emma@example.com', '3651100000000010', 'BPS132', 'Address 10', 1);

-- Insert dummy data for MsDoctor
INSERT INTO MsDoctor VALUES 
('DR001', 'Dr. Alice', 'Specialist'),
('DR002', 'Dr. Bob', 'General'),
('DR003', 'Dr. Carol', 'Specialist'),
('DR004', 'Dr. Dan', 'General'),
('DR005', 'Dr. Eve', 'Specialist'),
('DR006', 'Dr. Frank', 'General'),
('DR007', 'Dr. Grace', 'Specialist'),
('DR008', 'Dr. Heidi', 'General'),
('DR009', 'Dr. Ivan', 'Specialist'),
('DR010', 'Dr. Judy', 'General');
