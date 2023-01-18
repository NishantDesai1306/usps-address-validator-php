CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `address_line_1` varchar(50) NOT NULL,
  `address_line_2` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  PRIMARY KEY (id)
)
