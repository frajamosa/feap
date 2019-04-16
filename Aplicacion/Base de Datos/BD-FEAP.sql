-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.27-community-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema fe
--

CREATE DATABASE IF NOT EXISTS fe;
USE fe;

--
-- Definition of table `aa_cirugia`
--

DROP TABLE IF EXISTS `aa_cirugia`;
CREATE TABLE `aa_cirugia` (
  `ID_ANA_ACT` int(11) NOT NULL,
  `ID_CIRUGIA` int(11) NOT NULL,
  PRIMARY KEY  (`ID_ANA_ACT`,`ID_CIRUGIA`),
  KEY `FK_AA_CIRUGIA2` (`ID_CIRUGIA`),
  CONSTRAINT `FK_AA_CIRUGIA` FOREIGN KEY (`ID_ANA_ACT`) REFERENCES `ana_actual` (`ID_ANA_ACT`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AA_CIRUGIA2` FOREIGN KEY (`ID_CIRUGIA`) REFERENCES `tipo_cirugia` (`ID_CIRUGIA`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aa_cirugia`
--

/*!40000 ALTER TABLE `aa_cirugia` DISABLE KEYS */;
/*!40000 ALTER TABLE `aa_cirugia` ENABLE KEYS */;


--
-- Definition of table `aa_examen`
--

DROP TABLE IF EXISTS `aa_examen`;
CREATE TABLE `aa_examen` (
  `ID_AA_EXAMEN` int(11) NOT NULL,
  `ID_ANA_ACT` int(11) default NULL,
  `ID_EXAMEN` int(11) NOT NULL default '0',
  PRIMARY KEY  USING BTREE (`ID_AA_EXAMEN`),
  KEY `FK_AA_EXAMEN2` (`ID_ANA_ACT`),
  KEY `FK_AA_EXAMEN3` (`ID_EXAMEN`),
  CONSTRAINT `FK_AA_EXAMEN2` FOREIGN KEY (`ID_ANA_ACT`) REFERENCES `ana_actual` (`ID_ANA_ACT`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AA_EXAMEN3` FOREIGN KEY (`ID_EXAMEN`) REFERENCES `tipo_examen` (`ID_EXAMEN`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aa_examen`
--

/*!40000 ALTER TABLE `aa_examen` DISABLE KEYS */;
/*!40000 ALTER TABLE `aa_examen` ENABLE KEYS */;


--
-- Definition of table `aa_protesis`
--

DROP TABLE IF EXISTS `aa_protesis`;
CREATE TABLE `aa_protesis` (
  `ID_PROTESIS` int(11) NOT NULL,
  `ID_ANA_ACT` int(11) NOT NULL,
  PRIMARY KEY  (`ID_PROTESIS`,`ID_ANA_ACT`),
  KEY `FK_AA_PROTESIS2` (`ID_ANA_ACT`),
  CONSTRAINT `FK_AA_PROTESIS` FOREIGN KEY (`ID_PROTESIS`) REFERENCES `tipo_protesis` (`ID_PROTESIS`) ON UPDATE CASCADE,
  CONSTRAINT `FK_AA_PROTESIS2` FOREIGN KEY (`ID_ANA_ACT`) REFERENCES `ana_actual` (`ID_ANA_ACT`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aa_protesis`
--

/*!40000 ALTER TABLE `aa_protesis` DISABLE KEYS */;
/*!40000 ALTER TABLE `aa_protesis` ENABLE KEYS */;


--
-- Definition of table `acor_muscular`
--

DROP TABLE IF EXISTS `acor_muscular`;
CREATE TABLE `acor_muscular` (
  `ID_ACO_MUSC` varchar(10) NOT NULL,
  `ID_MUSCULO` int(11) NOT NULL,
  `IZQUIERDO_AM` varchar(10) default NULL,
  `DERECHO_AM` varchar(10) default NULL,
  PRIMARY KEY  (`ID_ACO_MUSC`,`ID_MUSCULO`),
  KEY `FK_MUSCULO` (`ID_MUSCULO`),
  CONSTRAINT `FK_MUSCULO` FOREIGN KEY (`ID_MUSCULO`) REFERENCES `tipo_musculo` (`ID_MUSCULO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acor_muscular`
--

/*!40000 ALTER TABLE `acor_muscular` DISABLE KEYS */;
/*!40000 ALTER TABLE `acor_muscular` ENABLE KEYS */;


--
-- Definition of table `ana_actual`
--

DROP TABLE IF EXISTS `ana_actual`;
CREATE TABLE `ana_actual` (
  `ID_ANA_ACT` int(11) NOT NULL,
  `DIAGNOSTICO_ANA_ACT` text,
  `ORIGEN_LESION_ANA_ACT` text,
  `FARMACO_ANA_ACT` text,
  `OBS_ANA_ACT` text,
  PRIMARY KEY  (`ID_ANA_ACT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ana_actual`
--

/*!40000 ALTER TABLE `ana_actual` DISABLE KEYS */;
/*!40000 ALTER TABLE `ana_actual` ENABLE KEYS */;


--
-- Definition of table `ana_remota`
--

DROP TABLE IF EXISTS `ana_remota`;
CREATE TABLE `ana_remota` (
  `ID_ANA_REMOTA` int(11) NOT NULL auto_increment,
  `RUT_PAC` varchar(15) default NULL,
  PRIMARY KEY  (`ID_ANA_REMOTA`),
  KEY `FK_ANA_REMOTA_PACIENTE` (`RUT_PAC`),
  CONSTRAINT `FK_ANA_REMOTA_PACIENTE` FOREIGN KEY (`RUT_PAC`) REFERENCES `paciente` (`RUT_PAC`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ana_remota`
--

/*!40000 ALTER TABLE `ana_remota` DISABLE KEYS */;
INSERT INTO `ana_remota` (`ID_ANA_REMOTA`,`RUT_PAC`) VALUES 
 (3,'11111111-1'),
 (2,'15183409-4'),
 (1,'15853168-2');
/*!40000 ALTER TABLE `ana_remota` ENABLE KEYS */;


--
-- Definition of table `ar_cirugia`
--

DROP TABLE IF EXISTS `ar_cirugia`;
CREATE TABLE `ar_cirugia` (
  `ID_CIRUGIA` int(11) NOT NULL,
  `ID_ANA_REMOTA` int(11) NOT NULL,
  PRIMARY KEY  (`ID_CIRUGIA`,`ID_ANA_REMOTA`),
  KEY `FK_AR_CIRUGIA2` (`ID_ANA_REMOTA`),
  CONSTRAINT `FK_AR_CIRUGIA` FOREIGN KEY (`ID_CIRUGIA`) REFERENCES `tipo_cirugia` (`ID_CIRUGIA`),
  CONSTRAINT `FK_AR_CIRUGIA2` FOREIGN KEY (`ID_ANA_REMOTA`) REFERENCES `ana_remota` (`ID_ANA_REMOTA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_cirugia`
--

/*!40000 ALTER TABLE `ar_cirugia` DISABLE KEYS */;
INSERT INTO `ar_cirugia` (`ID_CIRUGIA`,`ID_ANA_REMOTA`) VALUES 
 (13,1),
 (15,1),
 (17,1),
 (16,2);
/*!40000 ALTER TABLE `ar_cirugia` ENABLE KEYS */;


--
-- Definition of table `ar_patologia`
--

DROP TABLE IF EXISTS `ar_patologia`;
CREATE TABLE `ar_patologia` (
  `ID_PATOLOGIA` int(11) NOT NULL,
  `ID_ANA_REMOTA` int(11) NOT NULL,
  PRIMARY KEY  (`ID_PATOLOGIA`,`ID_ANA_REMOTA`),
  KEY `FK_AR_PATOLOGIA2` (`ID_ANA_REMOTA`),
  CONSTRAINT `FK_AR_PATOLOGIA` FOREIGN KEY (`ID_PATOLOGIA`) REFERENCES `tipo_patologia` (`ID_PATOLOGIA`),
  CONSTRAINT `FK_AR_PATOLOGIA2` FOREIGN KEY (`ID_ANA_REMOTA`) REFERENCES `ana_remota` (`ID_ANA_REMOTA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_patologia`
--

/*!40000 ALTER TABLE `ar_patologia` DISABLE KEYS */;
INSERT INTO `ar_patologia` (`ID_PATOLOGIA`,`ID_ANA_REMOTA`) VALUES 
 (18,1),
 (18,2);
/*!40000 ALTER TABLE `ar_patologia` ENABLE KEYS */;


--
-- Definition of table `ar_vicio`
--

DROP TABLE IF EXISTS `ar_vicio`;
CREATE TABLE `ar_vicio` (
  `ID_ANA_REMOTA` int(11) NOT NULL,
  `ID_VICIO` int(11) NOT NULL,
  `FRECUENCIA` varchar(30) default NULL,
  PRIMARY KEY  (`ID_ANA_REMOTA`,`ID_VICIO`),
  KEY `FK_AR_VICIO2` (`ID_VICIO`),
  CONSTRAINT `FK_AR_VICIO` FOREIGN KEY (`ID_ANA_REMOTA`) REFERENCES `ana_remota` (`ID_ANA_REMOTA`),
  CONSTRAINT `FK_AR_VICIO2` FOREIGN KEY (`ID_VICIO`) REFERENCES `tipo_vicio` (`ID_VICIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_vicio`
--

/*!40000 ALTER TABLE `ar_vicio` DISABLE KEYS */;
INSERT INTO `ar_vicio` (`ID_ANA_REMOTA`,`ID_VICIO`,`FRECUENCIA`) VALUES 
 (1,13,'ddfdzzxd'),
 (1,15,'dfdxddfxd'),
 (1,17,''),
 (2,17,'ssss');
/*!40000 ALTER TABLE `ar_vicio` ENABLE KEYS */;


--
-- Definition of table `dolor_ek`
--

DROP TABLE IF EXISTS `dolor_ek`;
CREATE TABLE `dolor_ek` (
  `ID_DOL` int(11) NOT NULL,
  `NIVEL_DOL_EK` int(11) default NULL,
  `APARICION_DOL_EK` varchar(30) default NULL,
  `CARACTERISTICAS_DOL_EK` varchar(150) default NULL,
  PRIMARY KEY  (`ID_DOL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dolor_ek`
--

/*!40000 ALTER TABLE `dolor_ek` DISABLE KEYS */;
/*!40000 ALTER TABLE `dolor_ek` ENABLE KEYS */;


--
-- Definition of table `en_dermatoma`
--

DROP TABLE IF EXISTS `en_dermatoma`;
CREATE TABLE `en_dermatoma` (
  `ID_DERMATOMA` int(11) NOT NULL,
  `ID_EVA_NEURO` varchar(10) NOT NULL,
  `EST_DERMATOMA_EN` text,
  PRIMARY KEY  (`ID_DERMATOMA`,`ID_EVA_NEURO`),
  KEY `FK_EN_DERMATOMA2` (`ID_EVA_NEURO`),
  CONSTRAINT `FK_EN_DERMATOMA` FOREIGN KEY (`ID_DERMATOMA`) REFERENCES `tipo_dermatoma` (`ID_DERMATOMA`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EN_DERMATOMA2` FOREIGN KEY (`ID_EVA_NEURO`) REFERENCES `eva_neuro` (`ID_EVA_NEURO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `en_dermatoma`
--

/*!40000 ALTER TABLE `en_dermatoma` DISABLE KEYS */;
/*!40000 ALTER TABLE `en_dermatoma` ENABLE KEYS */;


--
-- Definition of table `en_miotoma`
--

DROP TABLE IF EXISTS `en_miotoma`;
CREATE TABLE `en_miotoma` (
  `ID_MIOTOMA` int(11) NOT NULL,
  `ID_EVA_NEURO` varchar(10) NOT NULL,
  `EST_MIOTOMA_EN` text,
  PRIMARY KEY  (`ID_MIOTOMA`,`ID_EVA_NEURO`),
  KEY `FK_EN_MIOTOMA2` (`ID_EVA_NEURO`),
  CONSTRAINT `FK_EN_MIOTOMA` FOREIGN KEY (`ID_MIOTOMA`) REFERENCES `tipo_miotoma` (`ID_MIOTOMA`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EN_MIOTOMA2` FOREIGN KEY (`ID_EVA_NEURO`) REFERENCES `eva_neuro` (`ID_EVA_NEURO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `en_miotoma`
--

/*!40000 ALTER TABLE `en_miotoma` DISABLE KEYS */;
/*!40000 ALTER TABLE `en_miotoma` ENABLE KEYS */;


--
-- Definition of table `en_reflejo`
--

DROP TABLE IF EXISTS `en_reflejo`;
CREATE TABLE `en_reflejo` (
  `ID_REFLEJO` int(11) NOT NULL,
  `ID_EVA_NEURO` varchar(10) NOT NULL,
  `EST_REFLEJO_EN` text,
  PRIMARY KEY  (`ID_REFLEJO`,`ID_EVA_NEURO`),
  KEY `FK_EN_REFLEJO2` (`ID_EVA_NEURO`),
  CONSTRAINT `FK_EN_REFLEJO` FOREIGN KEY (`ID_REFLEJO`) REFERENCES `tipo_reflejo` (`ID_REFLEJO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EN_REFLEJO2` FOREIGN KEY (`ID_EVA_NEURO`) REFERENCES `eva_neuro` (`ID_EVA_NEURO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `en_reflejo`
--

/*!40000 ALTER TABLE `en_reflejo` DISABLE KEYS */;
/*!40000 ALTER TABLE `en_reflejo` ENABLE KEYS */;


--
-- Definition of table `eva_kine`
--

DROP TABLE IF EXISTS `eva_kine`;
CREATE TABLE `eva_kine` (
  `ID_EK` int(11) NOT NULL,
  `ID_PAL` int(11) default NULL,
  `ID_INSP` int(11) default NULL,
  `ID_DOL` int(11) default NULL,
  `OBS_INGRESO_EK` text,
  PRIMARY KEY  (`ID_EK`),
  KEY `FK_DOLOR` (`ID_DOL`),
  KEY `FK_INSPECCION` (`ID_INSP`),
  KEY `FK_PALPACION` (`ID_PAL`),
  CONSTRAINT `FK_DOLOR` FOREIGN KEY (`ID_DOL`) REFERENCES `dolor_ek` (`ID_DOL`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_INSPECCION` FOREIGN KEY (`ID_INSP`) REFERENCES `inspeccion_ek` (`ID_INSP`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_PALPACION` FOREIGN KEY (`ID_PAL`) REFERENCES `palpacion_ek` (`ID_PAL`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eva_kine`
--

/*!40000 ALTER TABLE `eva_kine` DISABLE KEYS */;
/*!40000 ALTER TABLE `eva_kine` ENABLE KEYS */;


--
-- Definition of table `eva_neuro`
--

DROP TABLE IF EXISTS `eva_neuro`;
CREATE TABLE `eva_neuro` (
  `ID_EVA_NEURO` varchar(10) NOT NULL,
  PRIMARY KEY  (`ID_EVA_NEURO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eva_neuro`
--

/*!40000 ALTER TABLE `eva_neuro` DISABLE KEYS */;
/*!40000 ALTER TABLE `eva_neuro` ENABLE KEYS */;


--
-- Definition of table `eva_postural`
--

DROP TABLE IF EXISTS `eva_postural`;
CREATE TABLE `eva_postural` (
  `ID_EVA_POST` varchar(10) NOT NULL,
  `ANTERIOR_EVA_POST` text,
  `POSTERIOR_EVA_POST` text,
  `LATERAL_EVA_POST` text,
  `OBS_EVA_POST` text,
  PRIMARY KEY  (`ID_EVA_POST`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eva_postural`
--

/*!40000 ALTER TABLE `eva_postural` DISABLE KEYS */;
/*!40000 ALTER TABLE `eva_postural` ENABLE KEYS */;


--
-- Definition of table `ficha`
--

DROP TABLE IF EXISTS `ficha`;
CREATE TABLE `ficha` (
  `ID_FICHA` int(11) NOT NULL,
  `RUT_INT` varchar(15) NOT NULL,
  `ID_RNGO_ART` int(11) default NULL,
  `ID_EVA_POST` varchar(10) default NULL,
  `ID_EVA_NEURO` varchar(10) default NULL,
  `ID_FZA_MUSC` varchar(10) default NULL,
  `RUT_K` varchar(15) NOT NULL,
  `ID_ANA_ACT` int(11) default NULL,
  `ID_EK` int(11) default NULL,
  `RUT_PAC` varchar(15) NOT NULL,
  `ID_TRAT` varchar(10) default NULL,
  `ID_ACO_MUSC` varchar(10) default NULL,
  `ID_PF` int(11) default NULL,
  `FEC_FICHA` date NOT NULL,
  PRIMARY KEY  (`ID_FICHA`),
  KEY `FK_ANA_ACTUAL` (`ID_ANA_ACT`),
  KEY `FK_EVA_KINE` (`ID_EK`),
  KEY `FK_EVA_NEURO` (`ID_EVA_NEURO`),
  KEY `FK_EVA_POSTURAL` (`ID_EVA_POST`),
  KEY `FK_FZA_MUSCULAR` (`ID_FZA_MUSC`),
  KEY `FK_INTERNO_FICHA` (`RUT_INT`),
  KEY `FK_KINESIOLOGO_FICHA` (`RUT_K`),
  KEY `FK_PACIENTE_FICHA` (`RUT_PAC`),
  KEY `FK_REFERENCE_40` (`ID_ACO_MUSC`),
  KEY `FK_RELATIONSHIP_26` (`ID_RNGO_ART`),
  KEY `FK_TRATAMIENTO_FICHA` (`ID_TRAT`),
  CONSTRAINT `FK_ANA_ACTUAL` FOREIGN KEY (`ID_ANA_ACT`) REFERENCES `ana_actual` (`ID_ANA_ACT`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_EVA_KINE` FOREIGN KEY (`ID_EK`) REFERENCES `eva_kine` (`ID_EK`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_EVA_NEURO` FOREIGN KEY (`ID_EVA_NEURO`) REFERENCES `eva_neuro` (`ID_EVA_NEURO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_EVA_POSTURAL` FOREIGN KEY (`ID_EVA_POST`) REFERENCES `eva_postural` (`ID_EVA_POST`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_FZA_MUSCULAR` FOREIGN KEY (`ID_FZA_MUSC`) REFERENCES `fza_muscular` (`ID_FZA_MUSC`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_INTERNO_FICHA` FOREIGN KEY (`RUT_INT`) REFERENCES `interno` (`RUT_INT`) ON UPDATE CASCADE,
  CONSTRAINT `FK_KINESIOLOGO_FICHA` FOREIGN KEY (`RUT_K`) REFERENCES `kinesiologo` (`RUT_K`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PACIENTE_FICHA` FOREIGN KEY (`RUT_PAC`) REFERENCES `paciente` (`RUT_PAC`) ON UPDATE CASCADE,
  CONSTRAINT `FK_REFERENCE_40` FOREIGN KEY (`ID_ACO_MUSC`) REFERENCES `acor_muscular` (`ID_ACO_MUSC`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_RELATIONSHIP_26` FOREIGN KEY (`ID_RNGO_ART`) REFERENCES `rng_articular` (`ID_RNGO_ART`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_TRATAMIENTO_FICHA` FOREIGN KEY (`ID_TRAT`) REFERENCES `tratamiento` (`ID_TRAT`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ficha`
--

/*!40000 ALTER TABLE `ficha` DISABLE KEYS */;
/*!40000 ALTER TABLE `ficha` ENABLE KEYS */;


--
-- Definition of table `fza_muscular`
--

DROP TABLE IF EXISTS `fza_muscular`;
CREATE TABLE `fza_muscular` (
  `ID_FZA_MUSC` varchar(10) NOT NULL,
  `MOV_MUSCULAR_FM` varchar(30) default NULL,
  `PORCENTAJE_FM` int(11) default NULL,
  PRIMARY KEY  (`ID_FZA_MUSC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fza_muscular`
--

/*!40000 ALTER TABLE `fza_muscular` DISABLE KEYS */;
/*!40000 ALTER TABLE `fza_muscular` ENABLE KEYS */;


--
-- Definition of table `inspeccion_ek`
--

DROP TABLE IF EXISTS `inspeccion_ek`;
CREATE TABLE `inspeccion_ek` (
  `ID_INSP` int(11) NOT NULL,
  `PIEL_INSP_EK` varchar(30) default NULL,
  `VOLUMEN_INSP_EK` varchar(30) default NULL,
  `CICATRIZ_INSP_EK` varchar(30) default NULL,
  `DEFORMIDAD_INSP_EK` text,
  `OBS_INSP_EK` text,
  PRIMARY KEY  (`ID_INSP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspeccion_ek`
--

/*!40000 ALTER TABLE `inspeccion_ek` DISABLE KEYS */;
/*!40000 ALTER TABLE `inspeccion_ek` ENABLE KEYS */;


--
-- Definition of table `interno`
--

DROP TABLE IF EXISTS `interno`;
CREATE TABLE `interno` (
  `RUT_INT` varchar(15) NOT NULL,
  `NOMBRE_INT` varchar(30) NOT NULL,
  `APELLIDO_INT` varchar(30) NOT NULL,
  `TELEFONO_INT` varchar(10) NOT NULL,
  `CORREO_INT` varchar(45) NOT NULL,
  `VIGENCIA_INT` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`RUT_INT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interno`
--

/*!40000 ALTER TABLE `interno` DISABLE KEYS */;
INSERT INTO `interno` (`RUT_INT`,`NOMBRE_INT`,`APELLIDO_INT`,`TELEFONO_INT`,`CORREO_INT`,`VIGENCIA_INT`) VALUES 
 ('11111111-1','Test','Boolean','2204339','yo@yo.com',1),
 ('12345677-7','Internista','Test 1','fono Int1','interno@hotmail.com',1),
 ('88888888-8','Test Impresion','Test','12344444','erp@uss.com',1);
/*!40000 ALTER TABLE `interno` ENABLE KEYS */;


--
-- Definition of table `kinesiologo`
--

DROP TABLE IF EXISTS `kinesiologo`;
CREATE TABLE `kinesiologo` (
  `RUT_K` varchar(15) NOT NULL,
  `NOMBRE_K` varchar(30) NOT NULL,
  `APELLIDO_K` varchar(30) NOT NULL,
  `TELEFONO_K` varchar(10) NOT NULL,
  `CORREO_K` varchar(45) NOT NULL,
  `VIGENCIA_K` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`RUT_K`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kinesiologo`
--

/*!40000 ALTER TABLE `kinesiologo` DISABLE KEYS */;
INSERT INTO `kinesiologo` (`RUT_K`,`NOMBRE_K`,`APELLIDO_K`,`TELEFONO_K`,`CORREO_K`,`VIGENCIA_K`) VALUES 
 ('12345678-5','Kinesiologo','Test 1','fono 1','jaja@ya.cl',1),
 ('22222222-2','Test Boolean','Kinesiologo','2203040','yp@tr.com',0);
/*!40000 ALTER TABLE `kinesiologo` ENABLE KEYS */;


--
-- Definition of table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE `paciente` (
  `RUT_PAC` varchar(15) NOT NULL,
  `NOMBRE_PAC` varchar(30) NOT NULL,
  `APELLIDO_PAC` varchar(30) NOT NULL,
  `DIRECCION_PAC` varchar(200) default NULL,
  `TELEFONO1_PAC` varchar(10) NOT NULL,
  `TELEFONO2_PAC` varchar(10) default NULL,
  `F_NAC_PAC` date NOT NULL,
  `CORREO_PAC` varchar(45) NOT NULL,
  `ALTA_PAC` tinyint(1) NOT NULL,
  PRIMARY KEY  (`RUT_PAC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paciente`
--

/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` (`RUT_PAC`,`NOMBRE_PAC`,`APELLIDO_PAC`,`DIRECCION_PAC`,`TELEFONO1_PAC`,`TELEFONO2_PAC`,`F_NAC_PAC`,`CORREO_PAC`,`ALTA_PAC`) VALUES 
 ('11111111-1','Daniel ','Moore','calle 101 condominio 1855','123456','789098','2008-03-20','danielito@gmail.com',1),
 ('15183409-4','Gisela','Castillo','calle 101','2204030','2204297','1982-10-07','gise_castillo@hotmail.com',0),
 ('15853168-2','Francisco','Moore','calle 101','2204330','2204039','1984-04-14','franciscomoores@gmail.com',0);
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;


--
-- Definition of table `palpacion_ek`
--

DROP TABLE IF EXISTS `palpacion_ek`;
CREATE TABLE `palpacion_ek` (
  `ID_PAL` int(11) NOT NULL,
  `SENSIBILIDAD_PAL_EK` varchar(30) default NULL,
  `TEMPERATURA_PAL_EK` int(11) default NULL,
  `INFLAMACION_PAL_EK` text,
  PRIMARY KEY  (`ID_PAL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `palpacion_ek`
--

/*!40000 ALTER TABLE `palpacion_ek` DISABLE KEYS */;
/*!40000 ALTER TABLE `palpacion_ek` ENABLE KEYS */;


--
-- Definition of table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
CREATE TABLE `permiso` (
  `ID_PERMISO` varchar(10) NOT NULL,
  `DESC_PERMISO` varchar(150) NOT NULL,
  `TIPO_PERMISO` int(11) NOT NULL,
  PRIMARY KEY  (`ID_PERMISO`,`TIPO_PERMISO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permiso`
--

/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` (`ID_PERMISO`,`DESC_PERMISO`,`TIPO_PERMISO`) VALUES 
 ('1','lee Paciente',1),
 ('10','lee Informe',2),
 ('100','lee Internista',3),
 ('1000','lee Kinesiologo',4),
 ('10000','lee Usuario',5),
 ('2','agrega Paciente',1),
 ('20','agrega Informe',2),
 ('200','agrega Internista',3),
 ('2000','agrega Kinesiologo',4),
 ('20000','agrega Usuario',5),
 ('3','agrega / modifica Paciente',1),
 ('30','agrega / modifica Informe',2),
 ('300','agrega / modifica Internista',3),
 ('3000','agrega / modifica Kinesiologo',4),
 ('30000','agrega / modifica Usuario',5),
 ('4','agrega / modifica / elimina Paciente',1),
 ('40','agrega / modifica / elimina Informe',2),
 ('400','agrega / modifica / elimina Internista',3),
 ('4000','agrega / modifica / elimina Kinesiologo',4),
 ('40000','agrega / modifica / elimina Usuario',5),
 ('9','no lee Paciente',1),
 ('90','no lee Informe',3),
 ('900','no lee Internista',3),
 ('9000','no lee Kinesiologo',4),
 ('90000','no lee Usuario',5);
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;


--
-- Definition of table `prueba_funcional`
--

DROP TABLE IF EXISTS `prueba_funcional`;
CREATE TABLE `prueba_funcional` (
  `ID_PRUEBA` int(11) NOT NULL,
  `ID_PF` int(11) NOT NULL,
  `RESULTADO_PF` text,
  PRIMARY KEY  (`ID_PRUEBA`,`ID_PF`),
  CONSTRAINT `FK_PRUEBA_FUNCIONAL` FOREIGN KEY (`ID_PRUEBA`) REFERENCES `tipo_prueba` (`ID_PRUEBA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prueba_funcional`
--

/*!40000 ALTER TABLE `prueba_funcional` DISABLE KEYS */;
/*!40000 ALTER TABLE `prueba_funcional` ENABLE KEYS */;


--
-- Definition of table `resultado_examen`
--

DROP TABLE IF EXISTS `resultado_examen`;
CREATE TABLE `resultado_examen` (
  `ID_RESULTADO_EX` int(11) NOT NULL auto_increment,
  `ARCHIVO_EX` varchar(50) default NULL,
  `OBS_EXAMEN` text,
  `ID_AA_EXAMEN` int(11) default NULL,
  PRIMARY KEY  (`ID_RESULTADO_EX`),
  KEY `FK_REFERENCE_38` (`ID_AA_EXAMEN`),
  CONSTRAINT `FK_REFERENCE_38` FOREIGN KEY (`ID_AA_EXAMEN`) REFERENCES `aa_examen` (`ID_AA_EXAMEN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resultado_examen`
--

/*!40000 ALTER TABLE `resultado_examen` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultado_examen` ENABLE KEYS */;


--
-- Definition of table `rng_articular`
--

DROP TABLE IF EXISTS `rng_articular`;
CREATE TABLE `rng_articular` (
  `ID_RNGO_ART` int(11) NOT NULL,
  `ID_ARTICULACION` int(11) NOT NULL,
  `MOVIMIENTO_RNG_ART` varchar(20) default NULL,
  `RANGO_RNG_ART` varchar(20) default NULL,
  `ENDFEEL_RNG_ART` varchar(20) default NULL,
  PRIMARY KEY  (`ID_RNGO_ART`,`ID_ARTICULACION`),
  KEY `FK_TIPO_ARTICULACION` (`ID_ARTICULACION`),
  CONSTRAINT `FK_TIPO_ARTICULACION` FOREIGN KEY (`ID_ARTICULACION`) REFERENCES `tipo_articulacion` (`ID_ARTICULACION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rng_articular`
--

/*!40000 ALTER TABLE `rng_articular` DISABLE KEYS */;
/*!40000 ALTER TABLE `rng_articular` ENABLE KEYS */;


--
-- Definition of table `tipo_articulacion`
--

DROP TABLE IF EXISTS `tipo_articulacion`;
CREATE TABLE `tipo_articulacion` (
  `ID_ARTICULACION` int(11) NOT NULL,
  `DESC_ARTICULACION` varchar(30) NOT NULL,
  PRIMARY KEY  (`ID_ARTICULACION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_articulacion`
--

/*!40000 ALTER TABLE `tipo_articulacion` DISABLE KEYS */;
INSERT INTO `tipo_articulacion` (`ID_ARTICULACION`,`DESC_ARTICULACION`) VALUES 
 (0,'Seleccione Articulacion'),
 (1,'artic1'),
 (2,'artic2'),
 (3,'artic3'),
 (4,'artic4'),
 (5,'artic5'),
 (6,'K02GX5PLOCXPG NKCKX97JVD514JQB'),
 (7,'DI9WMKSN1X45O7WDO0LWY627W65JMM'),
 (8,'GCO61IRL1KTNUT2KCWO220M55M68UC'),
 (9,'12EN55PQSAVOOQTE3RRD6X5D50KI8L'),
 (10,'2SJ7M T2CD0INSKNTI1DVJM QEEQYX'),
 (11,'CLYVOMQAJBWIH56BYNT4INCA01G3MI'),
 (12,' 9BXEBEPQBH3AUP98RK7VSMDCDOYPG'),
 (13,'T5EI2D  U T3UGASS6QREVUXV9AC72'),
 (14,'QBOI0MU4I4ELXFL2U8QET3UD715ILK'),
 (15,'FKW6BXTXGC2KIMAS8 XLNCS0W3JM99'),
 (16,'RSRLLLQYM6XY EAOM41LFGKYA6TBEU'),
 (17,'37H03UNK2M QIYKTLTGQACXUX7A8HU'),
 (18,'97OCCXYCWEUQ7N3X7Q4EWU9UJVTAWF'),
 (19,'9IKEPTDL3DUNCAU7OIBODMAFF75B7 ');
/*!40000 ALTER TABLE `tipo_articulacion` ENABLE KEYS */;


--
-- Definition of table `tipo_cirugia`
--

DROP TABLE IF EXISTS `tipo_cirugia`;
CREATE TABLE `tipo_cirugia` (
  `ID_CIRUGIA` int(11) NOT NULL,
  `DESC_CIRUGIA` varchar(30) NOT NULL,
  PRIMARY KEY  (`ID_CIRUGIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_cirugia`
--

/*!40000 ALTER TABLE `tipo_cirugia` DISABLE KEYS */;
INSERT INTO `tipo_cirugia` (`ID_CIRUGIA`,`DESC_CIRUGIA`) VALUES 
 (0,'CIRUGIA 0'),
 (1,'CIRUGIA 1'),
 (2,'CIRUGIA 2'),
 (3,'CIRUGIA 3'),
 (4,'CIRUGIA 4'),
 (5,'CIRUGIA 5'),
 (6,'CIRUGIA 6'),
 (7,'CIRUGIA 7'),
 (8,'T0L82LQI8KDKAU0GIPJU O45ESEOSX'),
 (9,'WC9ICW87TDWMQCUAYUF7PYPBTC37TK'),
 (10,'WN3W0Y2M6VRHQNQHJ6T9K EUKD2QTQ'),
 (11,'YYLOCB 2J L GWD81FPC2DGH8MEA88'),
 (12,'VL2ILYXDKLPM3TSU D5AUBVTN1D6 R'),
 (13,'EJTTHIT251O7MWEIL3A1NTBFVT FFH'),
 (14,'LHQ17NADRJDTJ1KB5IUCJUX00G3RXC'),
 (15,'IGDPR9OY8I5GNLANBIQUASFOG4R6P '),
 (16,'XT776CYTRF VX6SAQ29BVUAA9PWS64'),
 (17,'B4RBAN110RJ46U7OWL3M45MSIBFILD'),
 (18,'8MGFP5YSQDAG5F3ACV W1LVEJXYU6W'),
 (19,'T7N PD9QBKSDTLV817ANF1B3P T9X1');
/*!40000 ALTER TABLE `tipo_cirugia` ENABLE KEYS */;


--
-- Definition of table `tipo_dermatoma`
--

DROP TABLE IF EXISTS `tipo_dermatoma`;
CREATE TABLE `tipo_dermatoma` (
  `ID_DERMATOMA` int(11) NOT NULL,
  `DESC_DERMATOMA` varchar(10) default NULL,
  PRIMARY KEY  (`ID_DERMATOMA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_dermatoma`
--

/*!40000 ALTER TABLE `tipo_dermatoma` DISABLE KEYS */;
INSERT INTO `tipo_dermatoma` (`ID_DERMATOMA`,`DESC_DERMATOMA`) VALUES 
 (0,'derma0'),
 (1,'derma1'),
 (2,'derma2'),
 (3,'derma3'),
 (4,'derma4'),
 (5,'derma5'),
 (6,'GN3NCK9NBE'),
 (7,'U8RAJT9YXB'),
 (8,'G82DCD6P4P'),
 (9,'NMAJV7J3Q2'),
 (10,'VS0FB1C18X'),
 (11,'YH5E6N9WN8'),
 (12,'J TKTONLWH'),
 (13,'8J ODPS1WI'),
 (14,'LP1T4615OV'),
 (15,'3TTCW3IVNA'),
 (16,'WOG8N4SJG5'),
 (17,'KXYP 9YG1W'),
 (18,'MQ3EIVNIL7'),
 (19,'QNKSL9SV5R');
/*!40000 ALTER TABLE `tipo_dermatoma` ENABLE KEYS */;


--
-- Definition of table `tipo_examen`
--

DROP TABLE IF EXISTS `tipo_examen`;
CREATE TABLE `tipo_examen` (
  `ID_EXAMEN` int(11) NOT NULL,
  `DESC_EXAMEN` varchar(30) NOT NULL,
  PRIMARY KEY  (`ID_EXAMEN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_examen`
--

/*!40000 ALTER TABLE `tipo_examen` DISABLE KEYS */;
INSERT INTO `tipo_examen` (`ID_EXAMEN`,`DESC_EXAMEN`) VALUES 
 (0,'examen0'),
 (1,'examen1'),
 (2,'examen2'),
 (3,'examen3'),
 (4,'examen4'),
 (5,'examen5'),
 (6,'examen6'),
 (7,'4755OPRUWRTA5TF9P 85 5WOLNQQP5'),
 (8,'WRBXK37ASIR8MPO96G 99J4EACJMGD'),
 (9,'2K9XXLX63GDA20HF4ASSJB8IMV24K '),
 (10,'DDW5BDAOV4SPBD8JHFWYQMYXFT8D0K'),
 (11,'DCT27Q2THQ9FSAD5QMARPT PB8IQOM'),
 (12,'1E8WBTBHRMX236YPK6G5GBJG8PB01V'),
 (13,'A 73R6346RK2KJMMLLR3DHCNXKD6QX'),
 (14,'A25S266P5JL15U4T2QMCI093VDVD37'),
 (15,'MN9QERRN PNXW1X8WMT1HL9F7JM353'),
 (16,'C9QGR7RQHGL59OKW1IC3A8Y6OD4T0K'),
 (17,'RY9 7D907UCTE2YK6W5HH49P UP0LI'),
 (18,'FQ1N9JUO0ST0L2QKBMPR3 6YLE1SUA'),
 (19,'YWTICQLBY2CWWX9KRM5AMC1KWANPNO');
/*!40000 ALTER TABLE `tipo_examen` ENABLE KEYS */;


--
-- Definition of table `tipo_miotoma`
--

DROP TABLE IF EXISTS `tipo_miotoma`;
CREATE TABLE `tipo_miotoma` (
  `ID_MIOTOMA` int(11) NOT NULL,
  `DESC_MIOTOMA` varchar(10) default NULL,
  PRIMARY KEY  (`ID_MIOTOMA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_miotoma`
--

/*!40000 ALTER TABLE `tipo_miotoma` DISABLE KEYS */;
INSERT INTO `tipo_miotoma` (`ID_MIOTOMA`,`DESC_MIOTOMA`) VALUES 
 (3,'mio0'),
 (4,'mio1'),
 (5,'mio2'),
 (6,'mio3'),
 (15,'mio4'),
 (16,'mio5'),
 (18,'mio6');
/*!40000 ALTER TABLE `tipo_miotoma` ENABLE KEYS */;


--
-- Definition of table `tipo_musculo`
--

DROP TABLE IF EXISTS `tipo_musculo`;
CREATE TABLE `tipo_musculo` (
  `ID_MUSCULO` int(11) NOT NULL,
  `DESC_MUSCULO` varchar(30) NOT NULL,
  PRIMARY KEY  (`ID_MUSCULO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_musculo`
--

/*!40000 ALTER TABLE `tipo_musculo` DISABLE KEYS */;
INSERT INTO `tipo_musculo` (`ID_MUSCULO`,`DESC_MUSCULO`) VALUES 
 (0,'Seleccione Musculo'),
 (1,'musc1'),
 (2,'musc2'),
 (3,'musc3'),
 (4,'musc4'),
 (5,'musc5'),
 (6,'musc6'),
 (7,'musc7'),
 (8,'musc8'),
 (9,'PBVFQ0L NXHO8SMK8TFPB GLDC 9KU'),
 (10,'DWK9GDXITRRKUAW8WO3QG5 0FU3 6S'),
 (11,'CR7L76X9 Q40 BMBDD2IOBMUIJ0F8E'),
 (12,'RRM9RWT7G 10BOD595P31HBS4V305S'),
 (13,'9GU1244WACS0S7V8867TUUTK055BF5'),
 (14,'C9360QQU FERFGP7J2WVT1GLPQ8VR6'),
 (15,'7JBIMUWX24JRV1USCINF9XYPK836KG'),
 (16,'I0HRO PIVUR9DG0M QQ641N0BOREYL'),
 (17,'AV6W3TVF6LJLE U489NJXKRESP3H  '),
 (18,'B7GNXNY7H7VGAIJBB596WPSMN8Q1OT'),
 (19,'VLIVHPYXUT4C95YPO0MSPS3OCMVV0Q');
/*!40000 ALTER TABLE `tipo_musculo` ENABLE KEYS */;


--
-- Definition of table `tipo_patologia`
--

DROP TABLE IF EXISTS `tipo_patologia`;
CREATE TABLE `tipo_patologia` (
  `ID_PATOLOGIA` int(11) NOT NULL,
  `DESC_PATOLOGIA` varchar(30) NOT NULL,
  PRIMARY KEY  (`ID_PATOLOGIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_patologia`
--

/*!40000 ALTER TABLE `tipo_patologia` DISABLE KEYS */;
INSERT INTO `tipo_patologia` (`ID_PATOLOGIA`,`DESC_PATOLOGIA`) VALUES 
 (0,'pato0'),
 (1,'pato1'),
 (2,'pato2'),
 (3,'pato3'),
 (4,'pato4'),
 (5,'pato5'),
 (6,'pato6'),
 (7,'pato7'),
 (8,'FLQKNUOBCIXU 3B04W YBV7I8YFLFE'),
 (9,'9KAA RNT7HJLENI3FU1HJ29DC3IIRT'),
 (10,'M4PUCHJ6F2V5IINDTKJLVDIEIIE5CD'),
 (11,'IXJK4F0P3F1YDSQ554KI4N8DY9A04T'),
 (12,'T1X2IPKPAVWS3YDOLY65NN1BVED0H8'),
 (13,'PGFUA4I404OO9DYV48ENPF2WAMM5X5'),
 (14,'79969B1OLSNGY3FRIGXA3BQIM1OEWU'),
 (15,'563RCAQLTFR98K5R3DQO65 1MVHSUD'),
 (16,'I4RTAS8TK3YF76XB JQJDHJ2AEH1W5'),
 (17,'52MO8U258GLJYM8J0SDIMU5T7H 550'),
 (18,'I4A1V0HRMPE601IPYKJP8EIAAM7E7N'),
 (19,' 4MNIUL1KYFV4MWS7B5 OY3F0XQYY5');
/*!40000 ALTER TABLE `tipo_patologia` ENABLE KEYS */;


--
-- Definition of table `tipo_protesis`
--

DROP TABLE IF EXISTS `tipo_protesis`;
CREATE TABLE `tipo_protesis` (
  `ID_PROTESIS` int(11) NOT NULL,
  `DESC_PROTESIS` varchar(30) default NULL,
  PRIMARY KEY  (`ID_PROTESIS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_protesis`
--

/*!40000 ALTER TABLE `tipo_protesis` DISABLE KEYS */;
INSERT INTO `tipo_protesis` (`ID_PROTESIS`,`DESC_PROTESIS`) VALUES 
 (0,'prot0'),
 (1,'prot1'),
 (2,'prot2'),
 (3,'prot3'),
 (4,'prot4'),
 (5,'prot5'),
 (6,'prot6'),
 (7,'prot7'),
 (8,'L0Y70L N7A59WG1Y5AI9IFI3CT8EHB'),
 (9,'JF0H9XE DHQNJYP8RMT7KVJ2CBAGSK'),
 (10,'UR18VFEBGKCEDN9D609C4MB LD6727'),
 (11,'E4NI1JKN70731Y03PXV7UXD RDVMD4'),
 (12,'OUVLVSJGE5U33G XFSR1N6XWEGKJHJ'),
 (13,'BTQV2B7JOR0I8RHHSADB9L9KGGJUG6'),
 (14,'SSFETMEARHVIH7J9RULT6A41T4B71E'),
 (15,'2RD0LGID1QS1OXKMERUW1O651PG80F'),
 (16,'91RJAGGVR3FU  LSY7HJFGQ QCH8VB'),
 (17,'KD2C5DNDO3QRNLXP1HUUTWJEWNDAPQ'),
 (18,'CGP9WM7PL960DBUMCE1LWJG5CI8NH3'),
 (19,'I6O5P4KO4KM5QEPES6L9K96DJ65BWJ');
/*!40000 ALTER TABLE `tipo_protesis` ENABLE KEYS */;


--
-- Definition of table `tipo_prueba`
--

DROP TABLE IF EXISTS `tipo_prueba`;
CREATE TABLE `tipo_prueba` (
  `ID_PRUEBA` int(11) NOT NULL,
  `DESC_PRUEBA` varchar(30) default NULL,
  PRIMARY KEY  (`ID_PRUEBA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_prueba`
--

/*!40000 ALTER TABLE `tipo_prueba` DISABLE KEYS */;
INSERT INTO `tipo_prueba` (`ID_PRUEBA`,`DESC_PRUEBA`) VALUES 
 (0,'prueb0'),
 (1,'prueba1'),
 (2,'prueba2'),
 (3,'prueba3'),
 (4,'prueba4'),
 (5,'prueba5'),
 (6,'prueba6'),
 (7,'prueba7'),
 (8,'3WLU02UCL9IR5G7LY814MS4MR9CTUY'),
 (9,'6XU FSS9U1NXVWAE1MOXA94QBVJM79'),
 (10,'I68PUYUB186RROP8XBJTKU125Q1HCE'),
 (11,'Y2LT3LSQM51C1IBBFBTODSILERNTK7'),
 (12,'N4JT7B5Q1PXO7FIFFOOXDLY804CHR5'),
 (13,'GNRT5A3ONUJXQ9WI6WH0VGC02DJAA5'),
 (14,'2FO4E82W6PQ877VAAG23BB9DVU6WOS'),
 (15,'OELGIA639T6W28DEYRHPOXH0UGTHTE'),
 (16,'V90KNFB7QGMTF0D2G680OR8BN5IMEO'),
 (17,'AD318OKOU6 8TNKXTLWTC8AQ0MBAVF'),
 (18,'4TSP7883HBED808KQ0VMB0E2RE5GQA'),
 (19,'0H1J2B8D07D9SY94R77133VD58JF5Q');
/*!40000 ALTER TABLE `tipo_prueba` ENABLE KEYS */;


--
-- Definition of table `tipo_reflejo`
--

DROP TABLE IF EXISTS `tipo_reflejo`;
CREATE TABLE `tipo_reflejo` (
  `ID_REFLEJO` int(11) NOT NULL,
  `DESC_REFLEJO` varchar(10) default NULL,
  PRIMARY KEY  (`ID_REFLEJO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_reflejo`
--

/*!40000 ALTER TABLE `tipo_reflejo` DISABLE KEYS */;
INSERT INTO `tipo_reflejo` (`ID_REFLEJO`,`DESC_REFLEJO`) VALUES 
 (0,'ref0'),
 (1,'ref1'),
 (2,'ref2'),
 (3,'ref3'),
 (4,'ref4'),
 (5,'ref5'),
 (6,'ref6'),
 (7,'ref7'),
 (8,'3D394XBVGK'),
 (9,'7KIT4JLQGJ'),
 (10,'TMVGFSVSYB'),
 (11,'RAKGJ2H6UK'),
 (12,'4DSCUIADGU'),
 (13,'G2 T2LAPU2'),
 (14,'8M8G8VHHYG'),
 (15,'CPPVVRTF9L'),
 (16,'VAKUP99RUB'),
 (17,'151PTCQE E'),
 (18,'PEXJCK1U1Y'),
 (19,'I42P71GGCQ');
/*!40000 ALTER TABLE `tipo_reflejo` ENABLE KEYS */;


--
-- Definition of table `tipo_vicio`
--

DROP TABLE IF EXISTS `tipo_vicio`;
CREATE TABLE `tipo_vicio` (
  `ID_VICIO` int(11) NOT NULL,
  `DESC_VICIO` varchar(30) NOT NULL,
  PRIMARY KEY  (`ID_VICIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_vicio`
--

/*!40000 ALTER TABLE `tipo_vicio` DISABLE KEYS */;
INSERT INTO `tipo_vicio` (`ID_VICIO`,`DESC_VICIO`) VALUES 
 (0,'vi0'),
 (1,'vic1'),
 (2,'vic2'),
 (3,'vic3'),
 (4,'vic4'),
 (5,'vic5'),
 (6,'vic6'),
 (7,'vic7'),
 (8,'PKTTGHT8778N2O63TQV0VX3IORWT8Y'),
 (9,'OD73YTGUUUNLPV0W3T14BUXT0HWLIX'),
 (10,'M9NA6CS7HOWI0LQUCJ YV1PR6D9JHQ'),
 (11,'Q0LLR25C381J6O7DHOMWQTELY408G3'),
 (12,'1O6NOVOJDKFNQWGU4RKSFNLLFGA3KN'),
 (13,'S8R7EAWKNF3G6UHETRN834HGIXY4GS'),
 (14,'BCCWVQ06JV4D0CCP99TR0V4FCVTMAQ'),
 (15,'NAO9U2N4XFN9Q6M9Y0RG4P6I 16721'),
 (16,'31GQ7NK 6ERFRDTYJ85MIFNF55K DE'),
 (17,'A0T0WTYCLOE9WW784O87B9R3RPMI0V'),
 (18,'QQG9NS0TV3FKSJFGGMAB13 A81CR1S'),
 (19,'TM75HNK6U60YC8700JM08N D9H6W4M');
/*!40000 ALTER TABLE `tipo_vicio` ENABLE KEYS */;


--
-- Definition of table `tratamiento`
--

DROP TABLE IF EXISTS `tratamiento`;
CREATE TABLE `tratamiento` (
  `ID_TRAT` varchar(10) NOT NULL,
  `OBJETIVO_TRAT` text,
  `TRATAMIENTO_TRAT` text,
  PRIMARY KEY  (`ID_TRAT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tratamiento`
--

/*!40000 ALTER TABLE `tratamiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tratamiento` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `USUARIO` varchar(20) NOT NULL,
  `PASS_USUARIO` varchar(20) NOT NULL,
  `NOMBRE` varchar(45) NOT NULL,
  `ID_PERMISO` varchar(10) NOT NULL,
  `APELLIDO` varchar(45) NOT NULL,
  `RUT` varchar(15) NOT NULL,
  PRIMARY KEY  (`USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`ID_USUARIO`,`USUARIO`,`PASS_USUARIO`,`NOMBRE`,`ID_PERMISO`,`APELLIDO`,`RUT`) VALUES 
 (1,'admin','123','Administrador','A','','');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
