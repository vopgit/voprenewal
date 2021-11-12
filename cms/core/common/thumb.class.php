<?php 
# resizeImage(width, height, option); 
# option 'exact'://가로세로지정된사이즈로 - 이미지찌그러짐 있슴
#		 'portrait': //세로에 맞게 리사이즈 
#		 'landscape': //가로에 맞게 리사이즈
#		 'auto': default
#        'crop': //지정된 크기로 자르기
#         숫자 : 0-100 품질
#
# include("classes/thumbImage.class.php");
# $resizeObj = new thumbImage('images/cars/large/input.jpg');
# $resizeObj -> resizeImage(150, 100, 'auto'); 
# $resizeObj -> saveImage('images/cars/large/output.jpg', 100);
#
# $resizeObj -> resizeImage(150, 100, 'crop');  //default : auto
# $resizeObj -> showImage(100);

Class thumbImage
{
	private $image;
	private $width;
	private $height;
	private $imageResized;

	function __construct($fileName)
	{
		$this->image = $this->openImage($fileName);
		$this->width  = imagesx($this->image);
		$this->height = imagesy($this->image);
		
		//exif 회전정보 가져오기
		if(function_exists('exif_read_data')){
			$exif = exif_read_data($fileName, 0, true);
			$this->Orientation = $exif['IFD0']['Orientation'];
			//debug($exif);
		}
		
	}

	private function openImage($file)
	{
		$extension = strtolower(strrchr($file, '.'));

		switch($extension)
		{
			case '.jpg':
			case '.jpeg':
				$img = @imagecreatefromjpeg($file);
				break;
			case '.gif':
				$img = @imagecreatefromgif($file);
				break;
			case '.png':
				$img = @imagecreatefrompng($file);
				break;
			default:
				$img = false;
				break;
		}
		return $img;
	}

	public function resizeImage($newWidth, $newHeight, $option="auto")
	{
		$optionArray = $this->getDimensions($newWidth, $newHeight, $option);

		$optimalWidth  = $optionArray['optimalWidth'];
		$optimalHeight = $optionArray['optimalHeight'];

		$this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
		
		//배경투명하게
		imagealphablending($this->imageResized, false);
        imagesavealpha($this->imageResized,true);
        $transparent = imagecolorallocatealpha($this->imageResized, 255, 255, 255, 127);
        imagefilledrectangle($this->imageResized, 0, 0, $w, $h, $transparent);

		imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);

		if ($option == 'crop') {
			$this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
		}
	}

	
	private function getDimensions($newWidth, $newHeight, $option)
	{

	   switch ($option)
		{
			case 'exact':  //가로세로지정된사이즈로 - 이미지찌그러짐 있슴
				$optimalWidth = $newWidth;
				$optimalHeight= $newHeight;
				break;
			case 'portrait': //세로에 맞게 리사이즈 
				$optimalWidth = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight= $newHeight;
				break;
			case 'landscape': //가로에 맞게 리사이즈
				$optimalWidth = $newWidth;
				$optimalHeight= $this->getSizeByFixedWidth($newWidth);
				break;
			case 'auto':
				$optionArray = $this->getSizeByAuto($newWidth, $newHeight);
				$optimalWidth = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];
				break;
			case 'crop': //지정된 크기로 자르기
				$optionArray = $this->getOptimalCrop($newWidth, $newHeight);
				$optimalWidth = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];
				break;
		}
		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	private function getSizeByFixedHeight($newHeight)
	{
		$ratio = $this->width / $this->height;
		$newWidth = $newHeight * $ratio;
		return $newWidth;
	}

	private function getSizeByFixedWidth($newWidth)
	{
		$ratio = $this->height / $this->width;
		$newHeight = $newWidth * $ratio;
		return $newHeight;
	}

	private function getSizeByAuto($newWidth, $newHeight)
	{
		if ($this->height < $this->width)
		// width 기준 리사이즈(landscape)
		{
			$optimalWidth = $newWidth;
			$optimalHeight= $this->getSizeByFixedWidth($newWidth);
		}
		elseif ($this->height > $this->width)
		// height 기준 리사이즈(portrait)
		{
			$optimalWidth = $this->getSizeByFixedHeight($newHeight);
			$optimalHeight= $newHeight;
		}
		else
		// *** Image to be resizerd is a square
		{
			if ($newHeight < $newWidth) {
				$optimalWidth = $newWidth;
				$optimalHeight= $this->getSizeByFixedWidth($newWidth);
			} else if ($newHeight > $newWidth) {
				$optimalWidth = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight= $newHeight;
			} else {
				// *** Sqaure being resized to a square
				$optimalWidth = $newWidth;
				$optimalHeight= $newHeight;
			}
		}

		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	private function getOptimalCrop($newWidth, $newHeight)
	{

		$heightRatio = $this->height / $newHeight;
		$widthRatio  = $this->width /  $newWidth;

		if ($heightRatio < $widthRatio) {
			$optimalRatio = $heightRatio;
		} else {
			$optimalRatio = $widthRatio;
		}

		$optimalHeight = $this->height / $optimalRatio;
		$optimalWidth  = $this->width  / $optimalRatio;

		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
	{
		$cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
		$cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

		$crop = $this->imageResized;
		//imagedestroy($this->imageResized);

		$this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
		imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
	}

	public function watermark($watermark_url = '', $right = '0', $bottom = '0') {

		$this->imageResized = $this->image;

		$image_info = getimagesize($watermark_url);
		$this->image_type = $image_info[2];
		if ($this->image_type == IMAGETYPE_JPEG) {
			$watermark = imagecreatefromjpeg($watermark_url);
		} elseif ($this->image_type == IMAGETYPE_GIF) {
			$watermark = imagecreatefromgif($watermark_url);
		} elseif ($this->image_type == IMAGETYPE_PNG) {
			$watermark = imagecreatefrompng($watermark_url);
		} else {
			//throw new Exception("The file you're trying to open is not supported");
		}

		// 워터마크를 정중앙으로
		$pos_x = ceil(($this->width - $image_info[0]) / 2);
		$pos_y = ceil($this->height - ($image_info[1] + 10));  //하단 10px;
		//$pos_y = ceil(($this->height - $image_info[1]) / 2);

		imagecopy($this->imageResized, $watermark, $pos_x, $pos_y, 0, 0, $image_info[0], $image_info[1]);
	}

	public function watermark2($watermark_url = '', $right = '0', $bottom = '0') {

		$this->imageResized = $this->image;

		$image_info = getimagesize($watermark_url);
		$this->image_type = $image_info[2];
		if ($this->image_type == IMAGETYPE_JPEG) {
			$watermark = imagecreatefromjpeg($watermark_url);
		} elseif ($this->image_type == IMAGETYPE_GIF) {
			$watermark = imagecreatefromgif($watermark_url);
		} elseif ($this->image_type == IMAGETYPE_PNG) {
			$watermark = imagecreatefrompng($watermark_url);
		} else {
			//throw new Exception("The file you're trying to open is not supported");
		}

		// 워터마크를 정중앙으로
		$pos_x = ceil(($this->width - $image_info[0]) / 2);
		$pos_y = ceil(($this->height - $image_info[1]) / 2);

		$watermark = imagecreatefrompng($watermark_url);

		$opacity = 100;

		imagecopymerge($this->imageResized, $watermark, $pos_x, $pos_y, 0, 0,$image_info[0], $image_info[1], $opacity); // 원본과 워터마크를 찍은 이미지를 적당한 투명도로 겹치기 
		//imagecopy($this->imageResized, $watermark, $pos_x, $pos_y, 0, 0, $image_info[0], $image_info[1], 90);
		//imagecopymerge($this->imageResized, $watermark, $pos_x, $pos_y, 0, 0, $image_info[0], $image_info[1], $opacity); 
	}

	public function showImage($imageQuality="100")
	{
		header('Content-Type: image/jpeg');
		imagejpeg($this->imageResized, NULL, $imageQuality);
		imagedestroy($this->imageResized);
	}
	
	public function saveImage($savePath, $imageQuality="100")
	{
		// *** Get extension		
		$extension = strrchr($savePath, '.');
		$extension = strtolower($extension);

		if(!empty($this->Orientation)) {
			switch($this->Orientation) {
				case 8:
					$this->imageResized = imagerotate($this->imageResized, 90, 0);
					break;
				case 3:
					$this->imageResized = imagerotate($this->imageResized, 180, 0);
					break;
				case 6:
					$this->imageResized = imagerotate($this->imageResized, -90, 0);
					break;
			}
		}


		switch($extension)
		{
			case '.jpg':
			case '.jpeg':
				if (imagetypes() & IMG_JPG) {
					imagejpeg($this->imageResized, $savePath, $imageQuality);
				}
				break;

			case '.gif':
				if (imagetypes() & IMG_GIF) {
					imagegif($this->imageResized, $savePath);
				}
				break;

			case '.png':
				// max = 9
				$scaleQuality = round(($imageQuality/100) * 9);
				$invertScaleQuality = 9 - $scaleQuality;
				if (imagetypes() & IMG_PNG) {
					 imagepng($this->imageResized, $savePath, $invertScaleQuality);
				}
				break;

			default:
				break;
		}

		imagedestroy($this->imageResized);
	}
}