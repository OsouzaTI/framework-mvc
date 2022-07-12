<?

namespace Core\ORM;

use Core\Debug;
use MongoDB\Client;

class MongoDB {

    private $client;
    private $dbname;

    public function __construct(string $dbname) {
        $this->dbname = $dbname;
    }
    
    public function connetion($uri) {
        $this->client = new Client($uri);
        return $this;
    }

    public function insertOne(string $collection, $document = []) {
        $_collection = $this->client->{$this->dbname}->{$collection};
        $_collection->insertOne($document);
    }

    public function getAllDocuments(string $collection, $filter = [], $options = []) {
        $_collection = $this->client->{$this->dbname}->{$collection};        
        $results = $_collection->find($filter, $options);
        return $results;
    }

}