<?php 
class RuleDetail {
    private $table = 'laundry_rule_details';
    private $rule = 'laundry_rules';
    private $count = 0;
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getRuleDetailByRuleId($id)
    {
        $this->conn->query('SELECT * FROM '.$this->table.' WHERE laundry_rule_id=:id');
        $this->conn->bind('id', $id);
        return $this->conn->resultAll();
    }

    public function getRules($id)
    {
        $this->conn->query('SELECT a.id, a.status, b.name FROM '.$this->table.' AS a RIGHT JOIN '.$this->rule.' As b ON a.rule=b.id WHERE a.laundry_rule_id=:id');
        $this->conn->bind('id', $id);
        return $this->conn->resultAll();
    }

    public function update($data)
    {
        
        $this->conn->query('UPDATE '.$this->table.' SET status = :status WHERE id = :id');

        foreach ($data as $val) {
            $this->conn->bind('status', $val->status, PDO::PARAM_INT);
            $this->conn->bind('id', $val->id, PDO::PARAM_INT);
            $this->conn->execute();
            $this->count += $this->conn->rowCount();     
        }
        
        return $this->count;
    }
}