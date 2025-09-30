<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class StudentsModel extends Model
{
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

        protected $has_soft_delete = true;
    protected $soft_delete_column = 'deleted_at';

      /* =========================
     * ACTIVE RECORDS
     * ========================= */
    public function count_all_records($search = null)
    {
        $sql = "SELECT COUNT(id) AS total FROM {$this->table} WHERE {$this->soft_delete_column} IS NULL";
        $params = [];

        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }

        $row = $this->db->raw($sql, $params)->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['total'] : 0;
    }

    public function get_records_with_pagination($limit_clause, $search = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->soft_delete_column} IS NULL";
        $params = [];

        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }

        $sql .= " ORDER BY id ASC {$limit_clause}";
        return $this->db->raw($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
     * DELETED RECORDS
     * ========================= */
    public function count_deleted_records($search = null)
    {
        $sql = "SELECT COUNT(id) AS total FROM {$this->table} WHERE {$this->soft_delete_column} IS NOT NULL";
        $params = [];

        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }

        $row = $this->db->raw($sql, $params)->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['total'] : 0;
    }

    public function get_deleted_with_pagination($limit_clause, $search = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->soft_delete_column} IS NOT NULL";
        $params = [];

        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }

        $sql .= " ORDER BY id DESC {$limit_clause}";
        return $this->db->raw($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_deleted_records()
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->soft_delete_column} IS NOT NULL ORDER BY id DESC";
        return $this->db->raw($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

   public function soft_delete($id): ?bool
{
    if (empty($id)) return null;
    $sql = "UPDATE {$this->table} SET {$this->soft_delete_column} = NOW() WHERE {$this->primary_key} = ?";
    $stmt = $this->db->raw($sql, [$id]);
    return $stmt->rowCount() > 0 ? true : null;
}

public function restore($id): ?bool
{
    if (empty($id)) return null;
    $sql = "UPDATE {$this->table} SET {$this->soft_delete_column} = NULL WHERE {$this->primary_key} = ?";
    $stmt = $this->db->raw($sql, [$id]);
    return $stmt->rowCount() > 0 ? true : null;
}

public function hard_delete($id): ?bool
{
    if (empty($id)) return null;
    $sql = "DELETE FROM {$this->table} WHERE {$this->primary_key} = ?";
    $stmt = $this->db->raw($sql, [$id]);
    return $stmt->rowCount() > 0 ? true : null;
}

/* =========================
 * AUTHENTICATION METHODS
 * ========================= */
public function find_by_email($email)
{
    if (empty($email)) return null;
    $sql = "SELECT * FROM {$this->table} WHERE email = ? AND {$this->soft_delete_column} IS NULL LIMIT 1";
    $result = $this->db->raw($sql, [$email])->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}

public function verify_password($password, $stored_password)
{
    return $password === $stored_password;
}

public function create_student($data)
{
    return $this->insert($data);
}

public function email_exists($email)
{
    if (empty($email)) return false;
    $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE email = ? AND {$this->soft_delete_column} IS NULL";
    $result = $this->db->raw($sql, [$email])->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
}
}