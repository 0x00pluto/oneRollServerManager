<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/10/29
 * Time: 下午5:04
 */

return [
    '用户管理' => [
        [
            'name' => '用户ID查询',
            'url' => '/user/lookForUserId'
        ],
        [
            'name' => '用户查询',
            'url' => '/user/userinfo'
        ],
        [
            'name' => '用户钻石游戏币管理',
            'url' => '/user/diamond'
        ],
//        [
//
//            'name' => '餐厅经验管理',
//            'url' => '/user/restaurant'
//        ],
        [

            'name' => '游戏道具管理',
            'url' => '/user/item'
        ],
        [
            'name' => '用户充值查询',
            'url' => '/user/recharge'
        ]
        ,
        [
            'name' => '删除用户',
            'url' => '/user/killPlayer'
        ]
    ],
    '日志管理' => [
        [
            'name' => '客户端崩溃日志查询',
            'url' => '/logQuery/crashLogQuery'
        ],

        [
            'name' => '游戏记录日志查询',
            'url' => '/logQuery/gameRecordLogQuery',
            'child' => [
                [
                    'name' => '登入信息',
                    'url' => '/logQuery/gameRecordLogQuery/LOGTYPE_USERLOGIN'
                ],
                [
                    'name' => '退出信息',
                    'url' => '/logQuery/gameRecordLogQuery/LOGTYPE_USERLOGOUT'
                ],
                [
                    'name' => '增加钻石',
                    'url' => '/logQuery/gameRecordLogQuery/LOGTYPE_ADDDIAMOND'
                ],
                [
                    'name' => '花费钻石',
                    'url' => '/logQuery/gameRecordLogQuery/LOGTYPE_COSTDIAMOND'
                ],
                [
                    'name' => '增加游戏币',
                    'url' => '/logQuery/gameRecordLogQuery/LOGTYPE_ADDGAMECOIN'
                ],
                [
                    'name' => '减少游戏币',
                    'url' => '/logQuery/gameRecordLogQuery/LOGTYPE_COSTGAMECOIN'
                ],
                [
                    'name' => '钻石购买道具',
                    'url' => '/logQuery/gameRecordLogQuery/LOGTYPE_DIAMONDBUYITEM'
                ],
                [
                    'name' => '充值信息',
                    'url' => '/logQuery/gameRecordLogQuery/LOGTYPE_RECHAGRE',
                ],
                [
                    'name' => '新手引导开启',
                    'url' => '/logQuery/gameRecordLogQuery/LOGTYPE_USERGUIDE_BEGIN',
                ],
                [
                    'name' => '新手引导关闭',
                    'url' => '/logQuery/gameRecordLogQuery/LOGTYPE_USERGUIDE_END',
                ],
            ]
        ]
    ],

    '服务器管理' => [
        [
            'name' => '服务器状态管理',
            'url' => '/gmtools/serverStatus'
        ],
        [
            'name' => '全局邮件管理',
            'url' => '/gmtools/SystemMail'
        ]

    ]
];