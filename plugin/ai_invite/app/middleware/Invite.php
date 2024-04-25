<?php
namespace plugin\ai_invite\app\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class Invite implements MiddlewareInterface
{
    public function process(Request $request, callable $handler) : Response
    {
        /** @var Response $response */
        $response = $handler($request);
        // 如果url有传递ai_inviter则尝试设置cookie
        if ($request->route && $aiInviter = $request->route->param('ai_inviter')) {
            if (!$request->cookie('ai_inviter')) {
                $response->cookie('ai_inviter', $aiInviter, 3600 * 24 * 365, '/');
            }
        }
        return $response;
    }
}