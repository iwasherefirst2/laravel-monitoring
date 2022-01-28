<?php

namespace App\Http\Controllers;

use App\Models\ServerLogs;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function view()
    {
        $logs = ServerLogs::all();

        $online = (ServerLogs::where('available', '=', true)->count() / (ServerLogs::count() ?: 1) ) * 100;
        $averageTime = ServerLogs::where('available', '=', true)->avg('duration_request');

        return view('welcome', compact('online', 'averageTime', 'logs'));
    }
}
