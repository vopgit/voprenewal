<?php 
for($i=1; $i<count($rs['data']) ; $i++) {
	$data = $rs['data'][$i];
	?>
	<li class="ul_img_item">
		<div class="ul_img">
			<?php 
			if($data['mthumbnail'] != ''){ 
				$f = getimagesize(_IMAGE_URL.ltrim($data['mthumbnail'],'/'));
				if($f[0] > 0){
				?>
				<div class="ul_img_img">
					<a href="/<?=$data['serial']?>.html">
						<img src="<?=_IMAGE_URL.ltrim($data['mthumbnail'],'/')?>" alt="<?=$data['title']?>" />
					</a>
				</div>
				<?php 
				}
			}
			?>
			<div class="ul_img_text">
				<div>
					<a href="/<?=$data['serial']?>.html" class="ul_img_tit_box">
						<span class="ul_img_tit"><?=$data['title']?></span>
					</a>
					<div class="ul_img_info_box">
						<ul class="ul_img_info">
							<li><?=($data['contributor'] != '') ? $data['contributor'] : $data['name']." 기자";?></li>
							<li><?=substr($data['published_time'],0,16)?></li>
						</ul>
					</div>
					<?php if($data['description'] != ''){ ?>
						<p class="ul_img_txt"><a href="/<?=$data['serial']?>.html"><?=$data['description']?> </a></p>
					<?php } ?>
				</div>
			</div>
		</div>
	</li>
	<?php 
	} 
?>