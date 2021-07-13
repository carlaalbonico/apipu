<?php
class AccesoDatos{
    private static $objAccesoDatos;
    private $objetoPDO;

    private function __construct()
    {
        try {
            $this->objetoPDO = new PDO('mysql:host=bklatxdpktyqy8vxwsxv-mysql.services.clever-cloud.com:3306;dbname=bklatxdpktyqy8vxwsxv;charset=utf8', 'ufnyskzelrhfnpni','4m7fe2fbyAm9YQSsp20H',array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            //$this->objetoPDO = new PDO('mysql:host=ec2-3-226-134-153:5432.compute-1.amazonaws.com;dbname=d8hcuvmh42iuj1;charset=utf8', 'tjzmuskgxawugl','4a90684fb6c0d551a28b5f67c578bbe4079064d3899401251a8f25c5abf7cf8b',array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        //$this->objetoPDO = new PDO('mysql:host='.getenv('ServidorMySQL').';dbname='.getenv('Database').';charset=utf8', getenv("Usuario"), getenv('Pass'), array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        //$this->objetoPDO->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            die();
        }
    }

    public static function obtenerInstancia(){
        if (!isset(self::$objAccesoDatos)) {
            self::$objAccesoDatos = new AccesoDatos();
        }
        return self::$objAccesoDatos;
    }

    public function prepararConsulta($consultaSQL)
    {
        return $this->objetoPDO->prepare($consultaSQL);
    }

    

    public function __clone()
    {
        trigger_error('ERROR: La clonación de este objeto no está permitida', E_USER_ERROR);
    }
}    
?>
