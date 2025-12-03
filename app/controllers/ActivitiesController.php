<?php
class ActivitiesController
{
use Render;

public function index()
{
    if (!isset($_SESSION['user'])) {
        header('Location: /user/login');
        exit;
    }

    $this->renderView('activities/index', [
        'title' => 'Accueil'
    ]);
}
}