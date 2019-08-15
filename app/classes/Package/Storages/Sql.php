<?php
namespace Ciebit\Postman\Package\Storages;

use Ciebit\Postman\Addressee\Builder;
use Ciebit\Postman\Exception;
use Ciebit\Postman\Message;
use Ciebit\Postman\Package\Collection;
use Ciebit\Postman\Package\Package;
use Ciebit\Postman\Package\Status;
use Ciebit\Postman\Package\Storages\Storage;
use PDO;

use function json_encode;

class Sql implements Storage
{
    /** @var string */
    private const COLUMN_CLIENT_ID = 'client_id';

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
        $fieldClientId = self::COLUMN_CLIENT_ID;
        $fieldDateTime = self::COLUMN_DATE_TIME;
        $fieldMessage = self::COLUMN_MESSAGE;
        $fieldId = self::COLUMN_ID;
        $fieldStatus = self::COLUMN_STATUS;
        $fieldTechnology = self::COLUMN_TECHNOLOGY;

        $statment = $this->pdo->prepare(
            "SELECT (
                `{$fieldId}`, `{$fieldMessage}`, 
                `{$fieldStatus}`, `{$fieldTechnology}`, 
                `{$fieldClientId}`, `{$fieldDateTime}`
            )
            FROM `{$this->table}`
            WHERE `{$fieldStatus}` = {Status::PENDING}
            ORDER BY `{$fieldDateTime}` ASC
            LIMIT 10"
        );

        if (! $statment->execute()) {
            throw new Exception('postman.storage.sql.find', 1);
        }

        $collection = new Collection;

        while($data = $statment->fetch(PDO::FETCH_OBJ)) {
            $collection->add(
                new Package(
                    new Message($data->$fieldMessage),
                    new Status($data->$fieldStatus),
                    Builder::build(json_decode($data->$fieldTechnology, true)),
                    $data->$fieldClientId,
                    $data->$fieldId
                )
            );
        }

        return $collection;
    }

    public function store(Package $message): Package
    {
        $fieldClientId = self::COLUMN_CLIENT_ID;
        $fieldMessage = self::COLUMN_MESSAGE;
        $fieldStatus = self::COLUMN_STATUS;
        $fieldTechnology = self::COLUMN_TECHNOLOGY;

        $statment = $this->pdo->prepare(
            "INSERT INTO {$this->table} (
                `{$fieldMessage}`, `{$fieldStatus}`, 
                `{$fieldClientId}`, `{$fieldTechnology}`
            ) VALUES (
                :message, :status, 
                :client_id, :tecnology
            )"
        );

        $statment->bindValue(':message', $message->getMessage(), PDO::PARAM_STR);
        $statment->bindValue(':status', $message->getStatus()->getValue(), PDO::PARAM_INT);
        $statment->bindValue(':tecnology', json_encode($message->getTecnology()), PDO::PARAM_STR);
        $statment->bindValue(':client_id', $message->getClient()()->getId(), PDO::PARAM_INT);

        if (! $statment->execute()) {
            throw new Exception('postman.storage.sql.store', 2);
        }

        $id = $this->pdo->lastInsertId();

        return new Package(
            $message->getMessage(),
            $message->getStatus(),
            $message->getTecnology(),
            $message->getClientId(),
            $id
        );
    }

    public function setTable(string $name): self
    {
        $this->table = $name;
        return $this;
    }
}
