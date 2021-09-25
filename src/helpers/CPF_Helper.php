<?php 

namespace Src\helpers;

Trait CPF_Helper
{
    public function removeFormatacaoCPF($cpf)
    {
        return $cpf = str_replace([".","-"], "", $cpf);
    }

    public function devolveFormatacaoCPF($cpf)
    {
        $formatado = "";
        
        $formatado = substr($cpf, 0, 3) . "."; 
        $formatado .= substr($cpf, 3, 3) . "."; 
        $formatado .= substr($cpf, 6, 3) . "-"; 
        $formatado .= substr($cpf, 9, 2); 
        
        return $formatado;
    }

    public function validaCPF($cpf) 
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        if (strlen($cpf) != 11) return false;
    
        if (preg_match('/(\d)\1{10}/', $cpf)) return false;
    
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }  
        return true;
    }
}