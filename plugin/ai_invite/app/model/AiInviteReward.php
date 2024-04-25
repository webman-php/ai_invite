<?php

namespace plugin\ai_invite\app\model;

use plugin\admin\app\model\Base;

/**
 * @property integer $id 主键(主键)
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 * @property integer $inviter 邀请人
 * @property integer $invitee 受邀人
 * @property string $amount 奖励
 * @property integer $percent 百分比
 * @property string $data 数据
 * @property string $type 类型
 */
class AiInviteReward extends Base
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ai_invite_rewards';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    
    
}
