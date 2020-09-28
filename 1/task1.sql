CREATE TABLE `users` (
    `id`         INT(11) NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(255) DEFAULT NULL,
    `gender`     ENUM('0', '1', '2') NOT NULL COMMENT '0 - не указан, 1 - мужчина, 2 - женщина.',
    `birth_date` INT(11) NOT NULL COMMENT 'Дата в unixtime.',
    PRIMARY KEY (`id`)
);
CREATE TABLE `phone_numbers` (
    `id`      INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `phone`   VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

##############################################################

INSERT INTO `users` (`id`, `name`, `gender`, `birth_date`)
VALUES
(NULL, 'Надежда', '2', UNIX_TIMESTAMP('1990-10-05')),
(NULL, 'Валерий', '1', UNIX_TIMESTAMP('2003-04-25')),
(NULL, 'Виктория', '2', UNIX_TIMESTAMP('2001-09-15')),
(NULL, 'Сергей', '0', UNIX_TIMESTAMP('1999-05-06')),
(NULL, 'Ксения', '0', UNIX_TIMESTAMP('2002-02-12')),
(NULL, 'Софья', '2', UNIX_TIMESTAMP('2000-01-23')),
(NULL, 'Анастасия', '2', UNIX_TIMESTAMP('1995-04-22')),
(NULL, 'Юрий', '1', UNIX_TIMESTAMP('2000-10-02')),
(NULL, 'Федор', '1', UNIX_TIMESTAMP('1992-08-16')),
(NULL, 'Софья', '2', UNIX_TIMESTAMP('2001-09-05'));
        
INSERT INTO `phone_numbers` (`user_id`, `phone`)
VALUES
('1', '+7 903 423 5485'), ('1', '+7 903 914 1024'),
('2', '+7 496 689 4294'), ('3', '+7 926 408 2309'),
('3', '+7 926 432 9843'), ('4', '+7 926 103 1038'),
('4', '+7 903 428 5266'), ('3', '+7 496 048 1805'),
('5', '+7 499 024 1400'), ('5', '+7 926 849 0185'),
('6', null), 				('2', '+7 499 419 8458'),
('7', null), 				('9', '+7 499 907 5153'),
('8', '+7 903 952 8592'), ('5', '+7 926 582 0859'),
('9', '+7 926 245 0953'), ('10', '+7 903 690 4860'),
('10', '+7 903 490 2894'), ('9', '+7 903 401 8451');

        
/*
Решение (функция получения возраста по полю даты была написана для краткости и понятности основного запроса):

CREATE DEFINER=`root`@`localhost` FUNCTION `getAge`(bday integer) RETURNS int(11)
BEGIN
RETURN year(current_timestamp()) - year(from_unixtime(bday));
END

SELECT `users`.`name`, count(`phone_numbers`.`phone`) FROM `users`, `phone_numbers`
WHERE ( getAge(`users`.`birth_date`) >= 18 AND getAge(`users`.`birth_date`) <= 22   )
AND `users`.`gender` = '2'
AND `users`.`id` = `phone_numbers`.`user_id`
GROUP BY `users`.`id`;


Ещё возможные варианты решения:
1) Связка таблиц с использованием INNER JOIN
2) С использованием вложенных подазпросов в предикатах: типа '...WHERE field_A IN ( SELECT field_A FROM ...'

*/