<?php
/**
 * Created by PhpStorm.
 * User: InkoHX
 * Date: 2018/04/04
 * Time: 20:46
 */
namespace AFAB;
class Main extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener {
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if (!file_exists($this->getDataFolder())) @mkdir($this->getDataFolder(), 0755, true);
        $this->data = new \pocketmine\utils\Config($this->getDataFolder() . "data.json", \pocketmine\utils\Config::JSON);
        date_default_timezone_set("Asia/Tokyo");
        $this->getLogger()->info("コードの読み込みが完了しました。");
    }
    public function onDisable()
    {
        $this->data->save();
        $this->getLogger()->info("プラグインを終了しました。");
    }
    public function onLogin(\pocketmine\event\player\PlayerLoginEvent $event)
    {
        $player = $event->getPlayer();
        if ($this->data->get($player->getName()) === "true")
        {
            $player->kick("§4You are banned\n§7Reason: §fFlyHack", false);
        }
    }
    public function onFly(\pocketmine\event\player\PlayerToggleFlightEvent $event)
    {
        $player = $event->getPlayer();
        if ($event->isFlying())
        {
            if (!$player->isOp())
            {
                $player->kick("§4You are banned\n§7Reason: §fFlyHack", false);
                $this->data->set($player->getName(), "true");
                $this->data->save();
                $this->getServer()->broadcastMessage("§cBanned ".$player->getName()."\n§7Reason: §fFlyHack");
                $this->getLogger()->debug($player->getName()." をBANしました。");
            }
        } else {
            if (!$player->isOp())
            {
                $player->kick("§4You are banned\n§7Reason: §fFlyHack", false);
                $this->data->set($player->getName(), "true");
                $this->data->save();
                $this->getServer()->broadcastMessage("§cBanned ".$player->getName()."\n§7Reason: §fFlyHack");
                $this->getLogger()->debug($player->getName()." をBANしました。");
            }
        }
    }
