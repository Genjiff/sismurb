-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: sismurb
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary view structure for view `pacientes_view`
--

DROP TABLE IF EXISTS `pacientes_view`;
/*!50001 DROP VIEW IF EXISTS `pacientes_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `pacientes_view` AS SELECT 
 1 AS `id`,
 1 AS `nome`,
 1 AS `data_nasc`,
 1 AS `id_pessoa`,
 1 AS `nome_da_mae`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `medicos_view`
--

DROP TABLE IF EXISTS `medicos_view`;
/*!50001 DROP VIEW IF EXISTS `medicos_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `medicos_view` AS SELECT 
 1 AS `id`,
 1 AS `nome`,
 1 AS `id_pessoa`,
 1 AS `especialidade`,
 1 AS `crm`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `consultas_view`
--

DROP TABLE IF EXISTS `consultas_view`;
/*!50001 DROP VIEW IF EXISTS `consultas_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `consultas_view` AS SELECT 
 1 AS `id`,
 1 AS `IdPaciente`,
 1 AS `IdMedico`,
 1 AS `data`,
 1 AS `horario_inicio`,
 1 AS `horario_fim`,
 1 AS `especialidade`,
 1 AS `NomePaciente`,
 1 AS `NomeMedico`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `pacientes_view`
--

/*!50001 DROP VIEW IF EXISTS `pacientes_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pacientes_view` AS select `pessoa`.`id` AS `id`,`pessoa`.`nome` AS `nome`,`pessoa`.`data_nasc` AS `data_nasc`,`paciente`.`id_pessoa` AS `id_pessoa`,`paciente`.`nome_da_mae` AS `nome_da_mae` from (`pessoa` join `paciente`) where (`pessoa`.`id` = `paciente`.`id_pessoa`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `medicos_view`
--

/*!50001 DROP VIEW IF EXISTS `medicos_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `medicos_view` AS select `pessoa`.`id` AS `id`,`pessoa`.`nome` AS `nome`,`medico`.`id_pessoa` AS `id_pessoa`,`medico`.`especialidade` AS `especialidade`,`medico`.`crm` AS `crm` from (`pessoa` join `medico`) where (`pessoa`.`id` = `medico`.`id_pessoa`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `consultas_view`
--

/*!50001 DROP VIEW IF EXISTS `consultas_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `consultas_view` AS select `consulta`.`id` AS `id`,`consulta`.`paciente` AS `IdPaciente`,`consulta`.`medico` AS `IdMedico`,`consulta`.`data` AS `data`,`consulta`.`horario_inicio` AS `horario_inicio`,`consulta`.`horario_fim` AS `horario_fim`,`medico`.`especialidade` AS `especialidade`,`pp`.`nome` AS `NomePaciente`,`dp`.`nome` AS `NomeMedico` from (((`consulta` join `medico` on((`consulta`.`medico` = `medico`.`id_pessoa`))) join `pessoa` `dp` on((`consulta`.`medico` = `dp`.`id`))) join `pessoa` `pp` on((`consulta`.`paciente` = `pp`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Dumping routines for database 'sismurb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-26 11:11:01
