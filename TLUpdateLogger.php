<?php


date_default_timezone_set("Iran/tehrn");


class TLLogger {

    

    private $status;

    public $logsize;



    public function __construct($status, array $options) {


        $this->status  = $status;
        
        $this->logsize = $options;


        $log_size    = $options["log_size"];
        
        $del_time    = $options["delete_time"];


        if ($status == "true") {
           
           
            if (!file_exists("TLLoger.log")) {


                $this->logger("Telegram Logger is ready v 1.0 !

                Copyright (C) 2022 Sina hadayati

                Thanks for using...\n \n");
               

            }



            $size = filesize("TLLoger.log");


            $size_kilobyte = $size/1024;


        if (isset($log_size)) {
            
        

            if ($log_size < $size_kilobyte) {

                
                unlink("TLLoger.log");


                $this->restartlog();


            }


        }

        if (isset($del_time)) {
            
            $this->delete_log_file($del_time);

        }


        $this->LoggerStart();
        
    }          

    }





//start



    public function LoggerStart() {

            
        $date = "[".date("Y-m-d") ." ". date("h:i:sa")."]"; 

        
        $update = json_decode(file_get_contents("php://input"));

        

        //update

        

        $update_id  = $update->update_id;

        $message    = $update->message;

        $message_id = $message->message_id;

        $chat_id    = $message->chat->id;

        $chat_type  = $message->chat->type;

        

        //massage

        

        $from_id    = $message->from->id;

        $text       = $message->text;

        

        //callback


        $callback_query        = $update->callback_query;

        $data_call_back        = $callback_query->data;

        $callback_from_id      = $callback_query->from->id;

        $callback_chat_type    = $update->callback_query->message->chat->type;
        
        
        //join update
        
        
        $new_chat_members = $message->new_chat_members;

        $new_member_id    = $new_chat_members[0]->id;
        
        
        //left update
        
        
        $chat_members_left  = $message->left_chat_member;
    
        $left_member_id     = $chat_members_left[0]->id;
        
        //stiker update
        
        $stiker_send_update = $message->sticker;
        
        $stiker_send_fileid = $stiker_send_update->file_id;
        
        //document update
        
        $document_update   = $message->document;
        
        $document_file_id  = $message->document->file_id;
        
        //photo update
        
        $photo_update   = $message->photo;
        
        $photo_file_id  = $photo_update[0]->file_id;
        
        //video update
        
        $video_update   = $message->video;
        
        $video_file_id  = $video_update->file_id;

        // w logger

        
        if (isset($message)) {


            $this->logger("$date Telegram : new Massage update from $from_id  chat type $chat_type  massage id $message_id  update id $update_id \n");


        }




        if (isset($callback_query)) {


            $this->logger("$date Telegram : new callback update from $callback_from_id chat type $callback_chat_type callback data $data_call_back  update id $update_id \n");

    }

    

        if (isset($new_chat_members)) {


            $this->logger("$date Telegram : new join update user id $new_member_id  chat id $chat_id  update id $update_id \n");

    }
    
    
    
        if (isset($chat_members_left)) {


            $this->logger("$date Telegram : new left update user id $left_member_id  chat id $chat_id  update id $update_id \n");

    }
    
    
        if (isset($stiker_send_update)) {


            $this->logger("$date Telegram : new stiker update user id $from_id chat id $chat_id file id $stiker_send_fileid  update id $update_id \n");

    }
    
    
    
        if (isset($document_update)) {


            $this->logger("$date Telegram : new document update user id $from_id chat id $chat_id file id $document_file_id  update id $update_id \n");

    }
    
    
    
        if (isset($photo_update)) {


            $this->logger("$date Telegram : new photo update user id $from_id chat id $chat_id file id $photo_file_id  update id $update_id \n");

    }
    
    
    
        if (isset($video_update)) {


            $this->logger("$date Telegram : new video update user id $from_id chat id $chat_id file id $video_file_id  update id $update_id \n");

    }
    
    }



// Delete at specified time


    public function delete_log_file($time_set) {

        $time = date("h:i");   

    if ($time_set == $time) {
        
        unlink("TLLoger.log");

        $this->restartlog();

    }
    



    }









//restart   


    public function restartlog() {


        $logfile = fopen("TLLoger.log", "w");


        $this->logger("restarting TLLog...



        Telegram Logger is ready !

        Copyright (C) 2022 Sina hadayati

        Thanks for using...\n \n");



    }









//logger



    private function logger($logtext) {

        
        $myfile = fopen("TLLoger.log", "a") or die("TL : Unable to open file!");


        fwrite($myfile,$logtext);


        fclose($myfile);



    }



}



?>