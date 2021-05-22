CREATE TABLE `task_statuses`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tasks`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL,
  `task_type_id` int(0) UNSIGNED NOT NULL,
  `task_status_id` int(0) UNSIGNED NOT NULL,
  `location` varchar(255) NULL,
  `date_and_time` datetime(0) NOT NULL,
  `duration` datetime(0) NULL,
  `comment` text NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  `user_id` int(0) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `types_of_tasks`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `users`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

ALTER TABLE `tasks` ADD CONSTRAINT `fk_tasks_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `tasks` ADD CONSTRAINT `fk_tasks_task_statuses_task_status_id` FOREIGN KEY (`task_status_id`) REFERENCES `task_statuses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `tasks` ADD CONSTRAINT `fk_tasks_types_of_tasks_task_type_id` FOREIGN KEY (`task_type_id`) REFERENCES `types_of_tasks` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

