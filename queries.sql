ALTER TABLE project ADD user_id INT;
ALTER TABLE task ADD name_project CHAR(28);
ALTER TABLE task ADD user_id INT;

INSERT INTO project (id, name,user_id)
VALUES (1,'Входящие__',1);

INSERT INTO project (id, name,user_id)
VALUES (2,'Учеба__',2);

INSERT INTO project (id, name,user_id)
VALUES (3,'Работа__',3);

INSERT INTO project (id, name,user_id)
VALUES (4,'Домашние дела',1);

INSERT INTO project (id, name,user_id)
VALUES (5,'Мото',5);

INSERT INTO task (id,  execution_date, status, name, name_project, user_id)
VALUES (1,'01.12.2019',0,'Собеседование в IT компании','Работа',1);

INSERT INTO task (id,  execution_date, status, name, name_project,user_id)
VALUES (2,'12.02.2019',0,'Выполнить тестовое задание','Работа',3);

INSERT INTO task (id,  execution_date, status, name, name_project,user_id)
VALUES (3,'12.02.2019',1,'Сделать задание первого раздела','Учеба',1);

INSERT INTO task (id,  execution_date, status, name, name_project,user_id)
VALUES (4,'22.12.2019',0,'Встреча с другом','Входящие',2);

INSERT INTO task (id, status, name, name_project,user_id)
VALUES (5, 0, 'Купить корм для кота','Домашние дела',1);

INSERT INTO task (id, status, name, name_project,user_id)
VALUES (6, 0, 'Заказать пиццу','Домашние дела',3);

INSERT INTO users (id,  registration_date, email, name, pass )
VALUES (1,'2019-12-12','xxx@ya.ru','Вася', '111');

INSERT INTO users (id,  registration_date, email, name, pass)
VALUES (2,'2018-12-12','xxx1@mail.ru','Петя', '222');

INSERT INTO users (id,  registration_date, email, name, pass)
VALUES (3,'2019-02-22','yyy1@mail.ru','Глафира', '333');



SELECT * FROM project WHERE user_id = 1;

SELECT name FROM task WHERE name_project = 'Работа';

SELECT name FROM task WHERE user_id = 1;

SELECT p.id, p.name,u.name FROM project p
JOIN users u
ON p.user_id = u.id;

UPDATE task SET status = 1 
WHERE id = 1;

UPDATE task SET name = 'Заказать пиццу с пивом'
WHERE id = 6;





