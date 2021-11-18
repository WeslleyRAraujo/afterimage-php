<?php
/**
 * Classe responsável pela leitura do arquivo /app/config/.env 
 *  
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace Afterimage\Core;

class EnvReader
{
    const ENV_PATH = __DIR__ . '/../config/.env';

    /**
     * checa se o arquivo .env existe
     * 
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        if(!file_exists(self::ENV_PATH)){
            throw new \InvalidArgumentException(sprintf('o arquivo %s não existe', self::ENV_PATH));
        }
        $this->path = self::ENV_PATH;
    }

    /**
     * Carrega os atributos para $_ENV
     * 
     * @throws RuntimeException
     * @return void
     */
    public function load()
    {
        if(!is_readable($this->path)) {
            throw new \RuntimeException(sprintf('o arquivo %s não é legível', $this->path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach($lines as $line) {
            if(strpos(trim($line), '#') === 0) {
                continue;
            }
    
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            
            if(!array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
            }
        }
    }
}