CREATE TABLE `ai_invite` (
 `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
 `created_at` datetime DEFAULT NULL COMMENT '创建时间',
 `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
 `inviter` int DEFAULT NULL COMMENT '邀请人',
 `invitee` int DEFAULT NULL COMMENT '受邀人',
 `percent` tinyint unsigned DEFAULT '10' COMMENT '奖励百分比',
 PRIMARY KEY (`id`),
 UNIQUE KEY `invitee` (`invitee`),
 KEY `inviter` (`inviter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='邀请';

CREATE TABLE `ai_invite_rewards` (
 `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
 `created_at` datetime DEFAULT NULL COMMENT '创建时间',
 `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
 `inviter` int DEFAULT NULL COMMENT '邀请人',
 `invitee` int DEFAULT NULL COMMENT '受邀人',
 `amount` decimal(8,2) DEFAULT NULL COMMENT '奖励',
 `percent` tinyint unsigned DEFAULT NULL COMMENT '百分比',
 `data` text COLLATE utf8mb4_general_ci COMMENT '数据',
 `type` enum('register','recharge') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'recharge' COMMENT '类型',
 PRIMARY KEY (`id`),
 KEY `inviter` (`inviter`),
 KEY `invitee` (`invitee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='邀请奖励';