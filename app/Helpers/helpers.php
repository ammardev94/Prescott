<?php

if (! function_exists('dashboard_url')) {
    function dashboard_url()
    {
        if (auth()->guard('admin')->check()) {
            return route('admin.dashboard');
        }

        return url('/');
    }
}
