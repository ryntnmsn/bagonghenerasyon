<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function index(Request $request) {
        
        $subscriptions = Subscription::when($request->search, function($query) use ($request)  {
            $query->where('email', 'like', '%' . $request->search . '%');
        })->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return Inertia::render('Admin/Subscriptions/Subscriptions', [
            'subscriptions' => $subscriptions
        ]);
    }
}
