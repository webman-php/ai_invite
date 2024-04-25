<?php

use plugin\ai_invite\app\middleware\Invite;
use plugin\ai\app\controller\IndexController;
use Webman\Route;

Route::any('/ai/{ai_inviter:\d+}', [IndexController::class, 'index'])->middleware(Invite::class);