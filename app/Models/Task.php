<?php
declare(strict_types=1);

require_once __DIR__ . '/../../config/database.php';

class Task {

    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM tasks ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): void {
        $stmt = $this->db->prepare(
            "INSERT INTO tasks (title, description) VALUES (:title, :description)"
        );
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void {
        $stmt = $this->db->prepare(
            "UPDATE tasks SET title = :title, description = :description WHERE id = :id"
        );
        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description']
        ]);
    }

    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function status(int $id): void {
        $stmt = $this->db->prepare(
            "UPDATE tasks SET status = 1 WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
    }
}
