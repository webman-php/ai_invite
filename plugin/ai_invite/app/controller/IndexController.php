<?php

namespace plugin\ai_invite\app\controller;

use plugin\ai_invite\app\model\AiInvite;
use plugin\ai_invite\app\model\AiInviteReward;
use plugin\ai_invite\app\service\Invite;
use plugin\user\api\User;
use support\Request;

class IndexController
{

    public function index(Request $request)
    {
        if (!session('user')) {
            return redirect('/app/ai/user/login?redirect=' . urlencode($request->uri()));
        }
        $userId = session('user.uid') ?? session('user.id');
        $totalAmount = AiInviteReward::where('inviter', $userId)->sum('amount');
        $totalRewords = AiInviteReward::where('inviter', $userId)->count();
        $totalInvitees = AiInvite::where('inviter', $userId)->count('invitee');
        return view('index/index', [
            'totalAmount' => $totalAmount,
            'totalRewords' => $totalRewords,
            'totalInvitees' => $totalInvitees,
            'setting' => Invite::getSetting(),
        ]);
    }

    public function invitees()
    {
        $userId = session('user.uid') ?? session('user.id');
        $items = AiInviteReward::where('inviter', $userId)->orderBy('id')->get();
        $userIdArray = array_unique($items->pluck('invitee')->toArray());
        $users = User::whereIn('id', $userIdArray)->get()->keyBy('id');
        $data = [];
        $typeMap = [
            'recharge' => '充值奖励',
            'register' => '注册奖励',
        ];
        foreach ($items as $item) {
            $user = $users[$item->invitee];
            $data[] = [
                'id' => $user->id,
                'nickname' => $user->nickname,
                'avatar' => $user->avatar,
                'amount' => $item->amount,
                'created_at' => $item->created_at,
                'type' => $typeMap[$item->type],
            ];
        }
        return json([
            'code' => 0,
            'msg' => 'ok',
            'data' => $data,
        ]);
    }

}
