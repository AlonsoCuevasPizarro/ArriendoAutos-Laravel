<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $authenticated_user = Auth::user();
        // dd($categories); // El dd es su mejor alternativa para depurar el código
        $categories = Category::with('vehicles')->orderBy('id', 'desc')->get();
        $clientes = Client::all();
        $vehicles = Vehicle::all();
        return View('admin.home')->with([
            'user' => $authenticated_user,
            'categories' => $categories,
            'clientes' => $clientes,
            'vehicles' => $vehicles,
        ]);
    }

    public function showDashboard()
    {
        $authenticated_user = Auth::user();
        $categories = Category::with('vehicles')->orderBy('id', 'desc')->get();
        $conteoPorCategoria = Category::withCount('vehicles')->get();
        $contador = Client::count();
        $clientes = Client::all();
        $vehicles = Vehicle::all();
        return View('admin.Dashboard')->with([
            'user' => $authenticated_user,
            'categories' => $categories,
            'clientes' => $clientes,
            'vehicles' => $vehicles,
            'conteoPorCategoria' => $conteoPorCategoria,
            'contador' => $contador,
        ]);
    }
}
