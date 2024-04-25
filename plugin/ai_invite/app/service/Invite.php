<?php

namespace plugin\ai_invite\app\service;

use plugin\admin\app\model\Option;

class Invite
{
    public static function getSetting()
    {
        $key = 'ai_invite-setting';
        $setting = Option::where('name', $key)->value('value');
        if (!$setting) {
            $setting = json_encode(['percent' => 10]);
            $option = new Option;
            $option->name = $key;
            $option->value = $setting;
            $option->save();
        }
        return json_decode($setting, true);
    }
}