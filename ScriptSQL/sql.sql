/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : b2btic

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 21/04/2020 15:40:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for b2b_archivo
-- ----------------------------
DROP TABLE IF EXISTS `b2b_archivo`;
CREATE TABLE `b2b_archivo`  (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for b2b_tipo_archivo
-- ----------------------------
DROP TABLE IF EXISTS `b2b_tipo_archivo`;
CREATE TABLE `b2b_tipo_archivo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idarchivo` int(11) NOT NULL,
  `extension` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `idarchivo`) USING BTREE,
  INDEX `foreignkeytipoarchivo`(`idarchivo`) USING BTREE,
  CONSTRAINT `foreignkeytipoarchivo` FOREIGN KEY (`idarchivo`) REFERENCES `b2b_archivo` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1130 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
