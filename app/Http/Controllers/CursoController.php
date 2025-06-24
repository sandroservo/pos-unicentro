<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::paginate(5); // Paginação
        return view('cursos.index', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:Graduação,Pós-Graduação,Mestrado,Doutorado',
        ]);

        Curso::create($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso criado com sucesso!');
    }

    public function edit(Curso $curso)
    {
        $cursos = Curso::paginate(5); // Listagem com paginação
        return view('cursos.index', compact('curso', 'cursos'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:Graduação,Pós-Graduação,Mestrado,Doutorado',
        ]);

        $curso->update($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return redirect()->route('cursos.index')->with('success', 'Curso excluído com sucesso!');
    }
}
