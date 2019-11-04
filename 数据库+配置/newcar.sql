/*
 Navicat Premium Data Transfer

 Source Server         : window
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : newcar

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 07/10/2019 21:30:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `status` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (1, 'admin', '123', 0);
INSERT INTO `admin_users` VALUES (4, 'wangga', '123', 0);
INSERT INTO `admin_users` VALUES (8, '汪刚', '123', 0);

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles`  (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '标题',
  `descr` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '描述',
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '图片',
  `opic` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES (1, 'dakd ', '1233', '587e0910ef1a7cb3d8fcca9da9e41810.jpg', NULL);
INSERT INTO `articles` VALUES (2, 'davdadee ', '123dadd', '587e0910ef1a7cb3d8fcca9da9e41810.jpg', NULL);
INSERT INTO `articles` VALUES (3, '544', '1233', '587e0910ef1a7cb3d8fcca9da9e41810.jpg', NULL);

-- ----------------------------
-- Table structure for cates
-- ----------------------------
DROP TABLE IF EXISTS `cates`;
CREATE TABLE `cates`  (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `pid` int(8) NULL DEFAULT NULL,
  `path` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 119 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cates
-- ----------------------------
INSERT INTO `cates` VALUES (12, '女装', 0, '0');
INSERT INTO `cates` VALUES (18, '男装', 0, '0');
INSERT INTO `cates` VALUES (56, '李宁男装', 18, '0,18');
INSERT INTO `cates` VALUES (54, '儿童蕾丝', 12, '0,12');
INSERT INTO `cates` VALUES (58, '安踏男装', 18, '0,18');
INSERT INTO `cates` VALUES (59, 'ss', 12, '0,12');
INSERT INTO `cates` VALUES (109, 'wq', 12, '0,12');
INSERT INTO `cates` VALUES (115, 'www22', 18, '0,18');
INSERT INTO `cates` VALUES (116, '手机', 0, '0');
INSERT INTO `cates` VALUES (117, 'oppo', 116, '0,116');
INSERT INTO `cates` VALUES (118, 'oppox1', 117, '0,116,117');

-- ----------------------------
-- Table structure for node
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '节点名',
  `mname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '控制器名字',
  `aname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '控制器下的方法',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO `node` VALUES (1, '管理员列表', 'adminss', 'getindex', 0);
INSERT INTO `node` VALUES (2, '管理员添加', 'adminss', 'getadd', 0);
INSERT INTO `node` VALUES (3, '管理员删除', 'adminss', 'getdelete', 0);
INSERT INTO `node` VALUES (4, '管理员修改', 'adminss', 'getedit', 0);
INSERT INTO `node` VALUES (5, '会员列表', 'users', 'getindex', 0);
INSERT INTO `node` VALUES (6, '会员添加', 'users', 'getadd', 0);
INSERT INTO `node` VALUES (7, '会员删除', 'users', 'getdelete', 0);
INSERT INTO `node` VALUES (8, '会员修改', 'users', 'getedit', 0);
INSERT INTO `node` VALUES (9, '分类管理列表', 'cate', 'getindex', 0);
INSERT INTO `node` VALUES (10, '分类管理添加', 'cate', 'getadd', 0);
INSERT INTO `node` VALUES (11, '分类管理删除', 'cate', 'getdelete', 0);
INSERT INTO `node` VALUES (12, '分类管理修改', 'cate ', 'getedit', 0);
INSERT INTO `node` VALUES (13, '文章管理列表', 'articles', 'getindex', 0);
INSERT INTO `node` VALUES (14, '文章管理添加', 'articles', 'getadd', 0);
INSERT INTO `node` VALUES (15, '文章管理删除', 'articles', 'getdelete', 0);
INSERT INTO `node` VALUES (16, '文章管理修改', 'articles', 'getedit', 0);
INSERT INTO `node` VALUES (17, '分配角色', 'adminss', 'getrolelist', 0);
INSERT INTO `node` VALUES (18, '保存角色', 'adminss', 'postsaverole', 0);
INSERT INTO `node` VALUES (19, '角色列表信息', 'rolelist', 'getindex', 0);
INSERT INTO `node` VALUES (20, '添加角色信息', 'rolelist', 'getadd', 0);
INSERT INTO `node` VALUES (21, '删除角色信息', 'rolelist', 'getdelete', 0);
INSERT INTO `node` VALUES (22, '修改角色信息', 'rolelist', 'getedit', 0);
INSERT INTO `node` VALUES (23, '获取节点信息', 'lists', 'getindex', 0);
INSERT INTO `node` VALUES (24, '添加节点', 'lists', 'getadd', 0);
INSERT INTO `node` VALUES (25, '分配权限', 'rolelist', 'getauth', 0);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '角色名字',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '负责模块(备注)\r\n负责模块(备注)\r\n负责模块(备注)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, '超级管理员', 0, '');

-- ----------------------------
-- Table structure for role_node
-- ----------------------------
DROP TABLE IF EXISTS `role_node`;
CREATE TABLE `role_node`  (
  `rid` int(8) NOT NULL,
  `nid` int(8) NULL DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of role_node
-- ----------------------------
INSERT INTO `role_node` VALUES (1, 1);
INSERT INTO `role_node` VALUES (1, 2);
INSERT INTO `role_node` VALUES (1, 3);
INSERT INTO `role_node` VALUES (1, 4);
INSERT INTO `role_node` VALUES (1, 5);
INSERT INTO `role_node` VALUES (1, 6);
INSERT INTO `role_node` VALUES (1, 7);
INSERT INTO `role_node` VALUES (1, 8);
INSERT INTO `role_node` VALUES (1, 9);
INSERT INTO `role_node` VALUES (1, 10);
INSERT INTO `role_node` VALUES (1, 11);
INSERT INTO `role_node` VALUES (1, 12);
INSERT INTO `role_node` VALUES (1, 13);
INSERT INTO `role_node` VALUES (1, 14);
INSERT INTO `role_node` VALUES (1, 15);
INSERT INTO `role_node` VALUES (1, 16);
INSERT INTO `role_node` VALUES (1, 17);
INSERT INTO `role_node` VALUES (1, 18);
INSERT INTO `role_node` VALUES (1, 19);
INSERT INTO `role_node` VALUES (1, 20);
INSERT INTO `role_node` VALUES (1, 21);
INSERT INTO `role_node` VALUES (1, 22);
INSERT INTO `role_node` VALUES (1, 23);
INSERT INTO `role_node` VALUES (1, 24);
INSERT INTO `role_node` VALUES (1, 25);

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role`  (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `rid` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES (1, 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `status` int(2) NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `phone` char(32) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (7, 'admin2', '1320410046@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '9578', '13418755560');
INSERT INTO `users` VALUES (6, 'admin', '1320410048@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '976', '13418755562');
INSERT INTO `users` VALUES (9, 'yifan11', '623992919@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '4515', '13418755570');

SET FOREIGN_KEY_CHECKS = 1;
