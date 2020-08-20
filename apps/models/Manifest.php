<?php 

class Manifest {
    private $table = 'manifest'
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getManifestSerah()
    {
        $tableSerah = 'man_serah';
        
    }
}