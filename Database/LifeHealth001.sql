-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: LifeHealth
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!50503 SET NAMES utf8mb4 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;

CREATE TABLE `appointments` (
    `id` int NOT NULL AUTO_INCREMENT, `patient_id` int DEFAULT NULL, `doctor_id` int DEFAULT NULL, PRIMARY KEY (`id`), KEY `patient_id` (`patient_id`), KEY `doctor_id` (`doctor_id`), CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`), CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;

--
-- Dumping data for table `appointments`
--

/*!40000 ALTER TABLE `appointments` DISABLE KEYS */
;

INSERT INTO `appointments` VALUES (1, 1, 5);
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */
;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;

CREATE TABLE `doctors` (
    `id` int NOT NULL AUTO_INCREMENT, `first_name` varchar(255) DEFAULT NULL, `last_name` varchar(255) DEFAULT NULL, `username` varchar(255) DEFAULT NULL, `speciality` varchar(255) DEFAULT NULL, `open_availability` datetime DEFAULT NULL, `close_availability` datetime DEFAULT NULL, `availability` enum('true', 'false') DEFAULT 'true', PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 14 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;

--
-- Dumping data for table `doctors`
--

/*!40000 ALTER TABLE `doctors` DISABLE KEYS */
;

INSERT INTO
    `doctors`
VALUES (
        1, 'John', 'Doe', 'Dr John', 'Cardiologists', '2024-03-10 05:37:31', '2024-03-11 11:37:31', 'true'
    ),
    (
        2, 'John', 'Doe', 'Dr John', 'Cardiologists', '2024-03-10 11:37:43', '2024-03-11 00:37:43', 'true'
    ),
    (
        3, 'Vincent', 'Doe', 'Dr Vincent', 'Endocrinologists', '2024-03-10 11:38:48', '2024-03-10 21:38:48', 'true'
    ),
    (
        4, 'Vincent', 'Doe', 'Dr Vincent', 'Endocrinologists', '2024-03-10 14:41:17', '2024-03-11 00:41:17', 'false'
    ),
    (
        5, 'Kim', 'Mimo', 'Dr Kimo', 'Dermatologists', '2024-03-10 14:41:46', '2024-03-11 00:41:46', 'false'
    ),
    (
        6, 'Kim', 'Mimo', 'Dr Kimo', 'Dermatologists', '2024-03-10 14:42:19', '2024-03-11 00:42:19', 'false'
    ),
    (
        7, 'Kim', 'Mimo', 'Dr Kimo', 'Dermatologists', '2024-03-10 14:43:56', '2024-03-11 00:43:56', 'false'
    ),
    (
        8, 'Kim', 'Mimo', 'Dr Kimo', 'Dermatologists', '2024-03-10 14:44:40', '2024-03-11 00:44:40', 'false'
    ),
    (
        9, 'James', 'Ndungu', 'Dr James', 'Oncologists', '2024-03-10 14:52:41', '2024-03-11 00:52:41', 'false'
    ),
    (
        10, 'Mary', 'Dindo', 'Dr Mary', 'Pathologists', '2024-03-10 14:55:07', '2024-03-11 00:55:07', 'false'
    ),
    (
        11, 'kev', 'Munga', 'Dr Munga', 'Physiatrists', '2024-03-10 14:58:45', '2024-03-11 00:58:45', 'true'
    ),
    (
        12, 'Mary', 'Ndungu', 'Dr Mary', 'Physiatrists', '2024-03-10 15:41:58', '2024-03-11 01:41:58', 'true'
    ),
    (
        13, 'Jane', 'Jitu', 'Dr Jane', 'Cardiologists', '2024-03-10 14:26:35', '2024-03-11 00:26:35', 'true'
    );
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */
;

--
-- Table structure for table `medicines`
--

DROP TABLE IF EXISTS `medicines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;

CREATE TABLE `medicines` (
    `id` int NOT NULL AUTO_INCREMENT, `name` varchar(255) DEFAULT NULL, `measurements` varchar(20) DEFAULT NULL, `count` int DEFAULT NULL, PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;

--
-- Dumping data for table `medicines`
--

/*!40000 ALTER TABLE `medicines` DISABLE KEYS */
;

INSERT INTO
    `medicines`
VALUES (1, 'Loratadine', '500', 13),
    (5, 'Loratadine', '100', 4),
    (6, 'Prednisone', '500', 1),
    (7, 'Prednisone', '100', 4);
/*!40000 ALTER TABLE `medicines` ENABLE KEYS */
;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;

CREATE TABLE `patients` (
    `id` int NOT NULL AUTO_INCREMENT, `first_name` varchar(255) DEFAULT NULL, `last_name` varchar(255) DEFAULT NULL, `id_number` varchar(20) DEFAULT NULL, `age` int DEFAULT NULL, `phone_number` varchar(15) DEFAULT NULL, `gender` varchar(10) DEFAULT NULL, `conditions` text, `status` enum('treated', 'not treated') DEFAULT 'not treated', PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;

--
-- Dumping data for table `patients`
--

/*!40000 ALTER TABLE `patients` DISABLE KEYS */
;

INSERT INTO
    `patients`
VALUES (
        1, 'Vincent', 'ndungu', '234456', 21, '4635756876', 'male', 'headache', 'not treated'
    ),
    (
        2, 'Vincent', 'ndungu', '234456', 21, '4635756876', 'male', 'headache', 'not treated'
    ),
    (
        3, 'Vincent', 'ndungu', '234456', 21, '4635756876', 'male', 'headache', 'not treated'
    ),
    (
        4, 'John', 'Makosi', '120956', 20, '4635756876', 'male', 'skin change', 'not treated'
    );
/*!40000 ALTER TABLE `patients` ENABLE KEYS */
;

--
-- Dumping routines for database 'LifeHealth'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;

-- Dump completed on 2024-03-10 16:50:51