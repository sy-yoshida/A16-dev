<?php

class RecodeModel extends DatabaseModel
{
    public function search()
    {
        $sql = 'select count(*) from `a-16`';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();
        var_dump($result);
    }
}
