<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();
            
        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        if (!$service->is_active) {
            abort(404);
        }
        
        // Get related services (same category, excluding current service)
        $relatedServices = Service::where('category', $service->category)
            ->where('id', '!=', $service->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        
        return view('services.show', compact('service', 'relatedServices'));
    }
}