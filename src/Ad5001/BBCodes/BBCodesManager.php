<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

use Ad5001\BBCodes\Main;
use Ad5001\BBCodes\BBCode;



class BBCodesManager {


   public function __construct(Main $main) {
        $this->main = $main;
        $this->server = $main->getServer();
        $this->tags = [];
    }
    
    
    public function unregisterTag(Plugin $sender, string $tag): bool {
        if(!$this->isTagTaken($tag)) {
            $this->main->getLogger()->warning($owner->getName() . " tried to unregister a tag that does not exists. You can check if it's registered with " . '$bbcodeManager->isTagTaken("tagname")');
            $sender->setDisable();
            return false;
        } else {
            unset($this->tags[$tag]);
            return true;
        }
        
    }
    
    
   public function getTags() : array {
       return $this->tags;
   }
   
   
   public function isTagTaken(string $tag) {
       return array_key_exists($tag, $this->tags);
   }
    
    
    public function registerTag(Plugin $owner, BBCode $class) {
        if($this->isTagTaken($class->getTagName())) {
            $this->main->getLogger()->warning($owner->getName() . " tried to register an already taken tag. You can check if a tag is already registered by doing " . '$bbcodeManager->isTagTaken("tagname")');
            $owner->setEnabled(false);
            return false;
        } else {
            $this->tags[$class->getTagName()] = $class;
        }
    }
    
    
    
    public function parse(Player $sender, string $msg) {
        foreach($this->tags as $name => $tagClass) {
            if(strpos($msg, "[/" . $name . "]") !== false and strpos($msg, "[" . $name . "]") !== false and $tagClass->takeParam() == [] and $tagClass->canUse($sender)) {
                $parts = explode("[" . $name . "]", $msg);
                $num = 1;
                while(isset($parts[$num])) {
                    // print_r($parts);
                    // print_r(explode("[/" . $name . "]", $parts[$num])[0] . "[/" . $name . "]");
                    $parts[$num] = str_replace(explode("[/" . $name . "]", $parts[$num])[0] . "[/" . $name . "]", $tagClass->parse(explode("[/" . $name . "]", $parts[$num])[0]), $parts[$num]);
                    $num++;
                }
                $msg = implode("", $parts);
            } else {
                foreach($tagClass->takeParam() as $param) {
                    if(strpos($msg, "[" . $name . "=" . $param . "]") < strpos($msg, "[/" . $name . "]") and strpos($msg, "[" . $name . "=" . $param . "]") !== false and $tagClass->canUse($sender)) {
                        // $this->server->broadcastMessage("Found $name with $param");
                        $parts = explode("[" . $name . "=" . $param . "]", $msg);
                        $num = 1;
                        while(isset($parts[$num])) {
                            $parts[$num] = str_replace(explode("[/" . $name . "]", $parts[$num])[0] . "[/" . $name . "]", $tagClass->parse(explode("[/" . $name . "]", $parts[$num])[0], $param), $parts[$num]);
                            // $this->server->broadcastMessage("Processing $name with $param at $part[$num]");
                            $num++;
                        }
                        $msg = implode("", $parts);
                    }
                }
            }
        }
        
        return $msg;
    }
    
    
    public function getTagByTag(string $tag) {
        if($this->isTagTaken($tag)) {
            return $this->tags[$tag];
        } else {
            return false;
        }
    }
    
    
    public function getTagByName(string $name) {
        foreach($this->tags as $tag) {
            if(strtolower(get_class($tag)) == strtolower($name)) {
                return $tag;
            }
        }
        return false;
    }


}