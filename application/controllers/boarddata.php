<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boarddata extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TopicModel');
    }


    public function getall(){
//        echo "xxxxxxx";
//        echo $this->TopicModel->listAll();
//        echo json_encode(array("b"=>));
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(
                array("langs"=>$this->TopicModel->getAllLangs(),
                    "topics"=>$this->TopicModel->getAllTopics(),
                "codes"=>$this->TopicModel->getAllLangTopics()
            )));

//        return $this->Topic->getTopicInstances();
    }

    public function code(){
        $langId = $this->input->get("l_id");
        $topicId = $this->input->get("t_id");
        $code = file_get_contents('php://input');
        $key = $this->input->get("key");
        if(!$this->TopicModel->existsCode($langId,$topicId)){
            $numRows = $this->TopicModel->insertCode($langId, $topicId, $code);
        }else{
            if($key=="omgx"){
                $numRows = $this->TopicModel->updateCode($langId, $topicId, $code);
            }
            else
                $numRows=0;
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output($numRows);

    }

    public function addtopic(){
        $name = $this->input->get("name");
        $insertedId = $this->TopicModel->addTopic($name);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array("id"=>$insertedId)));
    }


    public function deltopic(){
        $name = $this->input->get("id");
        $key = $this->input->get("key");
        $insertedId=0;
        if($key=='omgx'){
            $insertedId = $this->TopicModel->delTopic($name);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output($insertedId);
    }
}
?>