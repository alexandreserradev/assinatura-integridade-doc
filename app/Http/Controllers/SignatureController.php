<?php

namespace App\Http\Controllers;

use App\Document;
use App\Signature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SignatureController extends Controller
{
    public function index()
    {
        return view('signature.index');
    }

    public function store(Request $request)
    {
        $signature = new Signature();
        $signature->fill($request->all());
        $signature->hash = Crypt::encryptString($request->user_id . $request->document_id);
        $signature->save();

        $document = Document::find($request->document_id);
        $doc_string = $document->toJson();
        $document->hash = encrypt(hash('md5', $doc_string));
        $document->save();

        return back()->with('message', 'Documento assinado com sucesso');
    }
}
