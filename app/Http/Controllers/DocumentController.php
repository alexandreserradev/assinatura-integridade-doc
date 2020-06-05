<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function index()
    {
        return view('document.index')->with('documents', Document::all());
    }

    public function create()
    {
        return view('document.create');
    }

    public function store(Request $request)
    {
        $doc = new Document();
        $doc->fill($request->all());
        $doc->save();
        return redirect()->route('documents.index')->with('message', 'Documento salvo com sucesso!');
    }

    public function edit($id)
    {
        $doc = Document::find($id);

        return view('document.edit')->with('document', $doc);
    }

    public function update(Request $request, $id)
    {
        $doc = Document::find($id);
        $doc->fill($request->all());
        $doc->save();

        return redirect()->route('documents.index')->with('message', 'Documento editado com sucesso!');
    }

    public function validarDocumento($id)
    {
        $document = Document::find($id);
        $doc_string = $document->toJson();
        $doc_validade = Str::is(decrypt($document->hash), hash('md5', $doc_string));

        if ($doc_validade) {
            dd('Esse documento é válido');
        } else {
            dd('Esse documento é inválido, pois sofreu alterações após a assinatura');
        }
    }
}
