<?php

namespace plugin\ai_invite\app\admin\controller;

use support\Request;
use support\Response;
use plugin\ai_invite\app\model\AiInviteReward;
use plugin\admin\app\controller\Crud;
use support\exception\BusinessException;

/**
 * AI邀请奖励 
 */
class AiInviteRewardController extends Crud
{
    
    /**
     * @var AiInviteReward
     */
    protected $model = null;

    /**
     * 构造函数
     * @return void
     */
    public function __construct()
    {
        $this->model = new AiInviteReward;
    }
    
    /**
     * 浏览
     * @return Response
     */
    public function index(): Response
    {
        return view('ai-invite-reward/index');
    }

    /**
     * 插入
     * @param Request $request
     * @return Response
     * @throws BusinessException
     */
    public function insert(Request $request): Response
    {
        if ($request->method() === 'POST') {
            return parent::insert($request);
        }
        return view('ai-invite-reward/insert');
    }

    /**
     * 更新
     * @param Request $request
     * @return Response
     * @throws BusinessException
    */
    public function update(Request $request): Response
    {
        if ($request->method() === 'POST') {
            return parent::update($request);
        }
        return view('ai-invite-reward/update');
    }

}
