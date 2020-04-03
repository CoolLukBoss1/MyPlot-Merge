<?php
declare(strict_types=1);
namespace Crasher508\MyPlotMerge;

use pocketmine\block\Block;
use pocketmine\event\level\LevelLoadEvent;
use pocketmine\lang\BaseLang;
use pocketmine\level\biome\Biome;
use pocketmine\level\format\Chunk;
use pocketmine\level\generator\GeneratorManager;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use MyPlot\Commands;
use MyPlot\MyPlot;
use MyPlot\Plot;
use MyPlot\subcommand\SubCommand;
use pocketmine\scheduler\Task;

class Main extends PluginBase
{
  /** @var Main $myplot */
    public $myplot;
    public $prefix = "§l§aGZ §d> §r";

    public function onEnable()
    {
        $this->myplot = $this->getServer()->getPluginManager()->getPlugin("MyPlot");
        if($this->myplot === null) {
            $this->getLogger()->error("Das Plugin \"MyPlot\" konnte auf diesem Server nicht gefunden werden.");
            $this->setEnabled(false);
            return;
        }
        $this->getLogger()->info("MyPlotMerge von Crasher508 wurde aktiviert");
    }

    public function isTrusted(Player $player, $plot){
		$username = $player->getName();
		return ($plot->owner == $username or $plot->isHelper($username) or $plot->isHelper("*"));
	}

	public function isPlotMerged(Block $block, Player $player){
		$username = $player->getName();
		$x = $block->getX();
		$y = $block->getY();
		$z = $block->getZ();
		$level = $block->getLevel();
		$pos = new Position($x, $y, $z, $level);
		$levelname = $level->getFolderName();
		$plotLevel = $this->myplot->getLevelSettings($levelname);
		$plotSize = $plotLevel->plotSize;
	   $nordplot = $pos->getSide(Vector3::SIDE_NORTH, $plotSize);
	   $suedplot = $pos->getSide(Vector3::SIDE_SOUTH, $plotSize);
	   $eastplot = $pos->getSide(Vector3::SIDE_EAST, $plotSize);
	   $westplot = $pos->getSide(Vector3::SIDE_WEST, $plotSize);
	   $nordplot = $this->myplot->getPlotByPosition($nordplot);
	   $suedplot = $this->myplot->getPlotByPosition($suedplot);
	   $eastplot = $this->myplot->getPlotByPosition($eastplot);
	   $westplot = $this->myplot->getPlotByPosition($westplot);
	   if(($nordplot !== null) and ($nordplot->owner == $username or $nordplot->isHelper($username) or $nordplot->isHelper("*")) and ($suedplot !== null) and ($suedplot->owner == $username or $suedplot->isHelper($username) or $suedplot->isHelper("*"))){
	      return true;
	   }elseif(($eastplot !== null) and ($eastplot->owner == $username or $eastplot->isHelper($username) or $eastplot->isHelper("*")) and ($westplot !== null) and ($westplot->owner == $username or $westplot->isHelper($username) or $westplot->isHelper("*"))){
	      return true;
	   }else{
		#$player->sendMessage("§cNope");
		  return false;
	   }
	}
}
