CREATE TABLE `users` (
   `id` INT(11) NOT NULL AUTO_INCREMENT,
   `username` VARCHAR(255) UNIQUE NOT NULL,
   `email` VARCHAR(255) UNIQUE NOT NULL,
   `password` VARCHAR(255) NOT NULL,
   `token` VARCHAR(64) DEFAULT NULL,
   `verified` TINYINT(1) DEFAULT '0',
   `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
);
