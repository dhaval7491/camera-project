<?php

use App\Enums\UserRequestStatus;
use App\Models\Country;
use App\Models\Role;
use App\Models\State;
use App\Models\User;
use App\Models\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (! function_exists('displayDateFormat')) {
    function displayDateFormat($date)
    {
        return Carbon::parse($date)->format('F d, Y');
    }
}
if (! function_exists('displayDateTimeFormat')) {
    function displayDateTimeFormat($date)
    {
        return Carbon::parse($date)->format('F d, Y h:i A');
    }
}

if (! function_exists('displayTimeFormat')) {
    function displayTimeFormat($date)
    {
        return Carbon::parse($date)->format('h:i A');
    }
}

if (! function_exists('getInitials')) {
    function getInitials($name)
    {
        $words = explode(' ', trim($name));
        $initials = '';

        if (count($words) >= 2) {
            $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        } elseif (count($words) === 1) {
            $initials = strtoupper(substr($words[0], 0, 2));
        }

        return $initials;
    }
}
