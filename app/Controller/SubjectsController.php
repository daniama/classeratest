<?php

// Controller/SubjectsController.php
class SubjectsController extends AppController {
    public $components = array('RequestHandler');

    public function ListSubjects($course_id) {//get List Subjects for specific Course

        if (!$course_id) {
            $message = "Course is not defined!";
            $this->set("message",$message); 
            $this->set("_serialize", array('message'));
            return false;   
        }

        $subjects = $this->Subject->find('all',array('conditions' => array('course_id' => $course_id)) );

        if (!$subjects) {
            $message = "No Subjects were found!";
            $this->set("message",$message); 
            $this->set("_serialize", array('message'));
            return false;
        }

        foreach($subjects as $data)
            $subjects_Json[]=$data['Subject'];//['Subject']:Model Name
        
         $this->set(array(
            'subjects_Json' => $subjects_Json,
            '_serialize' => array('subjects_Json')
        ));
    }

    public function subjectDetails($id) {
        $message = "";
        $status = false;
        $code = '';

        $json_subject = array();
        $this->render(false);

        if (!$id) {
            $code = '404';
            
        } else {

            $subject = $this->Subject->findById($id);
            if (!$subject) {
                $code = '404';

            } else {
                $json_subject = $subject['Subject']; 
                $code = "200";       
                $status = true;
            }
        }

        
        $this->response->type('json');
        $json_body = json_encode(
                        array(  "comments" => $json_subject,
                                "message" => AppController::getReturnedMessage($code),
                                "status" => $status, 
                                "code" => $code
               )
            );
        $this->response->body($json_body);

    }

}