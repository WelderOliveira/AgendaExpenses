<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contatos = Contato::all();
        return view('contato.index',['contatos'=>$contatos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contato.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->nome);
        $contato = new Contato;
//        echo '<pre>'; var_dump($request); die;
        $contato->nome = $request->nome;
        $contato->email = $request->email;
        $contato->data_nascimento = $request->data_nascimento;
        $contato->anotacao = $request->anotacoes;

        if ($request->hasFile('image') and $request->file('image')->isValid()){

            $requestImage = $request->avatar;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . rand(100000, 999999)).".".$extension;

            $requestImage->move(public_path('img/contatos'),$imageName);

            $contato->avatar = $imageName;

        }

        $contato->save();

        return redirect('/')->with('msg','Contato Cadastrado com Sucesso');
//        $user = auth()->user();
//        $telefone->contato_id = $user->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contato = Contato::findOrFail($id);
        return view('contato.show',['contato' => $contato]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
