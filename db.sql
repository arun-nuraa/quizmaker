CREATE DATABASE  IF NOT EXISTS `quiz_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `quiz_system`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: quiz_system
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `question_id` int NOT NULL AUTO_INCREMENT,
  `quiz_id` int NOT NULL,
  `question_text` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `quiz_id` (`quiz_id`),
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,6,'What does PHP stand for?','Personal Home Page','Private Home Page','PHP Hypertext Preprocessor','Preprocessor Home Page','C'),(2,6,'Which of the following is the correct way to declare a variable in PHP?',' $variable_name','var variable_name','variable_name$','variable_name:','A'),(3,6,'Which symbol is used to concatenate strings in PHP?','+','.','&','|','B'),(4,6,'What is the correct way to create a function in PHP?',' function myFunction {}','function:myFunction() {}',' function myFunction() {}','myFunction() function {}','C'),(5,6,'Which of the following is used to include a file in PHP?','include_file(\"filename.php\");','include \"filename.php\";','include-file(\"filename.php\");',' import \"filename.php\";','B'),(6,6,'What is the correct way to start a session in PHP?','session_start();',' start_session();',' begin_session();',' session_begin();','A'),(7,6,'Which of the following is NOT a valid PHP data type?','Integer','Float','String','Character','D'),(8,6,'How do you create an array in PHP?','array[] = {1, 2, 3};','$array = array(1, 2, 3);','$array = [1, 2, 3];','Both B and C','D'),(9,6,'Which function is used to get the length of a string in PHP?','str_length()','strlen()','string_length()','length()','B'),(10,6,'How do you comment in PHP?','// This is a comment',' /* This is a comment */',' # This is a comment','All of the above','D'),(11,7,'What does MySQLi stand for?','MySQL Improved','MySQL Interface','MySQL Integration','MySQL Interactive','A'),(12,7,'Which function is used to establish a connection to a MySQL database using MySQLi?','mysqli_connect()','mysql_connect()','connect_mysqli()','mysql_connect_db()','A'),(13,7,'What is the correct way to check if a MySQLi connection was successful?','if (!$connection) {}',' if ($connection) {}','if (mysqli_connect_error()) {}','Both A and C','D'),(14,7,'Which method is used to execute a prepared statement in MySQLi?','execute()','run()','perform()','execute_statement()','A'),(15,7,'How can you fetch all results from a MySQLi query?','mysqli_fetch_array()','mysqli_fetch()','mysqli_fetch_all()','mysqli_get_all()','C'),(16,7,'What is the purpose of the mysqli_real_escape_string() function?','To escape special characters in a string for use in an SQL statement','To create a new database',' To connect to a database','To close the database connection','A'),(17,7,'Which function is used to close a MySQLi connection?','close_mysqli()','mysqli_close()','disconnect_mysqli()','end_connection()','B'),(18,7,'What does the mysqli_query() function return on success?','TRUE','FALSE','A result set','NULL','C'),(19,7,'Which of the following is used to get the number of affected rows after an UPDATE query?','mysqli_get_rows()','mysqli_num_rows()','mysqli_count_rows()','mysqli_affected_rows()','D'),(20,7,'What is the purpose of using prepared statements in MySQLi?','To increase performance','To prevent SQL injection','Both A and B','To simplify code','C');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_attempts`
--

DROP TABLE IF EXISTS `quiz_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz_attempts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `attempt_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  KEY `quiz_id` (`quiz_id`),
  CONSTRAINT `quiz_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `quiz_attempts_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_attempts`
--

LOCK TABLES `quiz_attempts` WRITE;
/*!40000 ALTER TABLE `quiz_attempts` DISABLE KEYS */;
INSERT INTO `quiz_attempts` VALUES (1,9,6,10.00,'2024-11-13 18:08:46');
/*!40000 ALTER TABLE `quiz_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizzes` (
  `quiz_id` int NOT NULL AUTO_INCREMENT,
  `quiz_title` varchar(255) NOT NULL,
  `quiz_description` text NOT NULL,
  `user_id` int NOT NULL,
  `quiz_code` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`quiz_id`),
  UNIQUE KEY `quiz_code` (`quiz_code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
INSERT INTO `quizzes` VALUES (6,'PHP','This quiz is designed to test your knowledge of PHP programming. Each question has four possible answers, but only one is correct. Whether you\'re a beginner or have some experience with PHP, this quiz will help you assess your understanding of the language. Good luck!',8,'4C9A81ACE3','2024-11-13 17:51:16'),(7,'MYSQL','This quiz is designed to test your knowledge of MySQLi (MySQL Improved) in PHP. It covers various aspects of connecting to a MySQL database, executing queries, and handling results. Whether you\'re a beginner or have some experience with MySQLi, this quiz will help you assess your understanding of database interactions in PHP. Good luck!',8,'3871F80E6E','2024-11-13 18:05:59');
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (8,'rolex@gmail.com','123','Rolex'),(9,'nura@gmail.com','123','nura');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-14  0:08:17
