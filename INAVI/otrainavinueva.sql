/*
SQLyog Community Edition- MySQL GUI v6.04
Host - 5.0.27-community-nt : Database - otrainavinueva
*********************************************************************
Server version : 5.0.27-community-nt
*/
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `inavi_sai`;

USE `inavi_sai`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `actas` */

DROP TABLE IF EXISTS `actas`;

CREATE TABLE `actas` (
  `id_actas` int(11) NOT NULL auto_increment,
  `descripcion_actas` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_actas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actas` */

insert  into `actas`(`id_actas`,`descripcion_actas`) values (1,'inicio'),(2,'terminacion'),(3,'prorroga');

/*Table structure for table `actas_contrato` */

DROP TABLE IF EXISTS `actas_contrato`;

CREATE TABLE `actas_contrato` (
  `id_actas_contrato` int(11) NOT NULL auto_increment,
  `fk_id_actas` int(11) NOT NULL,
  `fk_idcontrato` varchar(20) NOT NULL,
  `fecha_actas` date NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY  (`id_actas_contrato`),
  KEY `FK_actas_contrato` (`fk_id_actas`),
  KEY `FK_actas_contrato2` (`fk_idcontrato`),
  CONSTRAINT `FK_actas_contrato` FOREIGN KEY (`fk_id_actas`) REFERENCES `actas` (`id_actas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_actas_contrato2` FOREIGN KEY (`fk_idcontrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actas_contrato` */

/*Table structure for table `contrato` */

DROP TABLE IF EXISTS `contrato`;

CREATE TABLE `contrato` (
  `id_contrato` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `fk_idempresa` varchar(12) NOT NULL,
  `fk_identidad` int(11) NOT NULL,
  `objeto` varchar(255) NOT NULL,
  `monto_original` float NOT NULL,
  `limite` float NOT NULL,
  `inicio` date NOT NULL,
  `terminacion` date NOT NULL,
  PRIMARY KEY  (`id_contrato`),
  KEY `id_contrato` (`id_contrato`),
  KEY `FK_contrato` (`fk_identidad`),
  KEY `FK_contrato2` (`fk_idempresa`),
  CONSTRAINT `FK_contrato` FOREIGN KEY (`fk_identidad`) REFERENCES `entidad` (`id_entidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_contrato2` FOREIGN KEY (`fk_idempresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `contrato` */

insert  into `contrato`(`id_contrato`,`fecha`,`fk_idempresa`,`fk_identidad`,`objeto`,`monto_original`,`limite`,`inicio`,`terminacion`) values ('1','2008-04-09','2',1,'wewe',12333,11222,'2008-04-16','2008-04-20'),('123','2008-04-15','2',1,'ghgh',12333,14444,'2008-04-24','2009-05-27');

/*Table structure for table `cuentaanticipo` */

DROP TABLE IF EXISTS `cuentaanticipo`;

CREATE TABLE `cuentaanticipo` (
  `id_cuentaanticipo` int(11) NOT NULL auto_increment,
  `fk_idfianzacontrato` int(11) NOT NULL,
  `saldoporamortizar` float NOT NULL,
  `fk_idcontrato` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_cuentaanticipo`),
  KEY `id_cuentaanticipo` (`id_cuentaanticipo`),
  KEY `FK_cuentaanticipo` (`fk_idfianzacontrato`),
  KEY `FK_cuentaanticipo2` (`fk_idcontrato`),
  CONSTRAINT `FK_cuentaanticipo` FOREIGN KEY (`fk_idfianzacontrato`) REFERENCES `fianzacontrato` (`id_fianzacontrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cuentaanticipo2` FOREIGN KEY (`fk_idcontrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cuentaanticipo` */

/*Table structure for table `cuentacontrato` */

DROP TABLE IF EXISTS `cuentacontrato`;

CREATE TABLE `cuentacontrato` (
  `id_cuentacontrato` int(11) NOT NULL auto_increment,
  `fk_idcontrato` varchar(20) NOT NULL,
  `disminuciones` float default NULL,
  `obrasextras` float default NULL,
  `aumentos` float default NULL,
  `monto_modificado` float NOT NULL,
  PRIMARY KEY  (`id_cuentacontrato`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cuentacontrato` */

/*Table structure for table `cuentavaluaciones` */

DROP TABLE IF EXISTS `cuentavaluaciones`;

CREATE TABLE `cuentavaluaciones` (
  `id_cuentavaluaciones` int(11) NOT NULL auto_increment,
  `fk_idvaluaciones` int(11) NOT NULL,
  `fk_idfianzacontrato` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto bruto` float NOT NULL,
  `montoneto` float NOT NULL,
  `anticipo` float NOT NULL,
  PRIMARY KEY  (`id_cuentavaluaciones`),
  KEY `id_cuentavaluaciones` (`id_cuentavaluaciones`),
  KEY `FK_cuentavaluaciones` (`fk_idfianzacontrato`),
  KEY `FK_cuentavaluaciones2` (`fk_idvaluaciones`),
  CONSTRAINT `FK_cuentavaluaciones` FOREIGN KEY (`fk_idfianzacontrato`) REFERENCES `fianzacontrato` (`id_fianzacontrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cuentavaluaciones2` FOREIGN KEY (`fk_idvaluaciones`) REFERENCES `valuaciones` (`id_valuaciones`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cuentavaluaciones` */

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id_empresa` varchar(12) NOT NULL,
  `nombre_e` varchar(40) NOT NULL,
  `representante` varchar(30) NOT NULL,
  `ced_representant` varchar(9) NOT NULL,
  PRIMARY KEY  (`id_empresa`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `empresa` */

insert  into `empresa`(`id_empresa`,`nombre_e`,`representante`,`ced_representant`) values ('1','tercera','fgg','fffgfgg'),('123466','primera','yo','16698012'),('12599','segunda','nose','niidea'),('2','cuarta','dfdf','ffff');

/*Table structure for table `entidad` */

DROP TABLE IF EXISTS `entidad`;

CREATE TABLE `entidad` (
  `id_entidad` int(11) NOT NULL auto_increment,
  `descripcion_ent` varchar(30) NOT NULL,
  PRIMARY KEY  (`id_entidad`),
  KEY `id_entidad` (`id_entidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `entidad` */

insert  into `entidad`(`id_entidad`,`descripcion_ent`) values (1,'bolivar'),(2,'monagas');

/*Table structure for table `fianza` */

DROP TABLE IF EXISTS `fianza`;

CREATE TABLE `fianza` (
  `id_fianza` int(11) NOT NULL auto_increment,
  `descripcionf` varchar(30) NOT NULL,
  PRIMARY KEY  (`id_fianza`),
  KEY `id_fianza` (`id_fianza`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `fianza` */

insert  into `fianza`(`id_fianza`,`descripcionf`) values (1,'anticipo'),(2,'otra');

/*Table structure for table `fianzacontrato` */

DROP TABLE IF EXISTS `fianzacontrato`;

CREATE TABLE `fianzacontrato` (
  `id_fianzacontrato` int(11) NOT NULL auto_increment,
  `fk_idcontrato` varchar(20) NOT NULL,
  `fk_idfianza` int(11) NOT NULL,
  `emitida_por` varchar(50) NOT NULL,
  `numerodepolia` varchar(30) NOT NULL,
  `monto` float NOT NULL,
  PRIMARY KEY  (`id_fianzacontrato`),
  KEY `id_fianzacontrato` (`id_fianzacontrato`),
  KEY `FK_fianzacontrato` (`fk_idcontrato`),
  KEY `FK_fianzacontrato2` (`fk_idfianza`),
  CONSTRAINT `FK_fianzacontrato` FOREIGN KEY (`fk_idcontrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_fianzacontrato2` FOREIGN KEY (`fk_idfianza`) REFERENCES `fianza` (`id_fianza`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `fianzacontrato` */

/*Table structure for table `liquidacion` */

DROP TABLE IF EXISTS `liquidacion`;

CREATE TABLE `liquidacion` (
  `id_liquidacion` int(11) NOT NULL auto_increment,
  `fk_saldoinstitucion` int(11) NOT NULL,
  `fk_idsaldocontratista` int(11) NOT NULL,
  `total` float NOT NULL,
  `saldoafavor` float NOT NULL,
  PRIMARY KEY  (`id_liquidacion`),
  KEY `id_liquidacion` (`id_liquidacion`),
  KEY `FK_liquidacion1` (`fk_idsaldocontratista`),
  KEY `FK_liquidacion` (`fk_saldoinstitucion`),
  CONSTRAINT `FK_liquidacion` FOREIGN KEY (`fk_saldoinstitucion`) REFERENCES `saldoinstitucion` (`id_saldoinstitucion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_liquidacion1` FOREIGN KEY (`fk_idsaldocontratista`) REFERENCES `saldocontratista` (`id_saldocontratista`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `liquidacion` */

/*Table structure for table `obranoejecutada` */

DROP TABLE IF EXISTS `obranoejecutada`;

CREATE TABLE `obranoejecutada` (
  `id_obranoejecutada` int(11) NOT NULL auto_increment,
  `fk_idcontrato` varchar(20) NOT NULL,
  `montoobraverificada` float NOT NULL,
  `obraporejecutar` float NOT NULL,
  PRIMARY KEY  (`id_obranoejecutada`),
  KEY `FK_obraejecutada` (`fk_idcontrato`),
  KEY `id_obranoejecutada` (`id_obranoejecutada`),
  CONSTRAINT `FK_obraejecutada` FOREIGN KEY (`fk_idcontrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_obranoejecutada` FOREIGN KEY (`fk_idcontrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `obranoejecutada` */

/*Table structure for table `obraverificada` */

DROP TABLE IF EXISTS `obraverificada`;

CREATE TABLE `obraverificada` (
  `id_obraverificada` int(11) NOT NULL auto_increment,
  `fk_idcontrato` varchar(20) NOT NULL,
  `fechaoverificada` date NOT NULL,
  `saldo` float NOT NULL,
  PRIMARY KEY  (`id_obraverificada`),
  KEY `id_obraverificada` (`id_obraverificada`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `obraverificada` */

/*Table structure for table `saldocontratista` */

DROP TABLE IF EXISTS `saldocontratista`;

CREATE TABLE `saldocontratista` (
  `id_saldocontratista` int(11) NOT NULL auto_increment,
  `fk_obraverificada` int(11) NOT NULL,
  `fk_idfianzacontrato` int(11) NOT NULL,
  `saldo` float NOT NULL,
  PRIMARY KEY  (`id_saldocontratista`),
  KEY `id_saldocontratista` (`id_saldocontratista`),
  KEY `FK_saldocontratista` (`fk_obraverificada`),
  KEY `FK_saldocontratista2` (`fk_idfianzacontrato`),
  CONSTRAINT `FK_saldocontratista` FOREIGN KEY (`fk_obraverificada`) REFERENCES `obraverificada` (`id_obraverificada`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_saldocontratista2` FOREIGN KEY (`fk_idfianzacontrato`) REFERENCES `fianzacontrato` (`id_fianzacontrato`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `saldocontratista` */

/*Table structure for table `saldoinstitucion` */

DROP TABLE IF EXISTS `saldoinstitucion`;

CREATE TABLE `saldoinstitucion` (
  `id_saldoinstitucion` int(11) NOT NULL auto_increment,
  `indenmizacion` float NOT NULL,
  `multaatrazada` float NOT NULL,
  `fk_cuentaanticipo` int(11) NOT NULL,
  `obrarelacionadanoejecutada` float NOT NULL,
  `saldo` float NOT NULL,
  PRIMARY KEY  (`id_saldoinstitucion`),
  KEY `indenmizacion` (`id_saldoinstitucion`),
  KEY `FK_saldoinstitucion` (`fk_cuentaanticipo`),
  CONSTRAINT `FK_saldoinstitucion` FOREIGN KEY (`fk_cuentaanticipo`) REFERENCES `cuentaanticipo` (`id_cuentaanticipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `saldoinstitucion` */

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `Usuario` varchar(30) NOT NULL,
  `Clave` varchar(15) NOT NULL,
  PRIMARY KEY  (`Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`Usuario`,`Clave`) values ('carmen','123'),('sai','16698012');

/*Table structure for table `valuaciones` */

DROP TABLE IF EXISTS `valuaciones`;

CREATE TABLE `valuaciones` (
  `id_valuaciones` int(11) NOT NULL auto_increment,
  `descripcion` varchar(10) NOT NULL,
  PRIMARY KEY  (`id_valuaciones`),
  KEY `id_valuaciones` (`id_valuaciones`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `valuaciones` */

insert  into `valuaciones`(`id_valuaciones`,`descripcion`) values (1,'Val.1'),(2,'Val.2'),(3,'Val.3');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
