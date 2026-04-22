<?php

declare(strict_types=1);

namespace Handlr\Module\Landing;

use Handlr\Api\Presenter;
use Handlr\Core\Request;
use Handlr\Core\Response;
use Handlr\Database\DbInterface;
use Handlr\Pipes\Pipe;

class GetEmailCaptures implements Pipe
{
    public function __construct(
        private readonly DbInterface $db,
        private readonly Presenter $presenter,
    ) {}

    public function handle(Request $request, Response $response, array $args, callable $next): Response
    {
        $sql = <<<'SQL'
            SELECT `id`, `email`, `source`, `created_at`
            FROM `email_captures`
            ORDER BY `created_at` DESC
        SQL;

        $stmt = $this->db->execute($sql);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($rows as &$row) {
            $row['id'] = $this->db->binToUuid($row['id']);
        }

        return $response->withStatus(Response::HTTP_OK)
            ->withJson($this->presenter->withData($rows)->success());
    }
}
