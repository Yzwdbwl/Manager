/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : lar9

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2024-05-05 19:21:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for access
-- ----------------------------
DROP TABLE IF EXISTS `access`;
CREATE TABLE `access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT '0' COMMENT '角色的ID',
  `permission_id` int(11) DEFAULT '0' COMMENT '节点的ID',
  `type` tinyint(1) DEFAULT '1' COMMENT '标识是用户组还是用户1为用户组2为用户,默认为用户组',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `node_id` (`permission_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=444 DEFAULT CHARSET=utf8 COMMENT='权限表_by_jiang';

-- ----------------------------
-- Records of access
-- ----------------------------
INSERT INTO `access` VALUES ('394', '1', '1', '1');
INSERT INTO `access` VALUES ('395', '1', '43', '1');
INSERT INTO `access` VALUES ('396', '1', '55', '1');
INSERT INTO `access` VALUES ('397', '1', '73', '1');
INSERT INTO `access` VALUES ('398', '1', '56', '1');
INSERT INTO `access` VALUES ('399', '1', '57', '1');
INSERT INTO `access` VALUES ('400', '1', '58', '1');
INSERT INTO `access` VALUES ('401', '1', '59', '1');
INSERT INTO `access` VALUES ('402', '1', '60', '1');
INSERT INTO `access` VALUES ('403', '1', '61', '1');
INSERT INTO `access` VALUES ('404', '1', '62', '1');
INSERT INTO `access` VALUES ('405', '1', '63', '1');
INSERT INTO `access` VALUES ('406', '1', '67', '1');
INSERT INTO `access` VALUES ('407', '1', '4', '1');
INSERT INTO `access` VALUES ('408', '1', '20', '1');
INSERT INTO `access` VALUES ('409', '1', '27', '1');
INSERT INTO `access` VALUES ('410', '1', '28', '1');
INSERT INTO `access` VALUES ('411', '1', '29', '1');
INSERT INTO `access` VALUES ('412', '1', '2', '1');
INSERT INTO `access` VALUES ('413', '1', '23', '1');
INSERT INTO `access` VALUES ('414', '1', '24', '1');
INSERT INTO `access` VALUES ('415', '1', '25', '1');
INSERT INTO `access` VALUES ('416', '1', '26', '1');
INSERT INTO `access` VALUES ('417', '1', '3', '1');
INSERT INTO `access` VALUES ('418', '1', '30', '1');
INSERT INTO `access` VALUES ('419', '1', '31', '1');
INSERT INTO `access` VALUES ('420', '1', '32', '1');
INSERT INTO `access` VALUES ('421', '1', '33', '1');
INSERT INTO `access` VALUES ('422', '1', '68', '1');
INSERT INTO `access` VALUES ('423', '1', '53', '1');
INSERT INTO `access` VALUES ('424', '1', '34', '1');
INSERT INTO `access` VALUES ('425', '1', '69', '1');
INSERT INTO `access` VALUES ('426', '1', '36', '1');
INSERT INTO `access` VALUES ('427', '1', '35', '1');
INSERT INTO `access` VALUES ('428', '1', '48', '1');
INSERT INTO `access` VALUES ('429', '1', '49', '1');
INSERT INTO `access` VALUES ('430', '1', '37', '1');
INSERT INTO `access` VALUES ('431', '1', '45', '1');
INSERT INTO `access` VALUES ('432', '1', '46', '1');
INSERT INTO `access` VALUES ('433', '1', '47', '1');
INSERT INTO `access` VALUES ('434', '1', '42', '1');
INSERT INTO `access` VALUES ('435', '1', '50', '1');
INSERT INTO `access` VALUES ('436', '1', '51', '1');
INSERT INTO `access` VALUES ('437', '1', '52', '1');
INSERT INTO `access` VALUES ('438', '1', '66', '1');
INSERT INTO `access` VALUES ('439', '1', '44', '1');
INSERT INTO `access` VALUES ('440', '1', '1', '2');
INSERT INTO `access` VALUES ('441', '1', '55', '2');
INSERT INTO `access` VALUES ('442', '1', '73', '2');
INSERT INTO `access` VALUES ('443', '1', '58', '2');

-- ----------------------------
-- Table structure for artice
-- ----------------------------
DROP TABLE IF EXISTS `artice`;
CREATE TABLE `artice` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text COMMENT '标题',
  `subtitle` text COMMENT '副标题',
  `other` varchar(255) DEFAULT NULL COMMENT '作者',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `content` longtext COMMENT '内容',
  `is_delete` tinyint(1) DEFAULT '1' COMMENT '删除态0删除1未删',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of artice
-- ----------------------------
INSERT INTO `artice` VALUES ('1', 'asdas', 'asdasd', 'asdad', '2024-05-05 18:07:57', null, '1', '1');
INSERT INTO `artice` VALUES ('2', 'fffghj', 'fff', 'ffff', '2024-05-05 18:31:42', '<p>sdfasdfasdasdhhhh</p>', '1', '1');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL COMMENT '用户组名',
  `mark` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否禁用',
  `level` int(11) DEFAULT '0' COMMENT '用户组等级，低等级的不能对高等级的用户做修改',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户组表_by_jiang';

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('1', '超级用户组', '123123a', '1', '1');
INSERT INTO `group` VALUES ('2', 'testxx', '1', '1', '1');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2019_12_14_000001_create_personal_access_tokens_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('18385258220@163.com', '$2y$10$IDZHKGk07socHxHftUDjJ.QzR0T40Sv8htVvLtcZNGKktJ1d8acIy', '2024-05-05 09:54:30');

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) DEFAULT NULL COMMENT '模块',
  `class` varchar(255) DEFAULT NULL COMMENT '类',
  `action` varchar(255) DEFAULT NULL COMMENT '函数',
  `name` varchar(255) DEFAULT NULL COMMENT '节点的名字',
  `display` tinyint(1) DEFAULT '0' COMMENT '1为显示为菜单，0则不显示',
  `pid` int(11) DEFAULT '0' COMMENT '节点的父节点，此值一般用于输出树形结构，0则为顶级',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `level` tinyint(2) DEFAULT '1' COMMENT '第几级菜单',
  `mark` varchar(255) DEFAULT NULL COMMENT '备注',
  `add_time` bigint(20) DEFAULT '0' COMMENT '增加的日期',
  PRIMARY KEY (`id`),
  KEY `module` (`module`) USING BTREE,
  KEY `class` (`class`) USING BTREE,
  KEY `action` (`action`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COMMENT='权限节点表_by_jiang';

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES ('1', 'foundation', 'index', 'index', '系统管理', '1', '0', '0', '1', '系统管理页面，不作权限验证，只用做菜单显示', '0');
INSERT INTO `permission` VALUES ('2', 'foundation', 'group', 'index', '用户组管理', '1', '67', '2', '3', '用户组管理页面', '0');
INSERT INTO `permission` VALUES ('3', 'foundation', 'acl', 'index', '功能管理', '1', '67', '1', '3', '功能管理页面', '0');
INSERT INTO `permission` VALUES ('4', 'foundation', 'user', 'index', '用户管理', '1', '67', '3', '3', '用户管理页面', '0');
INSERT INTO `permission` VALUES ('20', 'foundation', 'user', 'add', '增加用户', '0', '4', '0', '4', '增加一个用户', '0');
INSERT INTO `permission` VALUES ('23', 'foundation', 'group', 'add', '增加用户组', '0', '2', '0', '4', '增加用户组', '1406882443');
INSERT INTO `permission` VALUES ('24', 'foundation', 'group', 'edit', '用户组编辑', '0', '2', '0', '4', '用户组编辑', '1406882515');
INSERT INTO `permission` VALUES ('25', 'foundation', 'group', 'delete', '用户组删除', '0', '2', '0', '4', '用户组删除、批量删除', '1406882542');
INSERT INTO `permission` VALUES ('26', 'foundation', 'acl', 'group', '用户组权限管理', '0', '2', '0', '4', '用户组权限管理', '1406882568');
INSERT INTO `permission` VALUES ('27', 'foundation', 'user', 'edit', '用户编辑', '0', '4', '0', '4', '用户编辑', '1406882640');
INSERT INTO `permission` VALUES ('28', 'foundation', 'user', 'delete', '用户删除', '0', '4', '0', '4', '用户删除', '1406882664');
INSERT INTO `permission` VALUES ('29', 'foundation', 'acl', 'user', '用户权限管理', '0', '4', '0', '4', '用户权限管理、设置用户权限', '1406882698');
INSERT INTO `permission` VALUES ('30', 'foundation', 'acl', 'add', '增加功能菜单', '0', '3', '0', '4', '增加功能菜单', '1406882729');
INSERT INTO `permission` VALUES ('31', 'foundation', 'acl', 'edit', '功能菜单编辑', '0', '3', '0', '4', '功能菜单编辑', '1406882754');
INSERT INTO `permission` VALUES ('32', 'foundation', 'acl', 'delete', '功能菜单删除', '0', '3', '0', '4', '功能菜单删除', '1406882775');
INSERT INTO `permission` VALUES ('33', 'foundation', 'acl', 'sort', '功能菜单排序', '0', '3', '0', '4', '功能菜单排序', '1406882815');
INSERT INTO `permission` VALUES ('34', 'blog', '内容管理', '内容管理', '内容管理', '1', '0', '0', '1', '内容管理', '1407374295');
INSERT INTO `permission` VALUES ('35', 'blog', 'content', 'add', '发表文章', '0', '36', '0', '4', '发表文章', '1407374316');
INSERT INTO `permission` VALUES ('36', 'blog', 'content', 'index', '文章列表', '1', '69', '0', '3', '文章列表', '1407374358');
INSERT INTO `permission` VALUES ('43', 'foundation', 'index', 'cs', '功能示例', '1', '1', '0', '2', '一些小功能的合集，可以用来加快开发的速度。', '1427788812');
INSERT INTO `permission` VALUES ('44', 'foundation', 'upload', 'index', '弹出窗口上传', '0', '66', '0', '2', '通用的弹出窗口上传。', '1427790345');
INSERT INTO `permission` VALUES ('48', 'blog', 'content', 'edit', '编辑文章', '0', '36', '0', '4', '', '1429509849');
INSERT INTO `permission` VALUES ('49', 'blog', 'content', 'delete', '删除文章', '0', '36', '0', '3', '', '1429509889');
INSERT INTO `permission` VALUES ('66', '通用功能', '通用功能', '通用功能', '通用功能', '0', '0', '0', '1', '通用功能，一般会开发这些功能给用户。', '1435545336');
INSERT INTO `permission` VALUES ('67', '用户与权限管理', '用户与权限管理', '用户与权限管理', '用户与权限管理', '1', '1', '0', '2', '包括功能用户管理、用户组管理、功能管理，权限管理。', '1436147892');
INSERT INTO `permission` VALUES ('69', '文章管理', '文章管理', '文章管理', '文章管理', '1', '34', '0', '2', '文章管理', '1436150232');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_id` int(11) DEFAULT '2' COMMENT '分组ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'xandy', '18385258220@163.com', null, '$2y$10$Ca4Ax2MS/2z8DLtN8dgA3uXRukGSRhuOWb1FnYox3ceAn9VwHdZQW', null, '2024-05-05 09:56:51', '2024-05-05 09:56:51', '1');
INSERT INTO `users` VALUES ('2', 'fg', 'fg@163.com', null, '$2y$10$9IAhiHg/k47NMw7tdFifv.POPAj6I07ER6QdyWlzHX7F1b1utwcNe', null, '2024-05-05 10:37:19', '2024-05-05 10:43:10', '2');
