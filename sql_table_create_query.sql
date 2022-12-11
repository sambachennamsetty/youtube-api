CREATE TABLE `youtube` (
  `channel_name` varchar(100) DEFAULT NULL,
  `description` longtext,
  `published_time` varchar(45) DEFAULT NULL,
  `video_id` varchar(200) DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `channel_id` varchar(100) DEFAULT NULL,
  `thumbnail_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;