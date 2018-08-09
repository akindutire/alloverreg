-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2018 at 08:15 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allover_reg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_capability` varchar(100) NOT NULL COMMENT 'Limit of An Admin',
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `username` varchar(110) NOT NULL,
  `password` text NOT NULL,
  `admin_first_name` varchar(100) NOT NULL,
  `admin_middle_name` varchar(100) NOT NULL,
  `admin_last_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_capability`, `faculty_id`, `department_id`, `username`, `password`, `admin_first_name`, `admin_middle_name`, `admin_last_name`) VALUES
(1, 'backdoor', 0, 0, 'Tehanom@gmail.com', '$2y$12$cHMd5E4BaIJyx7xMsY9HxutFuC/8314zALGnEI3zCMOW.KKeuPpfi', 'Tehanom', 'Drey', 'Williams'),
(2, 'faculty', 1, 0, 'allover@gmail.com', '$2y$12$p.nw8d/4W/UmdtqwUygQ.O6YARBflDwwSVWN7Q3WY100TZ281GQmu', 'Allover', 'Polytechnic', 'A.'),
(3, 'HODdepartment', 1, 1, 'accountancy@allover.com', '$2y$12$hL.u.cThOBQoI6gFUzWhnudyveMQMzFVb2yLWhHDKAfmuaWDY519q', 'Accountancy', 'H.', 'HOD'),
(4, 'Lecturer', 1, 1, 'accountancylecturer1@allover.com', '$2y$12$pTIOCQT5UqSSfECi9NqTPOmW6Jng9kMY6.CqYFkcy0GIddKCmm8ra', 'Accountancy', 'H.', 'Lecturer'),
(5, 'HODdepartment', 1, 2, 'computerhod@allover.com', '$2y$12$7u56FEBpH7EeehineN6Gue1bIKmrN/vASj8Ct1OVi7LtS7mQGkJzK', 'Computer', 'C.', 'HOD'),
(6, 'Lecturer', 1, 2, 'computerlecturer@allover.com', '$2y$12$6E5t89AO5SlnHDVBQ.SZY.S0czGkg6iroqJzbB1/d5In59G5i0hfu', 'Computer', 'C.', 'Lecturer'),
(7, 'HODdepartment', 1, 3, 'businessHOD@allover.com', '$2y$12$vio6MVs84SrXfOiPH4sihecnJgOQnk3YjVpUyEzA6w3HoyeN8GxwS', 'Business', 'Administration', 'HOD'),
(8, 'Lecturer', 1, 3, 'businesslecturer1@allover.com', '$2y$12$EbNlIhUc7liKwfmjkg7Ajey.tzo3HrwbUigcBHqDIftmwiTSnLMWG', 'Business', 'Administration', 'Lec.');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_tab`
--

CREATE TABLE `assignment_tab` (
  `department_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `lecturer` int(11) NOT NULL,
  `course` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment_tab`
--

INSERT INTO `assignment_tab` (`department_id`, `session_id`, `lecturer`, `course`) VALUES
(0, 0, 0, 0),
(1, 1, 4, 3),
(2, 1, 6, 1),
(1, 1, 4, 2),
(2, 1, 6, 5),
(2, 1, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(65) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_unit` int(11) NOT NULL,
  `course_description` text NOT NULL,
  `course_pre_requisite_id` varchar(300) NOT NULL,
  `course_level_id` int(11) NOT NULL,
  `course_semester_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `session_id` varchar(300) NOT NULL,
  `addedby` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_code`, `course_unit`, `course_description`, `course_pre_requisite_id`, `course_level_id`, `course_semester_id`, `department_id`, `faculty_id`, `session_id`, `addedby`) VALUES
(1, 'Introduction To Computer', 'CSC101', 3, 'NULL', 'NULL', 1, 1, 2, 1, '1;1;1;', 1),
(2, 'Introduction To Business', 'BIS 101', 3, 'NULL', 'NULL', 1, 1, 3, 1, '1;1;1;', 0),
(5, 'Introduction To Java Programming', 'CSC121', 3, 'NULL', '4', 1, 2, 2, 1, '1;1;1;', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `program_id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `faculty_id`, `department_name`, `program_id`) VALUES
(1, 1, 'Accountancy', 'NULL'),
(2, 1, 'Computer Science', 'NULL'),
(3, 1, 'Business A', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`) VALUES
(1, 'Allover Campus, Akure Study Center');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `lectures_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `course` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
  `venue` varchar(200) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level`) VALUES
(1, 'ND1'),
(2, 'ND2'),
(3, 'HND1'),
(4, 'HND2'),
(5, 'PT1'),
(6, 'PT2'),
(7, 'PT3');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `program_code` varchar(20) NOT NULL,
  `program_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program_code`, `program_name`) VALUES
(1, 'ND', 'National Diploma'),
(2, 'HND', 'Higher National Diploma');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_no` varchar(100) NOT NULL,
  `max_bed_space` int(11) NOT NULL,
  `room_location` varchar(100) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `room_hall` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester`) VALUES
(1, 'First Semester'),
(2, 'Second Semester\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(11) NOT NULL,
  `faculty_in` varchar(400) NOT NULL,
  `session_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `faculty_in`, `session_name`) VALUES
(1, '1;', '2016/2017'),
(2, '1;', '2017/2018');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_faculty` int(11) NOT NULL,
  `student_dept` int(11) NOT NULL,
  `student_mat_no` varchar(150) NOT NULL,
  `student_dob` date NOT NULL COMMENT 'Date of birth, Age can be  derived from Date of Birth',
  `student_first_name` varchar(100) NOT NULL,
  `student_middle_name` varchar(100) NOT NULL,
  `student_last_name` varchar(100) NOT NULL,
  `student_level_id` enum('1','2','3','4') NOT NULL,
  `student_semester_id` enum('1','2') NOT NULL,
  `password` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `admitted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_faculty`, `student_dept`, `student_mat_no`, `student_dob`, `student_first_name`, `student_middle_name`, `student_last_name`, `student_level_id`, `student_semester_id`, `password`, `status`, `session_id`, `admitted`) VALUES
(1, 1, 3, 'BIS/2015/001', '1990-01-12', 'Taiwo ', 'Bukoye', 'Abiodun', '1', '1', '$2y$12$Ujz5l9W.lbGCikR.nJf6juHZKadG5bteRPq3XrJCNl4Bc4qx1oTp.', 'undergraduate', '1', 1),
(2, 1, 3, 'BIS/2015/002', '1990-01-12', 'Rufus', 'Damilare', 'D.', '1', '1', '$2y$12$NgouXgt95qDXnMSm0ym8TuMXj527UlaqQLScvcbmFStBxoHmQSTQ2', 'undergraduate', '1', 1),
(3, 1, 3, 'BIS/2015/003', '1990-01-12', 'Daodu', 'Damilola', 'D.', '1', '1', '$2y$12$s6VIXzx.I5KgZb2h8UZQkuEPoKUNyKTY6eNCKetcm3/bNGxc4dSa2', 'undergraduate', '1', 1),
(4, 1, 3, 'BIS/2015/005', '1990-01-12', 'Akindayomi', 'A.', 'Samuel', '1', '1', '$2y$12$yzmrwbjcpIc/sZEWaGHTXuWSr0JXRlYl/EPUGoCrz3OAeCFABNyM6', 'undergraduate', '1', 1),
(5, 1, 3, 'BIS/2015/006', '1993-01-12', 'Patrick', 'Ayodele', 'D.', '1', '1', '$2y$12$2DXm.KP.lVglX3EeP4Cx7u75k0kGJeeeiEnYbPytL1.iZhQrbB5ga', 'undergraduate', '1', 1),
(6, 1, 2, 'CSC/2015/001', '1993-01-12', 'Ajayi', 'Philip', 'D.', '1', '1', '$2y$12$yGiTZc8OORTwykcH5tIw9OmQEc.87NvdO0up9THTA7bD7vn85mExG', 'undergraduate', '1', 1),
(7, 1, 2, 'CSC/2015/002', '1993-01-12', 'Ajayi', 'Desmond', 'D.', '1', '1', '$2y$12$OyS.KEh.q1s.OgXsLe4xo.4IZZb1jEVizZesy3EfsIa69l/j6Nc42', 'undergraduate', '1', 1),
(8, 1, 2, 'CSC/2015/003', '1993-01-12', 'Ogunsakin', 'Tope', 'D.', '1', '1', '$2y$12$8IKYNQw/Mtk3AS2gHQwCFe80z01I6ZSoIt4ZnaqMwV1TT4jBJo7jC', 'undergraduate', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_course_registration`
--

CREATE TABLE `student_course_registration` (
  `reg_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL COMMENT 'student_identifier such as matric no',
  `course_id` int(11) NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `reg_date` varchar(100) NOT NULL,
  `reg_status` varchar(25) NOT NULL,
  `completed_pre_req` varchar(150) DEFAULT NULL COMMENT 'Comma Seperated Completed Course ids, which maybe a pre-requisite',
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_course_registration`
--

INSERT INTO `student_course_registration` (`reg_id`, `student_id`, `course_id`, `course_code`, `reg_date`, `reg_status`, `completed_pre_req`, `session_id`) VALUES
(1, 3, 1, 'CSC101', '1506521405', 'NULL', '0', 1),
(2, 3, 2, 'BIS 101', '1506521415', 'NULL', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venue_id` int(11) NOT NULL,
  `venue_alias` varchar(100) NOT NULL,
  `venue_assigned_to` int(11) NOT NULL,
  `venue_under_faculty_id` int(11) NOT NULL,
  `venue_assignment_hint` varchar(100) NOT NULL,
  `venue_capacity` int(11) NOT NULL,
  `venue_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `venue_alias`, `venue_assigned_to`, `venue_under_faculty_id`, `venue_assignment_hint`, `venue_capacity`, `venue_name`) VALUES
(6, 'MBB 101', 1, 1, 'Faculty', 45, 'NULL'),
(7, 'LECTURE THEATER 1', 1, 1, 'Faculty', 120, 'NULL'),
(8, 'LECTURE THEATER 2', 2, 1, 'Department', 120, 'NULL'),
(9, 'LECTURE THEATER 3', 3, 1, 'Department', 120, 'NULL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `assignment_tab`
--
ALTER TABLE `assignment_tab`
  ADD KEY `lm` (`lecturer`),
  ADD KEY `mk` (`course`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD UNIQUE KEY `faculty_name` (`faculty_name`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`lectures_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD UNIQUE KEY `room_no` (`room_no`),
  ADD UNIQUE KEY `room` (`room_no`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD UNIQUE KEY `session_name` (`session_name`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_mat_no` (`student_mat_no`);

--
-- Indexes for table `student_course_registration`
--
ALTER TABLE `student_course_registration`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue_id`),
  ADD UNIQUE KEY `venue_alias` (`venue_alias`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `lectures_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_course_registration`
--
ALTER TABLE `student_course_registration`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
