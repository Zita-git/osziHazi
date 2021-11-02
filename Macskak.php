<?php

class Macskak{
    private $id;
    private $nev;
    private $szuletesi_nap;
    private $suly;
    private $nem;
    private $kinezet;

    
    public function __construct(string $nev, DateTime $szuletesi_nap, float $suly, string $nem, string $kinezet){
        $this->nev = $nev;
        $this->szuletesi_nap = $szuletesi_nap;
        $this->suly = $suly;
        $this->nem = $nem;
        $this->kinezet = $kinezet;
    }
        
    public function uj() {
        global $db;

        $db->prepare('INSERT INTO macska (nev, szuletesi_nap, suly, nem, kinezet)
                    VALUES (:nev, :szuletesi_nap, :suly, :nem, :kinezet)')
            ->execute([
                ':nev' => $this->nev,
                ':szuletesi_nap' => $this->szuletesi_nap->format('Y-m-d'),
                ':suly' => $this->suly,
                ':nem' => $this->nem,
                ':kinezet' => $this->kinezet,
            ]);
    }
    
    public function getId() : ?int {
        return $this->id;
    }


    public function getNev() : string {
        return $this->nev;
    }
    public function setNev(string $nev) : void  {
        $this->nev = $nev;
    }
    
    public function getSzuletesi_nap() : DateTime {
        return $this->szuletesi_nap;
    }
    public function setSzuletesi_nap(DateTime $szuletesi_nap) : void {
        $this->szuletesi_nap = $szuletesi_nap;
    }

    public function getSuly() : int {
        return $this->suly;
    }
    public function setSuly(int $suly) : void  {
        $this->suly = $suly;
    }

    public function getNem() : string {
        return $this->nem;
    }
    public function setNem(string $nem) : void  {
        $this->nem = $nem;
    }

    public function getKinezet() : string {
        return $this->kinezet;
    }
    public function setKinezet(string $kinezet) : void  {
        $this->kinezet = $kinezet;
    }


    public static function torol(int $id) {
        global $db;

        $db->prepare('DELETE FROM macska WHERE id = :id')
            ->execute([':id' => $id]);
    }

    public static function osszes() : array {
        global $db;

        $m = $db->query("SELECT * FROM macska ORDER BY id ASC")
                ->fetchAll();
        $eredmeny = [];

        foreach ($m as $elem) {
            $macska = new Macskak($elem['nev'],
                    new DateTime($elem['szuletesi_nap']),
                             $elem['suly'],
                             $elem['nem'],
                             $elem['kinezet']);
            $macska->id = $elem['id'];
            $eredmeny[] = $macska;
        }

        return $eredmeny;
    }

    public static function getById(int $id) : Macskak {
        global $db;

        $stmt = $db->prepare('SELECT * FROM macska WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $eredmeny = $stmt->fetchAll();

        if (count($eredmeny) !== 1) {
            throw new Exception('Az adatbázis lekérdezésnek egy sort kell visszaadnia');
        }

        $macska = new Macskak(
            $eredmeny[0]['nev'],
            new DateTime($eredmeny[0]['szuletesi_nap']),
            $eredmeny[0]['suly'],
            $eredmeny[0]['nem'],
            $eredmeny[0]['kinezet']
        );
        $macska->id = $eredmeny[0]['id'];
        return $macska;
    }

    public function mentes() {
        global $db;

        $db->prepare('UPDATE macska SET nev = :nev, szuletesi_nap = :szuletesi_nap, suly = :suly, nem = :nem, kinezet = :kinezet
            WHERE id = :id')
            ->execute([
                ':id' => $this->id,
                ':nev' => $this->nev,
                ':szuletesi_nap' => $this->szuletesi_nap->format('Y-m-d'),
                ':suly' => $this->suly,
                ':nem' => $this->nem,
                ':kinezet' => $this->kinezet,
            ]);
    }
}