<?php

namespace Digi\Helpers;

use DB;
use Log;
use Digi\Helpers\LeadRatingHelper;

class LogHelper{

    /**
     * method to log activities in to the data warehouse activity_log table
     * system is a string, 32 max len (truncated)
     * class is a string, 32 max len (truncated)
     * method is a string, 32 max len (truncated)
     * userId is an unsigned int
     * message is a string, 255 max len (truncated)
     * numeric is and unsigned int
     * sample call --
     * LogHelper::logActivity(gethostname(), __METHOD__, $agent_id, "phpunit test generated message", 123);
     * will need this to use --
     * use Digi\Helpers\LogHelper;
     **/

    public static function logActivity($system, $method, $userId, $message, $numeric)
    {
        if (!is_numeric($userId)) {$userId = null;}elseif(!is_int($userId)){$userId=null;}
        if (!is_numeric($numeric)) {$numeric = null;}elseif(!is_int($numeric)){$numeric=null;}
        DB::connection('digidwh')->table('activity_log')->insert(
            ['system' => substr($system, 0, 63), 'method' => substr($method, 0, 31), 'user_id' => $userId, 'message' => substr($message, 0, 254), 'number' => $numeric]
        );
        return array("result" => "success");
    }
    /**
    * have added lead_id and vendor_id so that we can generate all of the use statistics within the warehouse
    **/
    public static function logActivityNew($system, $method, $userId, $leadId, $vendorId, $message, $numeric)
    {
        if (!is_numeric($userId)) {$userId = null;}elseif(!is_int($userId)){$userId=null;}
        if (!is_numeric($leadId)) {$leadId = null;}elseif(!is_int($leadId)){$leadId=null;}
        if (!is_numeric($vendorId)) {$vendorId = null;}elseif(!is_int($vendorId)){$vendorId=null;}
        if (!is_numeric($numeric)) {$numeric = null;}elseif(!is_int($numeric)){$numeric=null;}
        DB::connection('digidwh')->table('activity_log')->insert(
            ['system' => substr($system, 0, 63), 'method' => substr($method, 0, 31), 'user_id' => $userId, 'lead_id' => $leadId, 'vendor_id' => $vendorId, 'message' => substr($message, 0, 254), 'number' => $numeric]
        );
        return array("result" => "success");
    }
    /**
    * have added lead_id and vendor_id so that we can generate all of the use statistics within the warehouse
    **/
    public static function logActivityId($system, $method, $userId, $leadId, $vendorId, $message, $messageId, $numeric)
    {
        if (!is_numeric($userId))    {$userId = null;}   elseif(!is_int($userId))   {$userId=null;}
        if (!is_numeric($leadId))    {$leadId = null;}   elseif(!is_int($leadId))   {$leadId=null;}
        if (!is_numeric($vendorId))  {$vendorId = null;} elseif(!is_int($vendorId)) {$vendorId=null;}
        if (!is_numeric($messageId)) {$messageId = null;}elseif(!is_int($messageId)){$messageId=null;}
        if (!is_numeric($numeric))   {$numeric = null;}  elseif(!is_int($numeric))  {$numeric=null;}
        DB::connection('digidwh')->table('activity_log')->insert(
            ['system' => substr($system, 0, 127), 'method' => substr($method, 0, 63), 'user_id' => $userId, 'lead_id' => $leadId, 'vendor_id' => $vendorId, 'message' => substr($message, 0, 254), 'message_id' => $messageId, 'number' => $numeric]
        );
        return array("result" => "success");
    }
    /**
     * method to log calls in to the data warehouse call_log table
     * system is a string, 64 max len (truncated)
     * method is a string, 64 max len (truncated)
     * userId is an unsigned int
     * CallSid is a string (from twilio), 40 max len (truncated)
     * sample call --
     * LogHelper::logCall(gethostname(), __METHOD__, 0, "CA3d5d56455da15e8e25518db51ece1a98", 932467, 44);

     **/

    public static function logCall($system, $method, $userId, $callSid, $leadId, $duration)
    {
        if (!is_numeric($userId))   {$userId = null;}elseif(!is_int($userId)){$userId=null;}
        if (!is_numeric($leadId))   {$leadId = null;}elseif(!is_int($leadId)){$leadId=null;}
        DB::connection('digidwh')->table('call_log')->insert(
            ['system' => substr($system, 0, 63), 'method' => substr($method, 0, 63), 'user_id' => $userId, 'call_sid' => substr($callSid, 0, 39), 'lead_id' => $leadId, 'duration' => $duration]
        );
        return array("result" => "success");
    }
    /**
     * method to log transactions in to the data warehouse transaction_log table
     * system is a string, 64 max len (truncated)
     * method is a string, 64 max len (truncated)
     * agentId is an unsigned int
     * dynamoId is an unsigned int
     * action is an unsigned int
     * comment is a string, 128 max len (truncated)
     * sample call --
     * 
     **/

    public static function logTrans($system, $method, $type, $agentId, $leadId, $dynamoId, $action, $comment)
    {
        if (!is_numeric($type)) {$type = null;} elseif (!is_int($type)) {$type=null;}
        if (!is_numeric($agentId)) {$agentId = null;} elseif (!is_int($agentId)) {$agentId=null;}
        if (!is_numeric($leadId)) {$leadId = null;} elseif (!is_int($leadId)) {$leadId=null;}
        if (!is_numeric($dynamoId)) {$dynamoId = null;} elseif (!is_int($dynamoId)) {$dynamoId=null;}
        if (!is_numeric($action)) {$action = null;} elseif (!is_int($action)) {$action=null;}
        DB::connection('digidwh')->table('transaction_log')->insert(
            ['system' => substr($system, 0, 63), 'method' => substr($method, 0, 63), 'type' => $type, 'lead_id' => $leadId, 'agent_id' => $agentId, 'dynamo_id' => $dynamoId, 'action' => $action, 'lead_sid' => substr($comment, 0, 127)]
        );
        return array("result" => "success");
    }
    /**
     * method to log transactions in to the data warehouse transaction_log table
     * system is a string, 64 max len (truncated)
     * method is a string, 64 max len (truncated)
     * leadId is an unsigned int
     * status is an unsigned int (from the enumerations table, type_id = 15)
     * sample call --
     * logLeadStatus(gethostname(), __METHOD__, 201, 166)
     * know valid status values 20160309
     * 
     *	id	text
     *	165	Lead
     *	166	Contact
     *	171	Assigned General Voicemail
     *	174	Assigned Connect  (Not Interested)
     *	177	Unassigned General Voicemail
     *	178	Assigned to Agent
     *	179	Assigned Connect
     *	180	Assigned Connect (Not Interested)
     *	181	Assigned Connect (Not Interested - Follow up)
     *	182	Assigned Connect (Do Not Contact)
     *	183	Assigned (Not Qualified)
     *	184	Assigned to Agent Voicemail
     *	185	Direct Assigned Connect
     *	187	Quoted (Not Qualified)
     *	188	Quoted (Competitive - Not Interested)
     *	189	Quoted (Uncompetitive - Not Interested)
     *	190	Quoted (Competitive - Callback Scheduled)
     *	191	Quoted (Uncompetitive - Callback Scheduled)
     *	192	App Processing (Info Needed)
     *	193	App Processing (Payment Needed)
     *	194	App Processing (Submission Scheduled)
     *	195	Policy Sold
     *	196	Policy (Carrier Cancel - Rewrite)
     *	197	Policy (Claim - Needs Contact)
     *	198	Policy (Endorsement - Needs Contact)
     *	199	Policy (Cancel - Customer Request)
     *	200	Policy (Cancel - AMS)
     *	201	Renewal Pending (60 days)
     *	202	Renewal Pending (30 days)
     *	203	Callback Scheduled
     *	1894	Quoted
     *	1895	Customer
     **/

    public static function logLeadStatus($system, $method, $leadId, $status)
    {
        if (!is_numeric($leadId)||!is_int($leadId)) {
            Log::error("LogHelper::logLeadStatus - leadId ".$leadId);
            return array("result" => "error", "message" => "invalid leadId - ".$leadId." from ".$system." ".$method);
        }
        if (!is_numeric($status)||!is_int($status)) {
            // if not numeric go look it up in the enumerations table
            $possible_stati = DB::connection('mysql')->table('enumerations')->select('id', 'text')->where('type_id','15')->where('text', 'like', '%'.substr($status, 0, 63).'%')->get();
            if (count($possible_stati) == 0){
                Log::error("LogHelper::logLeadStatus - status no match ".$status);
                return array("result" => "error", "message" => "invalid status - ".$status." from ".$system." ".$method);
            }elseif(count($possible_stati)==1){
                $status= $possible_stati[0]->id;
            }else{
                // try to find the closest one
                foreach($possible_stati as $status_id => $status_text){
                    $sim[$status_id] = similar_text($status, $status_text);
                }
                $max_sim = max(array_values($sim));
                $status = array_search($max_sim, $sim);
                Log::info("LogHelper::logLeadStatus - status match multi ".$status);
            }
        }

        try{
            DB::connection('mysql')->table('leads')->where('id',$leadId)->update(['state' => $status]);
            Log::info("LogHelper::logLeadStatus - mysql ".$leadId." ".$status);
        }catch (Exception $e){
            Log::error("LogHelper::logLeadStatus - mysql");
            return array("result" => "error", "message" => $e);
        }
        try{
            LeadRatingHelper::rateLead(0, $leadId);
            DB::connection('digidwh')->table('lead_status')->insert(['lead_id'=>$leadId,'status'=>$status]);
            Log::info("LogHelper::logLeadStatus - digidwh ".$leadId." ".$status);
        }catch (Exception $e){
            Log::error("LogHelper::logLeadStatus - digidwh");
            return array("result" => "error", "message" => $e);
        }
        return array("result" => "success");    
    }}