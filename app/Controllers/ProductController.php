<?php

namespace App\Controllers;

use App\Facades\Hash;
use App\Facades\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Response::json([
            // "aliahmadi" => Hash::hash("aliahmadi")
            "verify" => Hash::verify("aliahmadi", '$2y$10$m8anuztPePdqZS.jJVO9OK3KpNaYyUokGROmWFcStz4y4OnQKFGm')
        ]);
    }

    public function show()
    {
    }

    public function store()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
