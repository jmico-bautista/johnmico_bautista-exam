/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : sociablekit

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 18/03/2021 16:52:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for youtube_channel_videos
-- ----------------------------
DROP TABLE IF EXISTS `youtube_channel_videos`;
CREATE TABLE `youtube_channel_videos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `channel_id` int NOT NULL,
  `video_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 101 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for youtube_channels
-- ----------------------------
DROP TABLE IF EXISTS `youtube_channels`;
CREATE TABLE `youtube_channels`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `profile_picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
