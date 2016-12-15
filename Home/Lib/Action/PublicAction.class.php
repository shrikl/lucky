<?php 
	class PublicAction extends Action{
		public function code() {
			import('ORG.Util.Image');
			Image::buildImageVerify(2, 1, 'png', 90, 20, 'code');
		}
	}
?>