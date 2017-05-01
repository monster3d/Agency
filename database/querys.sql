SELECT SUM(`cost`) AS `total_cost`, AVG(`cost`) AS `average_cost`, MIN(`cost`) AS `minimal_cost`, MAX(`cost`) AS `max_cost` FROM employees WHERE `weight` > 60;



SELECT SUM(`cost`) AS `total_cost`, (SUM(`cost`) / COUNT(`id`)) AS `average_cost`, MIN(`cost`) AS `minimal_cost`, MAX(`cost`) AS `max_cost` FROM employees WHERE `weight` > 60;


SELECT * FROM `categories` WHERE `id` IN (SELECT `category_id` FROM `employee_category` GROUP BY `category_id` HAVING COUNT(`employee_id`) > 10)


SELECT (SELECT `title` FROM `categories` WHERE `id` =`category_id`) AS `title`, SUM(`cost`) AS `total_sum` FROM (SELECT `id`, `cost` FROM `employees` WHERE `id` IN (SELECT `employee_id` FROM `employee_category`)) AS `em`, `employee_category` AS `emc`
WHERE `em`.`id` = `emc`.`employee_id` GROUP BY `category_id` ORDER BY `total_sum` DESC LIMIT 1;


SELECT (SELECT `title` FROM `categories` WHERE `id` =`category_id`) AS `title`, COUNT(`gander`) AS `total_gander` FROM (SELECT `id`, `gander` FROM `employees` WHERE `id` IN (SELECT `employee_id` FROM `employee_category`) AND `gander` = 'male') AS `em`, `employee_category` AS `emc`
WHERE `em`.`id` = `emc`.`employee_id` GROUP BY `category_id` ORDER BY `total_gander` DESC LIMIT 1;



SELECT COUNT(`id`) AS `count_employee` FROM `employees` WHERE `id` IN (SELECT `employee_id` FROM `employee_category` LEFT JOIN `categories` ON `categories`.`title` LIKE "%cleaning%");
