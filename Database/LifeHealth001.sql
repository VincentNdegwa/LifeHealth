DROP TABLE IF EXISTS `doctors`;

CREATE TABLE `doctors` (
    `id` int NOT NULL AUTO_INCREMENT, `first_name` varchar(255) DEFAULT NULL, `last_name` varchar(255) DEFAULT NULL, `username` varchar(255) DEFAULT NULL, `speciality` varchar(255) DEFAULT NULL, `open_availability` datetime DEFAULT NULL, `close_availability` datetime DEFAULT NULL, `availability` enum('true', 'false') DEFAULT 'true', PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 14 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

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

;

DROP TABLE IF EXISTS `medicines`;

CREATE TABLE `medicines` (
    `id` int NOT NULL AUTO_INCREMENT, `name` varchar(255) DEFAULT NULL, `measurements` varchar(20) DEFAULT NULL, `count` int DEFAULT NULL, PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

INSERT INTO
    `medicines`
VALUES (1, 'Loratadine', '500', 13),
    (5, 'Loratadine', '100', 4),
    (6, 'Prednisone', '500', 1),
    (7, 'Prednisone', '100', 4);

DROP TABLE IF EXISTS `patients`;

CREATE TABLE `patients` (
    `id` int NOT NULL AUTO_INCREMENT, `first_name` varchar(255) DEFAULT NULL, `last_name` varchar(255) DEFAULT NULL, `id_number` varchar(20) DEFAULT NULL, `age` int DEFAULT NULL, `phone_number` varchar(15) DEFAULT NULL, `gender` varchar(10) DEFAULT NULL, `conditions` text, `status` enum('treated', 'not treated') DEFAULT 'not treated', PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

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

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
    `id` int NOT NULL AUTO_INCREMENT, `patient_id` int DEFAULT NULL, `doctor_id` int DEFAULT NULL, PRIMARY KEY (`id`), KEY `patient_id` (`patient_id`), KEY `doctor_id` (`doctor_id`), CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`), CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

INSERT INTO `appointments` VALUES (1, 1, 5);