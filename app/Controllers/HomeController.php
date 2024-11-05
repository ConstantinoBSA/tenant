<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuario;

class HomeController extends Controller
{
    public function index()
    {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->read();

        $this->view('index');
    }

    public function teste()
    {
        $testando = 'TEstando passagem';

        $this->view('teste', [
            'testando' => $testando
        ]);
    }
}
