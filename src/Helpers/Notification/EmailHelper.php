<?php

namespace Digi\Helpers\Notification;

use Mail;
use Digi\Models\agent;
use Digi\Helpers\Helper;

class EmailHelper{

  public static function sendViewEmail($data)
  {
    $result = Helper::checkRequiredParameters($data, array("view", "viewData", "callbackData"));
		
    if($result["result"] == "error")
    {
      return $result;
    }

    //now check required callback data
    $result = Helper::checkRequiredParameters($data["callbackData"], array("subject", "sender", "to"));

    if($result["result"] == "error")
    {
      $result["message"] = preg_replace("/'/", "'callbackData.", $result["message"], 1);
      return $result;
    }

    Mail::send($data["view"], $data["viewData"], EmailHelper::buildMessage($data));
    return array("result" => "success");
  }

  public static function sendRawEmail($data)
  {
    $result = Helper::checkRequiredParameters($data, array("raw", "callbackData"));
		
    if($result["result"] == "error")
    {
      return $result;
    }

    //now check required callback data
    $result = Helper::checkRequiredParameters($data["callbackData"], array("subject", "sender", "to"));

    if($result["result"] == "error")
    {
      $result["message"] = preg_replace("/'/", "'callbackData.", $result["message"], 1);
      return $result;
    }

    Mail::raw($data["raw"], EmailHelper::buildMessage($data));
    return array("result" => "success");
  }

  public static function buildMessage($data)
  {
    return (function($message) use($data){
      $data = $data["callbackData"];

      $message->subject($data["subject"]);

      if(!isset($data["to"]["name"]))
      {
        $data["to"]["name"] = null;
      }
      $message->to($data["to"]["address"], $data["to"]["name"]);

      if(isset($data["sender"]))
      {
        $r = Helper::checkRequiredParameters($data["sender"], array("address"));
        if($r["result"] == "error")
        {
          Log::info("EmailHelper no sender address");
        }
        else
        {
          if(!isset($data["sender"]["name"]))
          {
            $data["sender"]["name"] = null;
          }
          $message->sender($data["sender"]["address"], $data["sender"]["name"]);
          $message->from($data["sender"]["address"], $data["sender"]["name"]);
        }
      }

      if(isset($data["from"]))
      {
        $r = Helper::checkRequiredParameters($data["from"], array("address"));
        if($r["result"] == "error")
        {
          //					Log::info(print_r($r, 1));
          Log::info("EmailHelper no from address");
        }
        else
        {
          if(!isset($data["from"]["name"]))
          {
            $data["from"]["name"] = null;
          }
          $message->from($data["from"]["address"], $data["from"]["name"]);
        }
      }

      if(isset($data["cc"]))
      {
        foreach($data["cc"] as $cc)
        {
          $r = Helper::checkRequiredParameters($cc, array("address"));
          if($r["result"] == "error")
          {
            //						Log::info(print_r($r, 1));
            Log::info("EmailHelper no cc address");
            continue;
          }
          if(!isset($cc["name"]))
          {
            $cc["name"] = null;
          }
          $message->cc($cc["address"], $cc["name"]);
        }
      }

      if(isset($data["bcc"]))
      {
        foreach($data["bcc"] as $cc)
        {
          $r = Helper::checkRequiredParameters($bcc, array("address"));
          if($r["result"] == "error")
          {
            //						Log::info(print_r($r, 1));
            Log::info("EmailHelper no bcc address");
            continue;
          }
          if(!isset($bcc["name"]))
          {
            $bcc["name"] = null;
          }
          $message->bcc($bcc["address"], $bcc["name"]);
        }
      }

      if(isset($data["replyTo"]))
      {
        $r = Helper::checkRequiredParameters($data["replyTo"], array("address"));
        if($r["result"] == "error")
        {
          //					Log::info(print_r($r, 1));
          Log::info("EmailHelper no replyTo address");
        }
        else
        {
          if(!isset($data["replyTo"]["name"]))
          {
            $data["replyTo"]["name"] = null;
          }
          $message->replyTo($data["replyTo"]["address"], $data["replyTo"]["name"]);
        }
      }

      if(isset($data["priority"]))
      {
        $message->priority($data["priority"]);
      }

      if(isset($data["attachments"]))
      {
        foreach($data["attachments"] as $attachment)
        {
          $r = Helper::checkRequiredParameters($attachment, array("pathToFile"));
          if($r["result"] == "error")
          {
            //						Log::info(print_r($r, 1));
            Log::info("EmailHelper no pathToFile address");
            continue;
          }
          if(!isset($attachment["options"]))
          {
            $attachment["options"] = null;
          }
          $message->attach($attachment["pathToFile"], $attachment["options"]);
        }
      }
    });
  }
}