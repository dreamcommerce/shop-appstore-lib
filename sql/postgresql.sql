-- MySQL dump 10.13  Distrib 5.6.20-68.0, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: app
-- ------------------------------------------------------
-- Server version	5.6.20-68.0
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO,POSTGRESQL' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table "access_tokens"
--

DROP TABLE IF EXISTS "access_tokens";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE "access_tokens" (
  "id" serial,
  "shop_id" int(10) unsigned DEFAULT NULL,
  "expires_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  "access_token" char(50) COLLATE utf8_polish_ci DEFAULT NULL,
  "refresh_token" char(50) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "shop_id" ("shop_id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "access_tokens"
--

LOCK TABLES "access_tokens" WRITE;
/*!40000 ALTER TABLE "access_tokens" DISABLE KEYS */;
/*!40000 ALTER TABLE "access_tokens" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "billings"
--

DROP TABLE IF EXISTS "billings";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE "billings" (
  "id" serial,
  "shop_id" int(10) unsigned DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ("id"),
  KEY "shop_id" ("shop_id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "billings"
--

LOCK TABLES "billings" WRITE;
/*!40000 ALTER TABLE "billings" DISABLE KEYS */;
/*!40000 ALTER TABLE "billings" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "shops"
--

DROP TABLE IF EXISTS "shops";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE "shops" (
  "id" serial,
  "created_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  "shop" char(50) COLLATE utf8_polish_ci DEFAULT NULL,
  "shop_url" varchar(512) COLLATE utf8_polish_ci DEFAULT NULL,
  "auth_code" char(50) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "shop" ("shop")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "shops"
--

LOCK TABLES "shops" WRITE;
/*!40000 ALTER TABLE "shops" DISABLE KEYS */;
/*!40000 ALTER TABLE "shops" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "subscriptions"
--

DROP TABLE IF EXISTS "subscriptions";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE "subscriptions" (
  "id" serial,
  "shop_id" int(10) unsigned NOT NULL,
  "expires_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "shop_id" ("shop_id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "subscriptions"
--

LOCK TABLES "subscriptions" WRITE;
/*!40000 ALTER TABLE "subscriptions" DISABLE KEYS */;
/*!40000 ALTER TABLE "subscriptions" ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-17 14:11:16
