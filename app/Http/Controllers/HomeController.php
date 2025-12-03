<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'مرحباً بك في موقعنا — تعلم Laravel MVC!';
        return view('home', compact('title'));
    }

    public function about()
    {
        $info = 'هذه صفحة "عنّا" قصيرة تشرح هدف الموقع: بناء تطبيقات ويب باستخدام إطار Laravel وتطبيق نمط MVC.';
        return view('about', compact('info'));
    }

    public function features()
    {
        // مصفوفة مفهرسة (indexed array) من ميزات Laravel
        $features = [
            'Routing بسيط ومرن',
            'Eloquent ORM لإدارة قواعد البيانات',
            'Blade template engine خفيف وسهل',
            'Middleware لحماية الصفحات',
            'Commands وTasks باستخدام Artisan'
        ];

        return view('features', compact('features'));
    }

    public function team()
    {
        // مصفوفة ترابطية (associative array) من أعضاء الفريق
        $team = [

          ['name' => 'amir hamd', 'role' => 'Project Manager'],
            ['name' => 'muhamad khalid', 'role' => 'Backend Developer'],
            ['name' => 'Ahmed Issa', 'role' => 'Frontend Developer'],
            ['name' => 'Said Ibrahim', 'role' => 'UI/UX Designer'], 
        ];

        return view('team', compact('team'));
    }
}
