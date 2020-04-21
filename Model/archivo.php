<?php
class archivo
{
	private $pdo;
    public $id;
    public $nombre;
    public $extension;
    public $tipo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::Conectar();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM b2b_archivo ba
                INNER JOIN b2b_tipo_archivo bta ON ba.Id = bta.idarchivo ");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
    public function ListarR2()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT
                bta.extension as name,
                count( * ) AS cantidad 
            FROM
                b2b_archivo ba
                INNER JOIN b2b_tipo_archivo bta ON ba.Id = bta.idarchivo 
            GROUP BY
                bta.tipo"
            );
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
    public function exist_archivo($id)
    {
        $sql = "select count(*) from b2b_archivo where Id='$id'";
        $result = $this->pdo->prepare($sql);
        $result->execute();

        return (int)$result->fetchColumn() ;
    }

    public function test()
    {
        $sql = "select count(*) from b2b_archivo where Id=1242";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        echo  $result->fetchColumn();
    }

	public function insertarArchivoTipo($id,$extension,$tipo)
	{
    $sql = "INSERT INTO b2b_tipo_archivo(idarchivo,extension,tipo) VALUES (?,?,?)";

    $this->pdo->prepare($sql)
         ->execute(
            array(
                $id,
                $extension,
                $tipo
            )
        );

	}

	public function insertarArchivo($id,$nombre)
	{

        if($this->exist_archivo($id)===0)
        {

            $sql = "INSERT INTO b2b_archivo (Id,Nombre) VALUES (?, ?)";
            $res = $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $id,
                        $nombre
                    )
                );

            $nombrespri = explode('.', $nombre);

            if(isset($nombrespri[1]))
            {
                $extension  = $nombrespri[1] == 'pdf' ? 'pdf' : 'xml';
                $tipo       = $nombrespri[1] == 'pdf' ? 1 : 2;
                return $this->insertarArchivoTipo($id,$extension,$tipo);
            }

        }

	}
}
