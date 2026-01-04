<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function index() {
        $subscriptions = Subscription::all();
        return Inertia::render('Admin/Subscriptions/Subscriptions', [
            'subscriptions' => $subscriptions
        ]);
    }
}
