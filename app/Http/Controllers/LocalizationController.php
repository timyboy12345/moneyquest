<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;
class LocalizationController extends Controller
{
    public function index($locale)
    {
        setcookie('lang', $locale, time() + 60 * 60 * 24 * 30, '/');
        return redirect()->back();
    }
}