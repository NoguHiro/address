<?php
/**
 * Created by PhpStorm.
 * User: noguhiro
 * Date: 15/03/22
 * Time: 2:09
 */

class Address
{

    private $_table = 'address';

    private $_fields = [
        'name', 'address', 'tel'
    ];

    private $_db = null;

    public function __construct()
    {
        $this->_db = Db::connect();
    }

    public function findAll()
    {
        $stmt = $this->_db->query('SELECT * FROM ' . $this->_table);
        $ret = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ret[] = $row;
        }
        return $ret;
    }

    public function findById($id)
    {
        if (empty($id)) {
            return null;
        }

        try {
            $stmt = $this->_db->prepare('SELECT * FROM ' . $this->_table . ' WHERE `id` = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                throw new PDOException('SQLが発行できませんでした。');
            }

            $ret = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch (Exception $e) {
            throw $e;
        }
        return $ret;
    }

    public function insert(array $dat)
    {
        try {

            array_walk($this->_fields, function($field) {
                if (!in_array($field, $this->_fields)) {
                    throw new RuntimeException($field . 'が見つかりません');
                }
            });

            $makeField = function($dat) {
                $ret = '';
                foreach ($dat as $field => &$val) {
                    $ret .= $field . ',';
                }
                return substr($ret, 0, -1);
            };
            $makePrepareField = function($dat) {
                $ret = '';
                foreach ($dat as $field => &$val) {
                    $ret .= ':' . $field . ',';
                }
                return substr($ret, 0, -1);
            };
            $sql = sprintf('INSERT INTO %s (%s) VALUES(%s)',
                        $this->_table, $makeField($dat), $makePrepareField($dat));

            var_dump($sql);
            $stmt = $this->_db->prepare($sql);

            foreach ($dat as $k => $v) {
                $stmt->bindValue(':' . $k, $v);
            }

            if (!$stmt->execute()) {
                throw new RuntimeException('保存に失敗しました!!');
            }

        }
        catch (Exception $e) {
            return null;
        }

        return $this->_db->lastInsertId();

    }
}