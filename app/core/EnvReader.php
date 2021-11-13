<?php
//---------------------------------------------
//
// CLASSE QUE REALIZA A LEITURA DO ARQUIVO .env
//
//---------------------------------------------

namespace Afterimage\Core;

class EnvReader
{
    // diretório onde está o arquivo .env
    const ENV_PATH = __DIR__ . '/../config/.env';

    public function __construct()
    {
        if(!file_exists(self::ENV_PATH)){
            throw new \InvalidArgumentException(sprintf('o arquivo %s não existe', self::ENV_PATH));
        }
        $this->path = self::ENV_PATH;
    }

    // função que carrega os atributos para a superglobal $_ENV
    public function load():void
    {
        // verifica se arquivo é legível
        if(!is_readable($this->path)) {
            throw new \RuntimeException(sprintf('o arquivo %s não é legível', $this->path));
        }

        // captura as linhas do arquivo .env
        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach($lines as $line) {

            if(strpos(trim($line), '#') === 0) {
                continue;
            }
    
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            
            // caso as chaves não estejam registradas $_ENV irão ser carregadas
            if(!array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
            }
        }
    }
}