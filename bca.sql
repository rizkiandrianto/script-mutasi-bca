/*
SQLyog Ultimate v10.42 
MySQL - 5.5.42 : Database - bca
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bca` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bca`;

/*Table structure for table `detailbca` */

DROP TABLE IF EXISTS `detailbca`;

CREATE TABLE `detailbca` (
  `tgl` varchar(10) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `mutasi` varchar(20) DEFAULT NULL,
  `mkode` varchar(10) DEFAULT NULL,
  `userbca` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detailbca` */

LOCK TABLES `detailbca` WRITE;

UNLOCK TABLES;

/*Table structure for table `headerbca` */

DROP TABLE IF EXISTS `headerbca`;

CREATE TABLE `headerbca` (
  `norek` varchar(15) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `tgl` varchar(50) DEFAULT NULL,
  `muang` varchar(5) DEFAULT NULL,
  `saldo` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `headerbca` */

LOCK TABLES `headerbca` WRITE;

insert  into `headerbca`(`norek`,`nama`,`tgl`,`muang`,`saldo`) values ('6730142071','userbca','2015/10/07-2015/11/06','IDR','668,631.46');

UNLOCK TABLES;

/*Table structure for table `konfigurasi` */

DROP TABLE IF EXISTS `konfigurasi`;

CREATE TABLE `konfigurasi` (
  `userbca` varchar(15) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `jml1` int(11) DEFAULT '0',
  `jml2` int(11) DEFAULT '0',
  `pmutasi` int(11) DEFAULT '29',
  `email` varchar(25) DEFAULT NULL,
  `refresh` int(11) DEFAULT '60'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `konfigurasi` */

LOCK TABLES `konfigurasi` WRITE;

insert  into `konfigurasi`(`userbca`,`password`,`jml1`,`jml2`,`pmutasi`,`email`,`refresh`) values ('userbca','NTAzMTU2',0,0,29,'rudy@sdp.mail',60);

UNLOCK TABLES;

/*Table structure for table `tmp_detailbca` */

DROP TABLE IF EXISTS `tmp_detailbca`;

CREATE TABLE `tmp_detailbca` (
  `tgl` varchar(10) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `mutasi` varchar(20) DEFAULT NULL,
  `mkode` varchar(10) DEFAULT NULL,
  `userbca` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmp_detailbca` */

LOCK TABLES `tmp_detailbca` WRITE;

UNLOCK TABLES;

/*Table structure for table `tmpdata` */

DROP TABLE IF EXISTS `tmpdata`;

CREATE TABLE `tmpdata` (
  `tgl` varchar(10) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `mutasi` varchar(20) DEFAULT NULL,
  `mkode` varchar(10) DEFAULT NULL,
  `userbca` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmpdata` */

LOCK TABLES `tmpdata` WRITE;

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
