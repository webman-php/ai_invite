<?php

return [
    [
        'title' => 'AI助手',
        'key' => 'plugin_ai',
        'icon' => 'layui-icon-android',
        'weight' => 490,
        'type' => 0,
        'children' => [
            [
                'title' => 'AI邀请关系',
                'key' => 'plugin\\ai_invite\\app\\admin\\controller\\AiInviteController',
                'href' => '/app/ai_invite/admin/ai-invite',
                'type' => 1,
                'weight' => 60,
            ], [
                'title' => 'AI邀请奖励',
                'key' => 'plugin\\ai_invite\\app\\admin\\controller\\AiInviteRewordController',
                'href' => '/app/ai_invite/admin/ai-invite-reward/index',
                'type' => 1,
                'weight' => 50,
            ]
        ]
    ],
];
