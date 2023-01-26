<?php
/**
 * File Acl.php
 *
 * @author Tuan Duong <bacduong@gmail.com>
 * @package Laravue
 * @version 1.0
 */
namespace App\Laravue;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class Acl
 *
 * @package App\Laravue
 */
final class Acl
{
    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER = 'manager';


    const PERMISSION_MANAGE_CHECK_SYSTEMS = 'manage check systems';

    const PERMISSION_MANAGE_CHECK_UNIQUES = 'manage check uniques';
    const PERMISSION_MANAGE_SERVICES = 'manage services';
    const PERMISSION_MANAGE_REWRITES = 'manage rewrites';
    const PERMISSION_MANAGE_MODERATORS = 'manage moderators';
    const PERMISSION_MANAGE_PROMO_CODES = 'manage promo codes';
    const PERMISSION_MANAGE_CONTACT_ORDERS = 'manage contact orders';
    const PERMISSION_MANAGE_MAIN_PAGE = 'manage main page';
    const PERMISSION_MANAGE_PRICES_PAGE = 'manage prices page';
    const PERMISSION_MANAGE_FAQ_PAGE = 'manage faq page';
    const PERMISSION_MANAGE_REVIEWS_PAGE = 'manage reviews page';
    const PERMISSION_MANAGE_ABOUT_PAGE = 'manage about page';
    const PERMISSION_MANAGE_STATIC_PAGES = 'manage static pages';
    const PERMISSION_MANAGE_ARTICLES = 'manage articles';
    const PERMISSION_MANAGE_SETTINGS = 'manage settings';
    const PERMISSION_PERMISSION_MANAGE = 'manage permission';

    /**
     * @param array $exclusives Exclude some permissions from the list
     * @return array
     */
    public static function permissions(array $exclusives = []): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function($value, $key) use ($exclusives) {
                return !in_array($value, $exclusives) && Str::startsWith($key, 'PERMISSION_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    public static function menuPermissions(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function($value, $key) {
                return Str::startsWith($key, 'PERMISSION_VIEW_MENU_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    /**
     * @return array
     */
    public static function roles(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $roles =  Arr::where($constants, function($value, $key) {
                return Str::startsWith($key, 'ROLE_');
            });

            return array_values($roles);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }
}
