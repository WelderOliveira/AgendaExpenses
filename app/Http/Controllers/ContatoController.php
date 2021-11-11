<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Telefone;
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
//        dd($request);
        $validator = $request->validate([
            'nome'=>'required|max:100',
            'email'=>'email|max:200|unique:contatos',
            'telefones' => 'required',
            'avatar' => 'nullable|sometimes|image|mimes:jpg,jpeg,png,gif'

        ]);

        $contato = new Contato;
//        echo '<pre>'; var_dump($request); die;
        $contato->nome = $request->nome;
        $contato->email = $request->email;
        $contato->data_nascimento = $request->dt_nascimento;
        $contato->anotacao = $request->anotacoes;

//        dd($request->avatar);

        if ($request->hasFile('avatar') and $request->file('avatar')->isValid()){

            $requestImage = $request->avatar;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . rand(100000, 999999)).".".$extension;

            $requestImage->move(public_path('img/contatos'),$imageName);

            $contato->avatar = $imageName;

        }

        $contato->save();
        $userCadastrado = $contato->id;

        $this->saveEndereco($request,$userCadastrado);
        $this->saveTelefone($request,$userCadastrado);

//        return redirect('/')->with('msg','Contato Cadastrado com Sucesso');

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

    /**
     * @param $dados
     */
    public function saveEndereco($dados, $usuario)
    {
        $dadosEndereco = new Endereco;

        $dadosEndereco->cep = $dados->cep;
        $dadosEndereco->bairro = $dados->bairro;
        $dadosEndereco->logradouro = $dados->logradouro;
        $dadosEndereco->uf = $dados->uf;
        $dadosEndereco->localidade = $dados->localidade;
        $dadosEndereco->complemento = $dados->complemento;
        $dadosEndereco->contato_id = $usuario;


//        echo '<pre>'; var_dump($dadosEndereco); die;

        $dadosEndereco->save();
    }


    /**
     * @param $dados
     * @param int $usuario
     */
    public function saveTelefone($dados, $usuario)
    {
        $dadosTelefone = new Telefone;
        $numerosTelefone = json_decode($dados->telefones,true);
            foreach ($numerosTelefone as $telefone){
                $dadosTelefone->numero = $telefone["Tel"];
                $dadosTelefone->contato_id = $usuario;
                $dadosTelefone->save();
            }
//            dd($dados->telefones);
    }

}
