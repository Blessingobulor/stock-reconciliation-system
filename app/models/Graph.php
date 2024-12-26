<?php


/**
 * Graph Creator Class
 */
class Graph
{
	
	public $canvasX = 1000;
	public $canvasY = 400;
	public $fontsize = 11;
	public $style = '';
	public $title = 'Graph Title';
	public $xtitle = 'Title X';

	public function display($data)
	{
		$canvasX = $this->canvasX;
		$canvasY = $this->canvasY;

		if (!is_array($data) || empty($data)) 
		{

			echo "Data variables must be an array and must contain data";
			return;
		}
		
		$xText = array_keys($data);

		$maxY = max($data);
		$maxX = count($data);

		$maxY = $maxY < 1 ? 1 : $maxY;
		$multiplierY = $canvasY/$maxY;
		$multiplierX = $canvasX/$maxX;

		$num = 1;
		$points = "0,$canvasY ";
		foreach ($data as $key => $value) 
		{
			$points .= ($multiplierX*$num) . "," . (($canvasY)  - ($value*$multiplierY))  . " "; 
			$num++;
		}
		$points .= "$canvasX,$canvasY";

		$extraX = 70;
		$extraY =  40;

		?>

		<svg viewBox="0 -<?=$extraY?> <?=$canvasX + $extraX?> <?=$canvasY + ($extraY * 2.5)?>" style="width:100%;" class="shadow-lg border">

			<!-- Top to buttom lines -->
			<?php

				for ($i=0; $i < $maxX; $i++) 
				{ 	
					$x1 = ($i * $multiplierX);
					$y1 = 0;
					$x2 = $x1;
					$y2 = $canvasY;

					?>
						<polyline points="<?=$x1?>,<?=$y1?> <?=$x2?>,<?=$y2?>" style="stroke: #eee; stroke-width:1;" />
					<?php
				}

				
			?>

			<!-- Left to Right lines -->
			<?php

				$max_lines = count($data);
				$Ysegment = round($canvasY / $max_lines);
				for ($i=0; $i < $max_lines; $i++) 
				{ 	
					$x1 = 0;
					$y1 = $i * $Ysegment;
					$x2 = $canvasX;
					$y2 = $y1;

					?>
						<polyline points="<?=$x1?>,<?=$y1?> <?=$x2?>,<?=$y2?>" style="stroke: #eee; stroke-width:1;" />
					<?php
				}

				
			?>
			<polyline points="<?=$points?>" style="stroke: #bbb; stroke-width:2;fill: #bbbbbb88;" />
			
			<?php

				$num = 1;
				$points = "0,$canvasY ";
				foreach ($data as $key => $value) 
				{
					?>
						<circle r="5" cx="<?=($multiplierX*$num)?>" cy="<?=(($canvasY)  - ($value*$multiplierY))?>" style="stroke-width: 2;" />
						
						<?php if($value != 0):?>
							<text x="<?=($multiplierX*$num)?>" y="<?=(($canvasY)  - ($value*$multiplierY) - 5)?>" style="font-size: 15px; fill: blue;"><?=$value?></text>
						<?php endif;?>
					<?php 
					$num++;
				}
				$points .= "$canvasX,$canvasY";


			?>	


			<!-- X text values -->
			<?php $num = 0; ?>
			<?php foreach($xText as $value): $num++?>
				<text x="<?= ($num * $multiplierX) - ($multiplierX/7)?>" y="<?=$canvasY + ($extraY / 2) ?>" style="fill: red; font-size: <?=$this->fontsize?>px;"> <?=$value?> </text>
			<?php endforeach;?>

			<!-- Y text values -->
			<?php

				$max_lines = count($data);
				$num = $maxY;
				$Ysegment = round($canvasY / $max_lines);
				for ($i=0; $i < $max_lines; $i++) 
				{
					$x = $canvasX;
					$y = $i * $Ysegment;
					if($num < 0) 
					{
						break;
					}
					?>
						<text x="<?= $x + ($multiplierX/8) ?>" y="<?= $y ?>" style="fill: red; font-size: <?=$this->fontsize?>px;"> <?=round($num)?> </text>
					<?php

					$max_lines = $max_lines ? $max_lines : 1;
					$num -= ($maxY / $max_lines);
				}

				
			?>

			<!-- Graph Text -->
			<a href="">
				<text x="10" y="-<?=($extraY / 3)?>" style="fill: red; font-size: 20px;"> <?=$this->title?> </text>
			</a>

			<!-- X axis Title -->
			<?php

				$textoffset = ((strlen($this->xtitle) / 2) * 9);

			?>
			<a href="">
				<text x="<?=($canvasX/2) - $textoffset?>" y="<?=($canvasY + $extraY + 5)?>" style="fill: red; font-size: 18px;"> <?=$this->xtitle?> </text>
			</a>

		</svg>
		<?php
	}
}