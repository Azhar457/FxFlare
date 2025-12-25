<?php

namespace App\Services;

class FlashNotification
{
    public static function success(string $message, string $title = 'Success')
    {
        self::flash('success', $title, $message);
    }

    public static function error(string $message, string $title = 'Error')
    {
        self::flash('error', $title, $message);
    }

    public static function warning(string $message, string $title = 'Warning')
    {
        self::flash('warning', $title, $message);
    }

    public static function info(string $message, string $title = 'Info')
    {
        self::flash('info', $title, $message);
    }

    private static function flash(string $type, string $title, string $message)
    {
        session()->flash('notification', [
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'id' => uniqid('notify_'), // Unique ID for managing multiple if needed (future proof)
        ]);
    }
}
