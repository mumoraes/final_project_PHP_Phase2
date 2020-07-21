-- id12510247_final_project_php
-- DB created in AWS Server
CREATE TABLE IF NOT EXISTS `Murilo200449241`.`users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar (30) NOT NULL,
  `email` varchar (50) NOT NULL,
  `current_city` varchar (30) NOT NULL,
  `skills` varchar (200) NOT NULL,
  PRIMARY KEY (user_id)
); 

/*
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar (30) NOT NULL,
  `email` varchar (50) NOT NULL,
  `current_city` varchar (30) NOT NULL,
  `skills` varchar (200) NOT NULL,
  PRIMARY KEY (user_id)
); 
*/
