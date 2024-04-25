<?php

namespace plugin\ai_invite\app\admin\controller;

use plugin\admin\app\model\Option;
use plugin\ai_invite\app\service\Invite;
use support\Request;
use support\Response;
use plugin\ai_invite\app\model\AiInvite;
use plugin\admin\app\controller\Crud;
use support\exception\BusinessException;

/**
 * AI邀请关系 
 */
class AiInviteController extends Crud
{
    
    /**
     * @var AiInvite
     */
    protected $model = null;

    /**
     * 构造函数
     * @return void
     */
    public function __construct()
    {
        $this->model = new AiInvite;
    }
    
    /**
     * 浏览
     * @return Response
     */
    public function index(): Response
    {
        return view('ai-invite/index');
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
        return view('ai-invite/insert');
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
        return view('ai-invite/update');
    }

    /**
     * 获取配置
     * @param Request $request
     * @return Response
     */
    public function setting(Request $request): Response
    {
        $key = 'ai_invite-setting';
        if ($request->method() === 'POST') {
            $data = $request->post();
            Option::where('name', $key)->update(['value' => json_encode($data)]);
            return json(['code' => 0, 'msg' => 'ok']);
        }
        return json(['code' => 0, 'msg' => 'ok', 'data' => Invite::getSetting()]);
    }

}
