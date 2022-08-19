<?php
	// Vista.php
	class Vista {
		public $ancho, $alto, $altura, $mitad, $resta, $ele, $ele2, $n;
		public $m, $m2, $a, $b, $c, $d, $e, $f;
		public $xf, $yf;
		public $x, $y, $mx, $yx, $mx2, $yx2, $x2, $x3;
		public function __construct($an, $al, $n){
			$this->ancho = $an;
			$this->alto = $al;
			$this->n = $n;
		}
		public function dibujar($modelo){
			$img = imagecreate($this->ancho, $this->alto);
			$blanco = imagecolorallocate($img, 255, 255, 255);
			$negro = imagecolorallocate($img, 0, 0, 0);
			imagefilledrectangle($img, 0, 0, 400, 400, $blanco);
			$ap = array(
				$modelo->punto1->x, $modelo->punto1->y,
				$modelo->punto2->x, $modelo->punto2->y,
				$modelo->punto3->x, $modelo->punto3->y
			);
			imagepolygon($img, $ap, 3, $negro);
			imagestring($img, 1, $modelo->pmLado1->x + 5, $modelo->pmLado1->y, "L1=" . round($modelo->lado1,2), $negro);
			imagestring($img, 1, $modelo->pmLado2->x, $modelo->pmLado2->y, "L2=" . round($modelo->lado2,2), $negro);
			imagestring($img, 1, $modelo->pmLado3->x + 15 , $modelo->pmLado3->y, "L3=" . round($modelo->lado3,2), $negro);

			if($this->n == 1){
				imagestring($img, 1, 400, 400, "xO= " . round($modelo->punto1->x, 2) . " yO= " . round($modelo->punto1->y, 2), $negro);
				imagestring($img, 1, 400, 360, "x1= " . round($modelo->punto2->x, 2) . " y1= " . round($modelo->punto2->y, 2), $negro);
				imagestring($img, 1, 400, 380, "x2= " . round($modelo->punto3->x, 2) . " y2= " . round($modelo->punto3->y,2), $negro);
			}else if($this->n == 2){
				imagestring($img, 1, 400, 400, "xO= " . round($modelo->punto1->x, 2) . " yO= " . round($modelo->punto2->y, 2), $negro);
				imagestring($img, 1, 400, 360, "x1= " . round($modelo->punto2->x, 2) . " y1= " . round($modelo->punto1->y, 2), $negro);
				imagestring($img, 1, 400, 380, "x2= " . round($modelo->punto3->x, 2) . " y2= " . round($modelo->punto3->y,2), $negro);
			}else if($this->n == 3){
				imagestring($img, 1, 400, 400, "xO= " . round($modelo->punto3->x, 2) . " yO= " . round($modelo->punto3->y,2), $negro);
				imagestring($img, 1, 400, 360, "x1= " . round($modelo->punto1->x, 2) . " y1= " . round($modelo->punto1->y, 2), $negro);
				imagestring($img, 1, 400, 380, "x2= " . round($modelo->punto2->x, 2) . " y2= " . round($modelo->punto2->y, 2), $negro);
			}else{	

			}

			if($modelo->lado1 != $modelo->lado2 && $modelo->lado1 != $modelo->lado3 && $modelo->lado3 != $modelo->lado2){
				if($this->n == 1){
					$this->altura = ($modelo->lado1 * $modelo->lado3) / $modelo->lado2;
					imagestring($img, 1, 400, 230, "La altura es " . round($this->altura, 2), $negro);
				}else if($this->n == 2){
					$this->altura = ($modelo->lado1 * $modelo->lado2) / $modelo->lado3;
					imagestring($img, 1, 400, 230, "La altura es " . round($this->altura, 2), $negro);
				}else if($this->n == 3){
					$this->altura = ($modelo->lado3 * $modelo->lado2) / $modelo->lado1;
					imagestring($img, 1, 400, 230, "La altura es " . round($this->altura, 2), $negro);
				}else{
					imagestring($img, 1, 400, 230, "Selecciona el punto", $negro);
				}
			}else if($modelo->lado1 == $modelo->lado2 || $modelo->lado1 == $modelo->lado3 || $modelo->lado3 == $modelo->lado2){
				if($this->n == 1 || $this->n == 3){
					$this->altura = ($modelo->lado1 * $modelo->lado3) / $modelo->lado2;
					imagestring($img, 1, 400, 230, "La altura es " . round($this->altura, 2), $negro);
				}else if($this->n == 2){
					$this->mitad = $modelo->lado3/2;
					$this->ele = pow($modelo->lado1, 2);
					$this->ele2	 = pow($this->mitad, 2);
					$this->resta = $this->ele -$this->ele2;
					$this->altura = sqrt($this->resta); 
					imagestring($img, 1, 400, 230, "La altura es " . round($this->altura, 2), $negro);
				}else{
					imagestring($img, 1, 400, 230, "Selecciona el punto", $negro);
				}
			}else if($modelo->lado1 == $modelo->lado2 && $modelo->lado1 == $modelo->lado3 && $modelo->lado3 == $modelo->lado2){
				$this->mitad = $modelo->lado3/2;
				$this->ele = pow($modelo->lado1, 2);
				$this->ele2	 = pow($this->mitad, 2);
				$this->resta = $this->ele -$this->ele2;
				$this->altura = sqrt($this->resta); 
				imagestring($img, 1, 400, 230, "La altura es " . round($this->altura, 2), $negro);
			}else{
				imagestring($img, 1, 400, 230, "No es triangulo", $negro);
			}

			imagestring($img, 1, $modelo->punto1->x, $modelo->punto1->y, "P1", $negro);
			imagestring($img, 1, $modelo->punto2->x, $modelo->punto2->y - 15, "P2", $negro);
			imagestring($img, 1, $modelo->punto3->x - 15, $modelo->punto3->y, "P3", $negro);

			if($this->n == 1){
				$this->m = (($modelo->punto3->y - $modelo->punto2->y)/($modelo->punto3->x - $modelo->punto2->x));
				imagestring($img, 1, 400, 280, "La pendiente es " . round($this->m, 2), $negro);
				$this->m2 = (-1/$this->m);
				imagestring($img, 1, 400, 300, "Segunda pendiente " . round($this->m2, 2), $negro);
			}else if($this->n == 2){
				$this->m = (($modelo->punto3->y - $modelo->punto1->y)/($modelo->punto3->x - $modelo->punto1->x));
				imagestring($img, 1, 400, 280, "La pendiente es " . round($this->m, 2), $negro);
				$this->m2 = (-1/$this->m);
				imagestring($img, 1, 400, 300, "Segunda pendiente " . round($this->m2, 2), $negro);
			}else if($this->n == 3){
				$this->m = (($modelo->punto2->y - $modelo->punto1->y)/($modelo->punto2->x - $modelo->punto1->x));
				imagestring($img, 1, 400, 280, "La pendiente es " . round($this->m, 2), $negro);
				$this->m2 = (-1/$this->m);
				imagestring($img, 1, 400, 300, "Segunda pendiente " . round($this->m2, 2), $negro);
			}else{
				imagestring($img, 1, 400, 280, "No es triangulo", $negro);
			}
			$this->a = round($this->m, 2) * -1;
            $this->b = 1;
            $this->d = -$this->m2;
            $this->e = 1;

			if($this->n == 1){
				$this->c = (-1 * $this->m * $modelo->punto2->x) + $modelo->punto2->y;
				$this->f = $modelo->punto1->y - ($this->m2 * $modelo->punto1->x);
				imagestring($img, 1, 400, 320, "a=" . $this->a . " b=" . $this->b . " c=" . $this->c, $negro);
				imagestring($img, 1, 400, 340, "d=" . $this->d . " e=" . $this->e . " f=" . $this->f, $negro);
			}else if($this->n == 2){
				$this->c = (-1 * $this->m * $modelo->punto1->x) + $modelo->punto1->y;
				$this->f = $modelo->punto2->y - ($this->m2 * $modelo->punto2->x);
				imagestring($img, 1, 400, 320, "a=" . $this->a . " b=" . $this->b . " c=" . $this->c, $negro);
				imagestring($img, 1, 400, 340, "d=" . $this->d . " e=" . $this->e . " f=" . $this->f, $negro);
			}else if($this->n == 3){
				$this->c = (-1 * $this->m * $modelo->punto1->x) + $modelo->punto1->y;
				$this->f = $modelo->punto3->y - ($this->m2 * $modelo->punto3->x);
				imagestring($img, 1, 400, 320, "a=" . $this->a . " b=" . $this->b . " c=" . $this->c, $negro);
				imagestring($img, 1, 400, 340, "d=" . $this->d . " e=" . $this->e . " f=" . $this->f, $negro);
			}else{
				imagestring($img, 1, 400, 320, "No es triangulo", $negro);
			}

			$this->yf = ($this->f-(($this->d*$this->c)/$this->a))/((-$this->d*$this->b/$this->a)+$this->e);
			$this->xf = ($this->c-($this->b*$this->yf))/$this->a;
			//$this->yf = (-400-((-2*400)/0.5))/((2*1/0.5)+1);
			//$this->xf = (400-(1*$this->yf))/0.5;

			imagestring($img, 1, 400, 420, "xF=" . round($this->xf, 2) . " yF=" . round($this->yf, 2), $negro);
			imagestring($img, 1, $this->xf, $this->yf, "PF", $negro);
			
			if($this->n == 1){
				imageline($img, $modelo->punto1->x, $modelo->punto1->y, $this->xf, $this->yf, $negro);
			}else if($this->n == 2){
				imageline($img, $modelo->punto2->x, $modelo->punto2->y, $this->xf, $this->yf, $negro);
			}else if($this->n == 3){
				imageline($img, $modelo->punto3->x, $modelo->punto3->y, $this->xf, $this->yf, $negro);
			}

			imagepng($img);
			imagedestroy($img);
		}
	}
?>