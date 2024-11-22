CREATE TABLE IF NOT EXISTS `#__sendy_subscribers` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    `created` datetime NOT NULL,
    `status` tinyint(1) NOT NULL DEFAULT '1',
    `sendy_status` varchar(255) NOT NULL,
    `ip_address` varchar(45) NULL,
    `consent_date` datetime NULL,
    `confirmed` tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci; 