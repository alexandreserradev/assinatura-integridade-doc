<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class Signature extends Model
{
    protected $guarded = ['hash'];

    public function getUser()
    {
        return User::find($this->user_id);
    }

    public function validateSignature(): bool
    {
        $signatures = Signature::where('hash', $this->hash)->get();

        if ($signatures->count() > 1) {
            return false;
        }

        if(!$this->validateHash()) {
            return false;
        }

        return true;
    }

    private function validateHash(): bool
    {
        try {
            $rule = $this->user_id . $this->document_id;
            $decriptedHash = Crypt::decryptString($this->hash);

            if (Str::is($rule, $decriptedHash)) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
        
    }
}
