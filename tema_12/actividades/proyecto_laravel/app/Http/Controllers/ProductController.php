<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return "Listado de productos";
    }

    public function create()
    {
        return "Formulario para crear un producto";
    }

    public function store(Request $request)
    {
        return "Guardar producto en la base de datos";
    }

    public function show($id)
    {
        return "Mostrando producto con ID: $id";
    }

    public function edit($id)
    {
        return "Formulario para editar el producto con ID: $id";
    }

    public function update(Request $request, $id)
    {
        return "Actualizar producto con ID: $id";
    }

    public function destroy($id)
    {
        return "Eliminar producto con ID: $id";
    }
}
