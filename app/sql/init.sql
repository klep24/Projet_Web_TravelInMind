CREATE USER 'TrainAssist_user';
CREATE DATABASE 'TrainAssist_db';
UPDATE mysql.user SET Password=PASSWORD('Bourges2017') WHERE USER='TrainAssist_user';
GRANT ALL ON TrainAssist_db.* TO 'TrainAssist_user'@'%';
