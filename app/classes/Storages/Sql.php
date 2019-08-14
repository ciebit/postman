<?php
namespace Ciebit\Postman\Storages;

use Ciebit\Postman\Addressee\Builder;
use Ciebit\Postman\Message;
use Ciebit\Postman\Package\Collection;
use Ciebit\Postman\Package\Package;
use Ciebit\Postman\Package\Status;
use Ciebit\Postman\Storages\Storage;
use PDO;

use function json_encode;

class Sql implements Storage
{
    /** @var string */
    private const COLUMN_DATE_TIME = 'date_time';

    /** @var string */
    private const COLUMN_ID = 'id';

    /** @var string */
    private const COLUMN_MESSAGE = 'message';

    /** @var string */
    private const COLUMN_STATUS = 'status';

    /** @var string */
    private const COLUMN_TECHNOLOGY = 'tecnology';

    /** @var PDO */
    private $pdo;
    
    /** @var string */
    private $table;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function find(): Collection
    {
        $fieldDateTime = self::COLUMN_DATE_TIME;
        $fieldMessage = self::COLUMN_MESSAGE;
        $fieldId = self::COLUMN_ID;
        $fieldStatus = self::COLUMN_STATUS;
        $fieldTechnology = self::COLUMN_TECHNOLOGY;

        $statment = $this->pdo->prepare(
            "SELECT (
                `{$fieldId}`, `{$fieldMessage}`, 
                `{$fieldStatus}`, `{$fieldTechnology}`, 
                `{$fieldDateTime}`
            )
            FROM `{$this->table}`
            WHERE `{$fieldStatus}` = {Status::PENDING}
            ORDER BY `{$fieldDateTime}` ASC
            LIMIT 10"
        );

        if (! $statment->execute()) {

        }

        $collection = new Collection;

        while($data = $statment->fetch(PDO::FETCH_OBJ)) {
            $collection->add(
                new Package(
                    new Message($data->$fieldMessage),
                    new Status($data->$fieldStatus),
                    Builder::build(json_decode($data->$fieldTechnology, true)),
                    $data->$fieldId
                )
            );
        }

        return $collection;
    }

    public function store(Package $message): Package
    {
        $fieldMessage = self::COLUMN_MESSAGE;
        $fieldStatus = self::COLUMN_STATUS;
        $fieldTechnology = self::COLUMN_TECHNOLOGY;

        $statment = $this->pdo->prepare(
            "INSERT INTO {$this->table}
            (`{$fieldMessage}`, `{$fieldStatus}`, `{$fieldTechnology}`)
            VALUES
            (:message, :status, :tecnology)"
        );

        $statment->bindValue(':message', $message->getMessage(), PDO::PARAM_STR);
        $statment->bindValue(':status', $message->getStatus()->getValue(), PDO::PARAM_INT);
        $statment->bindValue(':tecnology', json_encode($message->getTecnology()), PDO::PARAM_STR);

        if (! $statment->execute()) {

        }

        $id = $this->pdo->lastInsertId();

        return new Package(
            $message->getMessage(),
            $message->getStatus(),
            $message->getTecnology(),
            $id
        );
    }

    public function setTable(string $name): self
    {
        $this->table = $name;
        return $this;
    }
}
