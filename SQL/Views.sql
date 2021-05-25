CREATE VIEW `all_tasks` AS SELECT
	`tasks`.`id` AS `id`,
	`tasks`.`user_id` AS `user_id`,
	`tasks`.`topic` AS `topic`,
	`tasks`.`task_status_id` AS `status`,
	`types_of_tasks`.`title` AS `type`,
	`tasks`.`location` AS `location`,
	date_format( `tasks`.`date_and_time`, '%d.%m.%Y' ) AS `start_date`,
	date_format( `tasks`.`date_and_time`, '%H:%i' ) AS `start_time`,
	`tasks`.`duration` AS `duration`,
	`tasks`.`comment` AS `comment`,
	`tasks`.`created_at` AS `created_at`,
	`tasks`.`deleted` AS `deleted` 
FROM
	(
	`tasks`
	JOIN `types_of_tasks` ON ( `tasks`.`task_type_id` LIKE `types_of_tasks`.`id` ))