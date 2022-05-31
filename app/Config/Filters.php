<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'filterAdmin' => \App\Filters\FilterAdmin::class,
        'filterPegawai' => \App\Filters\FilterPegawai::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'honeypot',
            'filterAdmin' => [
                'except' => ['Auth', 'Auth/login']
            ],
            'filterPegawai' => [
                'except' => ['Auth', 'Auth/login']
            ],
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            'honeypot',
            // 'filterAdmin' => [
            //     'except' => ['/', 'Web/search', 'Web/send_mail', 'Web/produk', 'Web/produk/*', 'Web/tentang', 'Web/contact', 'Web/contact/*', 'login/*', 'register/*', 'forgot', 'forgot/*', 'activate-account', 'activate-account/*', 'resend-activate-account', 'resend-activate-account*', 'reset-password', 'reset-password/*']
            // ],
            // 'filterPegawai' => [
            //     'except' => ['/', 'Web/search', 'Web/send_mail', 'Web/produk', 'Web/produk/*', 'Web/tentang', 'Web/contact', 'Web/contact/*', 'login/*', 'register/*', 'forgot', 'forgot/*', 'activate-account', 'activate-account/*', 'resend-activate-account', 'resend-activate-account*', 'reset-password', 'reset-password/*']
            // ],
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
