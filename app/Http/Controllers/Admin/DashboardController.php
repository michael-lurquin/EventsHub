<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $cards = [
            [
                'title' => 'Total Pages',
                'link' => '#',
                'value' => numberFormatLocaleValue(71897, 0),
                'format' => null,
                'variation' => [
                    'type' => 'increased',
                    'value' => numberFormatLocaleValue(122, 0),
                    'format' => null,
                ],
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />',
                'color' => 'teal',
            ],
            [
                'title' => 'Total Multi-Pages',
                'link' => '#',
                'value' => numberFormatLocaleValue(58.16),
                'format' => '%',
                'variation' => [
                    'type' => 'increased',
                    'value' => numberFormatLocaleValue(5.4),
                    'format' => '%',
                ],
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />',
                'color' => 'purple',
            ],
            [
                'title' => 'Total Tenants',
                'link' => '#',
                'value' => numberFormatLocaleValue(24.57),
                'format' => '%',
                'variation' => [
                    'type' => 'decreased',
                    'value' => numberFormatLocaleValue(3.2),
                    'format' => '%',
                ],
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />',
                'color' => 'sky',
            ],
            [
                'title' => 'Total Attendees',
                'link' => '#',
                'value' => numberFormatLocaleValue(24.57),
                'format' => '%',
                'variation' => [
                    'type' => 'decreased',
                    'value' => numberFormatLocaleValue(3.2),
                    'format' => '%',
                ],
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />',
                'color' => 'yellow',
            ],
        ];

        return view('admin.dashboard', compact('cards'));
    }

    public function bulkAction(string $for, Request $request)
    {
        dd($for, $request->all());
    }
}
