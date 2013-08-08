<?php

class TopicModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

//    testing method

    function getAllLangTopics(){
        $sql = "SELECT lang_id, topic_id, code FROM topic_lang";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return null;
    }

    function getAllLangs(){
        $sql = "SELECT lang_id, name, version FROM lang";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return null;
    }

    function getAllTopics(){
        $sql = "SELECT topic_id, name FROM topic";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return null;
    }

    function insertCode($langId, $topicId, $code){
//        echo $code;
        $sql = "INSERT INTO topic_lang (lang_id, topic_id, code)
                VALUES (?,?,?)";
//        echo $sql;
        $this->db->query($sql, array($langId, $topicId, $code));
        return $this->db->affected_rows();
    }

    function updateCode($langId, $topicId, $code){
//        echo $code;
        $sql = "UPDATE topic_lang SET
                code=?
                WHERE lang_id=? AND topic_id = ?";
//        echo $sql;
        $this->db->query($sql, array($code, $langId, $topicId));
        return $this->db->affected_rows();
    }

    function existsCode($langId, $topicId){
        $sql="SELECT * FROM topic_lang WHERE lang_id = ? AND topic_id = ?";
        $this->db->query($sql, array($langId, $topicId));
        return $this->db->affected_rows()>0;
    }

    function addTopic($desc){
        $data = array(
            'name' => $desc
        );
        $this->db->insert("topic", $data);
        return $this->db->insert_id();
    }

    function delTopic($id){
        $sql = "DELETE FROM topic_lang
                WHERE topic_id = ?";
        $this->db->query($sql, array($id));

        $sql = "DELETE FROM topic
                WHERE topic_id = ?";
        $this->db->query($sql, array($id));
        return $this->db->affected_rows();
    }

}
?>