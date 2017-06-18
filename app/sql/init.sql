CREATE USER 'TrainAssist_user';
CREATE DATABASE 'TrainAssist_db';
UPDATE mysql.user SET Password=PASSWORD('Bourges2017') WHERE USER='TrainAssist_user';
GRANT ALL ON TrainAssist_db.* TO 'TrainAssist_user'@'%';

CREATE DATABASE IF NOT EXISTS `TrainAssist_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `TrainAssist_db`;

DROP TABLE IF EXISTS `station`;
CREATE TABLE `station` (
  `station_id` varchar(50) NOT NULL,
  `station_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(35) NOT NULL,
  `user_lastname` varchar(35) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_phone` varchar(15) DEFAULT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_favstation` varchar(50) DEFAULT NULL,
  `user_token` varchar(64) DEFAULT NULL,
  `user_token_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `usertravel`;
CREATE TABLE `usertravel` (
  `usertravel_id` int(11) NOT NULL,
  `usertravel_user` int(11) NOT NULL,
  `usertravel_journey_id` varchar(200) NOT NULL,
  `usertravel_journey_data` varchar(9999) NOT NULL,
  `usertravel_followed` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `station`
  ADD PRIMARY KEY (`station_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_mail` (`user_mail`),
  ADD KEY `user_favstation` (`user_favstation`);

ALTER TABLE `usertravel`
  ADD PRIMARY KEY (`usertravel_id`),
  ADD UNIQUE KEY `U_USER_JOURNEY` (`usertravel_user`,`usertravel_journey_id`),
  ADD KEY `usertravel_user` (`usertravel_user`);


ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `usertravel`
  MODIFY `usertravel_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
ADD CONSTRAINT `FK_FAVSTATION` FOREIGN KEY (`user_favstation`) REFERENCES `station` (`station_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
