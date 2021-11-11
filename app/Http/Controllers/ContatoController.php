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
        $search = request('search');

        if ($search){
            $contatos = Contato::where([
                ['nome','like','%'.$search.'%']
            ])->get();
        }else{
            $contatos = Contato::all()->sortBy('nome');
        }

        return view('agenda.index', ['contatos' => $contatos,'search'=>$search]);
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Contato::where([
            ['nome','like','%'.$query.'%']
        ])->get();
        return response()->json($filterResult);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'nome' => 'required|max:100',
            'email' => 'email|max:200|unique:contatos',
            'telefones' => 'required',
            'cep'=>'required',
            'avatar' => 'nullable|sometimes|image|mimes:jpg,jpeg,png,gif'

        ]);

        $userCadastrado = $this->saveContato($request);
        $this->saveEndereco($request, $userCadastrado);
        $this->saveTelefone($request, $userCadastrado);

//        return redirect('/')->with('msg','Contato Cadastrado com Sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dadosContato = Contato::findOrFail($id);
        $foneContato = Telefone::where('contato_id', $dadosContato->id)->get()->toArray();
        $enderecoContato = Endereco::where('contato_id', $dadosContato->id)->first()->toArray();
        return view('agenda.show', ['contato' => $dadosContato, 'fones' => $foneContato, 'endereco' => $enderecoContato]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contato = Contato::FindOrFail($id);
        $foneContato = Telefone::where('contato_id', $id)->get()->toArray();
        $enderecoContato = Endereco::where('contato_id', $id)->first()->toArray();
        return view('agenda.edit', ['contato' => $contato, 'fones' => $foneContato, 'endereco' => $enderecoContato]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->updateContato($request,$id);
        Telefone::where('contato_id', $id)->update($request->all());
        Endereco::where('contato_id', $id)->update($request->all());
//        return redirect('/agenda')->with('msg', 'Contato Excluido Com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contato::findOrFail($id)->delete();
        Telefone::where('contato_id', $id)->delete();
        Endereco::where('contato_id', $id)->delete();
        return redirect('/')->with('msg', 'Contato Excluido Com Sucesso');
    }

    public function updateContato($dados,$id)
    {
        $contato = Contato::findOrFail($id);

        $contato = $this->dadosContatos($dados, $contato);

        $contato->update();
//        return $agenda->id;
    }

    public function saveContato($dados)
    {
        $contato = new Contato;

        $contato = $this->dadosContatos($dados, $contato);

        $contato->save();
        return $contato->id;
    }

    /**
     * @param $dados
     * @param $usuario
     */
    public function saveEndereco($dados, $usuario)
    {
        $dadosEndereco = new Endereco;

        $dadosEndereco = $this->dadosEndereco($dados, $dadosEndereco, $usuario);

        $dadosEndereco->save();
    }

    /**
     * @param $dados
     * @param int $usuario
     */
    public function saveTelefone($dados, $usuario)
    {
        $dadosTelefone = new Telefone;
        $numerosTelefone = json_decode($dados->telefones, true);
        foreach ($numerosTelefone as $telefone) {
            $dadosTelefone->numero = $telefone["Tel"];
            $dadosTelefone->contato_id = $usuario;
            $dadosTelefone->save();
        }
//            dd($dados->telefones);
    }

    /**
     * @param $dados
     * @param Contato $contato
     * @return Contato
     */
    public function dadosContatos($dados, Contato $contato): Contato
    {
        $contato->nome = $dados->nome;
        $contato->email = $dados->email;
        $contato->data_nascimento = $dados->dt_nascimento;
        $contato->anotacao = $dados->anotacoes;

        if ($dados->hasFile('avatar') and $dados->file('avatar')->isValid()) {

            $requestImage = $dados->avatar;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . rand(100000, 999999)) . "." . $extension;

            $requestImage->move(public_path('img/contatos'), $imageName);

            $contato->avatar = $imageName;

        }
        return $contato;
    }

    /**
     * @param $dados
     * @param Endereco $Endereco
     * @param $usuario
     * @return Endereco
     */
    public function dadosEndereco($dados, Endereco $Endereco, $usuario): Endereco
    {
        $Endereco->cep = $dados->cep;
        $Endereco->bairro = $dados->bairro;
        $Endereco->logradouro = $dados->logradouro;
        $Endereco->uf = $dados->uf;
        $Endereco->localidade = $dados->localidade;
        $Endereco->complemento = $dados->complemento;
        $Endereco->contato_id = $usuario;

        return $Endereco;
    }


}
