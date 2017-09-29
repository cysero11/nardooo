/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.17 : Database - gates_smm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gates_smm` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `gates_smm`;

/*Table structure for table `tblmaintenance_equip` */

DROP TABLE IF EXISTS `tblmaintenance_equip`;

CREATE TABLE `tblmaintenance_equip` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `floor` varchar(30) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `xcategory` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

/*Data for the table `tblmaintenance_equip` */

insert  into `tblmaintenance_equip`(`id`,`code`,`description`,`floor`,`unit`,`status`,`xcategory`) values (1,'EQUIP-000001','Fire Pump','Basement','','Operational','Equipment'),(2,'EQUIP-000002','Jockey Pump','Basement','','Operational','Equipment'),(3,'EQUIP-000003','Transfer Pump 1','Basement','','Operational','Equipment'),(6,'EQUIP-000004','Jacuzzi Pump','Basement','','Operational','Equipment'),(7,'EQUIP-000005','Transfer Pump 2','Basement','','Operational','Equipment'),(8,'EQUIP-000006','Pool Pump','Basement','','Operational','Equipment'),(9,'EQUIP-000007','Sewage pump 1','Basement','','Operational','Equipment'),(10,'EQUIP-000008','Sewage pump 2','Basement','','Operational','Equipment'),(11,'EQUIP-000009','Sump Pump 1','Basement','','Operational','Equipment'),(12,'EQUIP-000010','Sump Pump 2','Basement','','Operational','Equipment'),(13,'EQUIP-000011','Elevator Pit Pump 1','Basement','','Operational','Equipment'),(14,'EQUIP-000012','Elevator Pit Pump 2','Basement','','Operational','Equipment'),(15,'EQUIP-000013','Hydro pneumatic Pump','Basement','','Condemned Unit(Not in use)','Equipment'),(16,'EQUIP-000014','Exhaust Fan 1 (EF1)','Basement','','Operational','Equipment'),(17,'EQUIP-000015','Exhaust Fan 2 (EF2)','Basement','','Operational','Equipment'),(18,'EQUIP-000016','Exhaust Fan 3 (EF3)','Basement','','Operational','Equipment'),(19,'EQUIP-000017','Exhaust Fan 4 (EF4)','Basement','','Operational','Equipment'),(20,'EQUIP-000018','Exhaust Fan 5 (EF5)','Basement','','Operational','Equipment'),(21,'EQUIP-000019','Exhaust Fan 6 (EF6)','Basement','','Non-Operational','Equipment'),(22,'EQUIP-000020','Fresh Air Fan Blower 1 (FB1)','Basement','','Operational','Equipment'),(23,'EQUIP-000021','Fresh Air Fan Blower 2 (FB2)','Basement','','Operational','Equipment'),(24,'EQUIP-000022','Pressurization Fan (PF1)','Basement','','Operational','Equipment'),(25,'EQUIP-000023','Pressurization Fan (PF2)','Basement','','Operational','Equipment'),(26,'EQUIP-000024','ACU 3TR Package Type - ACU1','Basement','','Operational','Equipment'),(27,'EQUIP-000025','ACU 3 TR Package Type -ACU 2','Basement','','Operational','Equipment'),(28,'EQUIP-000026','ACU 3TR Split type â€“ ACU 3','Basement','','Operational','Equipment'),(29,'EQUIP-000027','ACU 3 TR Split type â€“ ACU 4','Basement','','Operational','Equipment'),(30,'EQUIP-000028','ACU 2HP Split type â€“ ACU 5','Basement','','Operational','Equipment'),(31,'EQUIP-000029','ACU Window Type â€“ ACU 6','Basement','','Operational','Equipment'),(39,'SCSE-000001','Intercom System','1st Floor','','Operational','Security and Communication System'),(40,'SCSE-000002','Paging System','11th Floor','','Operational','Security and Communication System'),(41,'SCSE-000003','Traffic management System','Basement','','Operational','Security and Communication System'),(42,'SCSE-000004','Fire Detection ','Ground','','Operational','Security and Communication System'),(43,'FACI-000001','Gym','Rooftop','','Operational','Facilities'),(44,'FACI-000002','Function Room','Rooftop','','Operational','Facilities'),(45,'FACI-000003','Swimming pool','Rooftop','','Operational','Facilities'),(46,'FACI-000004','Jacuzzi','Rooftop','','Non-Operational','Facilities'),(47,'FACI-000005','Male Shower Room','Rooftop','','Operational','Facilities'),(48,'FACI-000006','Female Shower Room','Rooftop','','Operational','Facilities'),(49,'FACI-000007','Function Rm. Male Toilet','Rooftop','','Operational','Facilities'),(50,'FACI-000008','Function Rm. Female Toilet','Rooftop','','Operational','Facilities'),(51,'FACI-000009','Kitchen / Pantry','Rooftop','','Operational','Facilities'),(52,'FACI-000010','Sauna ','Rooftop','','Non-Operational','Facilities'),(53,'FACI-000011','Parking 2 Toilet','Parking','','Operational','Facilities'),(54,'FACI-000012','Parking 3 Toilet','Parking','','Operational','Facilities'),(55,'FACI-000013','Basement Toilet','Basement','','Operational','Facilities'),(56,'FACI-000014','Admin Office','Ground','','Operational','Facilities');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
