<?php
    /**
     * Contém a classe CSV, responsável pelas funções de conversão de dados de arrays para CSV 
     * para que sejam exportados.
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     */
    /**
     * Classe responsável pelas funções de conversão de dados em array para arquivo CSV.
     * @package system
     * @subpackage tools
     */
    class CSV{
        /**
         * @var string Nome do arquivo exportado
         */
        private $fileName;
        /**
         * @var int Quantidade de memória máxima disponível para armazenar o arquivo temporário
         */
        private $memory;
        /**
         * @var string Charset a ser utilizado na codificação de caracteres do arquivo gerado.
         */
        private $charset;
        /**
         * @var string Define como o arquivo deve ser enviado
         */
        private $contentDisposition;
        /**
         * @var resource Buffer do arquivo temporário gerado
         */
        private $buffer;
        /**
         * @var array Matriz de valores que serão escritos no arquivo
         */
        private $output;
        
        /**
         * Constrói um arquivo CSV
         * @param string $filename Nome do arquivo
         * @param $string $charset Codificação de caracteres
         * @param int $memoryAmount Quantidade de memória disponível para criação do arquivo em MegaBytes
         * @param string $disposition Como o arquivo deve ser enviado pelo Output
         * @return void
         */
        public function __construct($filename, $charset, $memoryAmount = 2, $disposition = 'attachment'){
            $this->fileName = $filename;
            $this->charset = $charset;
            $this->memory = $memoryAmount * 1024 * 1024;
            $this->contentDisposition = $disposition;
            $this->open();
        }
        
        /**
         * Abre uma nova instãncia de um CSV temporário
         * @throws ErrorException
         */
        private function open(){
            try{
                $this->buffer = fopen("php://temp/maxmemory:".$this->memory, 'r+');
            }
            catch(ErrorException $e){
                $db = debug_backtrace();
                throw new ErrorException("Não foi possível abrir o arquivo.",$e->getCode(),0,$db[1]['file'],$db[1]['line']);
            }
        }
        
        /**
         * Adiciona uma nova linha ao Buffer
         * @return void
         */
        public function addRow($data){
            $this->output[] = $data;
        }
        
        /**
         * Escreve uma matriz completa de valores no Buffer. Apaga todo o conteúdo anterior, caso haja algum.
         * @return void
         */
        public function addAll($data){
            $this->output = $data;
        }
        
        /**
         * Prepara os cabeçalhos e o arquivo para ser enviado
         * @return void
         * @throws ErrorException
         */
        private function prepare(){
            header('Content-Type: text/csv; charset='.$this->charset);
            header('Content-Disposition: '.$this->contentDisposition.'; filename='.$this->fileName.'.csv');
            try{
                foreach ($this->output as $buffer) fputcsv($this->buffer, $buffer);
                rewind($this->buffer);
                $this->output = stream_get_contents($this->buffer);
            }
            catch(ErrorException $e){
                $db = debug_backtrace();
                throw new ErrorException("Não foi possível preparar o arquivo CSV para ser enviado.",$e->getCode(),0,$db[1]['file'],$db[1]['line']);
            }
        }
        
        /**
         * Gera o arquivo CSV
         * @return string
         */
        public function generate(){
            $this->prepare();
            return $this->output;
        }
    }