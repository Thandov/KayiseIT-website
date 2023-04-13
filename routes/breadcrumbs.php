<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail; 
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});
// Home > About
Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push('About', route('about'));
});
// Home > Services
Breadcrumbs::for('services', function ($trail) {
    $trail->parent('home');
    $trail->push('Services', route('services'));
});
// Home > About
Breadcrumbs::for('contact', function ($trail) {
    $trail->parent('home');
    $trail->push('Contact', route('contact'));
});