<?php
require_once('controller.php');
class Model
{
    private $dbname = "phones";
    private $host = "127.0.0.1";
    private $user = "root";
    private $password = "";


    private function connect($dbname, $host, $user, $password)
    {
        $dsn = "mysql:dbname=$dbname;host=$host";
        try {
            $c = new PDO($dsn, $user, $password);
        } catch (PDOException $ex) {
            printf("erreur de connexion à la bdd ", $ex->getMessage());
            exit();
        }
        return $c;
    }


    private function disconnect(&$c)
    {
        $c = null;
    }

    private function request($pdo, $r)
    {
        $c = $pdo->prepare($r);
        $c->execute();
        return $s = $c->fetchAll(PDO::FETCH_ASSOC);
    }


    public function model_get_table()
    {
        $c = $this->connect($this->dbname, $this->host, $this->user, $this->password);
        $requete = "SELECT
        f.Name_Features AS Feature,
        s.Name_smartphone AS Smartphone,
        sf.Value_Smartphone_Features AS FeatureValue
    FROM
        features f
    LEFT JOIN
        smartphone_features sf ON f.Id_Features = sf.Id_Features
    LEFT JOIN
        smartphone s ON sf.Id_Smartphone = s.Id_smartphone";
        $r = $this->request($c, $requete);
        $this->disconnect($c);
        return $r;
    }
}
