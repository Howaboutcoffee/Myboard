<?php

use App\Services\ThemeService;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function (Request $request) {
    if (config('v2board.app_url') && config('v2board.safe_mode_enable', 0)) {
        if ($request->server('HTTP_HOST') !== parse_url(config('v2board.app_url'))['host']) {
            abort(403);
        }
    }
    $renderParams = [
        'title' => config('v2board.app_name', 'V2Board'),
        'theme' => config('v2board.frontend_theme', 'default'),
        'version' => config('app.version'),
        'description' => config('v2board.app_description', 'V2Board is best'),
        'logo' => config('v2board.logo')
    ];

    if (!config("theme.{$renderParams['theme']}")) {
        $themeService = new ThemeService($renderParams['theme']);
        $themeService->init();
    }

    $renderParams['theme_config'] = config('theme.' . config('v2board.frontend_theme', 'default'));
    return view('theme::' . config('v2board.frontend_theme', 'default') . '.dashboard', $renderParams);
});*/

// 关闭用户前端
Route::get('/', function () {
    $appUrl  = 'https://your.domain.com';
    $apiUrl  = $appUrl . '/api';
    $appName = 'Penguin Notes'; // 伪装站点名称

    $html = <<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$appName} - 技术随笔</title>
    <style>
        body { font-family: "Helvetica Neue", Arial, sans-serif; background: #fdfdfd; margin: 0; padding: 0; color: #333; line-height: 1.7; }
        header { background: #2c3e50; color: #fff; padding: 20px; text-align: center; }
        main { max-width: 900px; margin: 40px auto; padding: 0 20px; }
        h1, h2, h3 { color: #2c3e50; }
        p { margin: 15px 0; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 4px; }
        .warning { color: #c0392b; font-weight: bold; }
        ul { margin-left: 20px; }
        footer { text-align: center; padding: 20px; font-size: 14px; color: #aaa; margin-top: 40px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <header>
        <h1>{$appName}</h1>
        <p>技术笔记 · 游戏性能优化</p>
    </header>
    <main>
        <h1>✏️ 前言</h1>
        <p>众所周知，英伟达为了卖 40 系显卡，为『帧生成』功能设置了付费墙，你需要购买更新型号的显卡，才能启用它。</p>
        <p>实际上，所有 RTX 显卡都可以使用『帧生成』功能。</p>
        <p>作为比较，我使用的 2080 Ti 在《幸福工厂》这款游戏中成功启用了『帧生成』功能后，帧数由 <strong>87 帧</strong> 提升至 <strong>137 帧</strong>。</p>

        <h2>开启流程（安装目录因游戏而异）</h2>
        <p class="warning">❗ 不要在多人游戏中使用，修改文件可能被视为作弊!</p>
        <ol>
            <li>下载 DLSS-Enabler：<a href="https://github.com/artur-graniszewski/DLSS-Enabler/releases" target="_blank">GitHub Release</a></li>
            <li>将 DLSS-Enabler 安装到任意文件夹</li>
            <li>打开你安装 DLSS-Enabler 的文件夹，将文件复制粘贴到 <code>Satisfactory > Engine > Binaries > Win64</code>（如有提示选择覆盖），务必先备份</li>
            <li>进入游戏设置，你终于可以在拥有 DLSS 的同时勾选帧生成框</li>
            <li>按 <code>Insert</code> 键打开 OptiScaler，在 Upscaler 选项选择 DLSS。UI 底部可以查看 FPS</li>
        </ol>

        <h2>支持的 GPU 型号</h2>
        <ul>
            <li><strong>NVIDIA GeForce 20xx/30xx</strong>（完全支持）</li>
            <li><strong>NVIDIA GeForce 10xx/16xx</strong>（支持良好）</li>
            <li><strong>NVIDIA GeForce 9xx</strong>（支持良好）</li>
            <li><strong>NVIDIA GeForce 8xx</strong>（实验版）</li>
            <li><strong>Intel ARC</strong>（支持良好）</li>
            <li><strong>AMD RDNA3</strong>（完全支持）</li>
            <li><strong>AMD RDNA2</strong>（支持良好）</li>
            <li><strong>老款 GPU</strong>（良好/有限支持）</li>
        </ul>

        <h2>Tips</h2>
        <p>DLSS-Enabler 也适用于 <strong>AMD/Intel GPU</strong>，可以让更多显卡体验帧生成的好处。</p>
    </main>
    <footer>
        &copy; 2025 {$appName} · 技术随笔
    </footer>
    <script>
        // 客户端需要的配置
        window.settings = {
            "app_url": "{$appUrl}",
            "api_url": "{$apiUrl}",
            "app_name": "{$appName}"
        };
    </script>
</body>
</html>
HTML;

    return response($html, 200)->header('Content-Type', 'text/html');
});

//TODO:: 兼容
Route::get('/' . config('v2board.secure_path', config('v2board.frontend_admin_path', hash('crc32b', config('app.key')))), function () {
    return view('admin', [
        'title' => config('v2board.app_name', 'V2Board'),
        'theme_sidebar' => config('v2board.frontend_theme_sidebar', 'light'),
        'theme_header' => config('v2board.frontend_theme_header', 'dark'),
        'theme_color' => config('v2board.frontend_theme_color', 'default'),
        'background_url' => config('v2board.frontend_background_url'),
        'version' => config('app.version'),
        'logo' => config('v2board.logo'),
        'secure_path' => config('v2board.secure_path', config('v2board.frontend_admin_path', hash('crc32b', config('app.key'))))
    ]);
});

if (!empty(config('v2board.subscribe_path'))) {
    Route::get(config('v2board.subscribe_path'), 'V1\\Client\\ClientController@subscribe')->middleware('client');
}
