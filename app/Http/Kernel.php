<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    // 全局中间件，最先调用
    protected $middleware = [
        //检测网站是否在维护模式
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,

        //检测请求数据是否过大
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        //对提交参数进行剪裁处理
        \App\Http\Middleware\TrimStrings::class,

        //将请求中的空子串转换为null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

        //修改代理服务器后的服务器参数
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    //定义中间件组
    protected $middlewareGroups = [
        //web中间件组，用于定义route/web.php使用的中间件
        'web' => [
            //cookie中间件
            \App\Http\Middleware\EncryptCookies::class,

            //添加cookie到响应中
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

            //开启会话
            \Illuminate\Session\Middleware\StartSession::class,

            //用户认证中间件，开启后Auth才能生效
             \Illuminate\Session\Middleware\AuthenticateSession::class,

            //将系统中的错误信息写入到视图$error变量中
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            //检验CSRF，防止跨站请求攻击
            \App\Http\Middleware\VerifyCsrfToken::class,

            //处理路由绑定
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            //记录用户最后活跃时间
            \App\Http\Middleware\RecordLastActiveTime::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */

    //中间件别名设置
    protected $routeMiddleware = [
        //用户认证
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,

        //HTTP基本认证
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

        //路由绑定
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,

        //访问权限控制
        'can' => \Illuminate\Auth\Middleware\Authorize::class,

        //只有游客才能访问的页面
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        //节流【1分钟内只能请求10次】
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
