<?php

use plugin\ai\app\event\data\EventData;
use plugin\ai\app\model\AiModel;
use plugin\ai_invite\app\model\AiInvite;
use plugin\ai_invite\app\model\AiInviteReward;
use plugin\ai_invite\app\service\Invite;
use plugin\user\app\model\User;
use plugin\ai\api\User as ApiUser;

return [
    'user.register' => [
        100 => function (User $user) {
            $request = request();
            if (!$request) {
                return;
            }
            $inviter = $request->cookie('ai_inviter');
            if ($inviter && is_numeric($inviter) && User::find($inviter)) {
                $aiInvite = new AiInvite();
                $aiInvite->inviter = $inviter;
                $aiInvite->invitee = $user->id;
                $aiInvite->percent = Invite::getSetting()['percent'] ?? 10;
                $aiInvite->save();
            }
        }
    ],
    'ai.payment.success' => [
        100 => function ($paymentData) {
            $userId = $paymentData->userId;
            $data = $paymentData->data;
            $aiInvite = AiInvite::where('invitee', $userId)->first();
            if (!$aiInvite) {
                return;
            }
            $percent = $aiInvite->percent;
            $inviter = $aiInvite->inviter;
            $reward = new AiInviteReward;
            $reward->inviter = $inviter;
            $reward->invitee = $userId;
            $reward->percent = $percent;
            $reward->data = json_encode($data);
            $reward->amount = round($data['price'] * $percent, 2);
            $reward->type = 'recharge';
            $reward->save();
            // 自动给邀请人增加余额
            $modelTypes = AiModel::pluck('type')->toArray();
            $data['days'] = isset($data['months']) ? $data['months'] * 30 : $data['days'];
            $data['days'] = ceil($data['days'] * $percent);
            unset($data['months']);
            foreach ($data as $key => $value) {
                if (in_array($key, $modelTypes)) {
                    $data[$key] = ceil($value * $percent);
                }
            }
            ApiUser::addBalanceByPlanData($inviter, $data);
        }
    ],
    'ai.menu.list' => [
        100 => function (EventData $object) {
            $data = $object->data;
            $data['invite'] = [
                'enabled' => true,
                'title' => '邀请好友',
                'icon' => [
                    'light' => '<i class="bi bi-share f22"></i>',
                    'dark' => '<i class="bi bi-share f22"></i>',
                    'active' => '<i class="bi bi-share-fill f22"></i>'
                ],
                'url' => '/app/ai_invite',
                'mobile' => true,
            ];
            $object->data = $data;
        }
    ]

];
