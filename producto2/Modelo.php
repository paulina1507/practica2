<?php
	// Modelo.php 
	class Modelo {
		public $punto1, $punto2, $punto3;
		public $lado1, $lado2, $lado3;
		public $pmLado1, $pmLado2, $pmLado3;
		public function __construct($p1, $p2, $p3){
			$this->punto1 = $p1;
			$this->punto2 = $p2;
			$this->punto3 = $p3;
			$this->calcularLados();
			$this->calcularPuntosMedios();
		}
		private function calcularLados(){
			// La distancia d entre dos puntos P1(x1, y1) y P2(x2, y2) está dada por la fórmula:
			// d = RaízCuadrada( (x1-x2)(x1-x2) + (y1-y2)(y1-y2) ) 
			$this->lado1 = sqrt( pow($this->punto1->x-$this->punto2->x, 2) + pow($this->punto1->y-$this->punto2->y, 2) ); // de P1 a P2
			$this->lado2 = sqrt( pow($this->punto2->x-$this->punto3->x, 2) + pow($this->punto2->y-$this->punto3->y, 2) ); // de P2 a P3
			$this->lado3 = sqrt( pow($this->punto1->x-$this->punto3->x, 2) + pow($this->punto1->y-$this->punto3->y, 2) ); // de P1 a P3 
		}
		private function calcularPuntosMedios(){
			// Las coordenadas del punto medio Pm(x, y) de un segmento dirigido cuyos puntos extremos son P1(x1, y1) y P2(x2, y2) son
			// x=(x1+x2)/2,	y=(y1+y2)/2
			$this->pmLado1 = new Punto( ($this->punto1->x+$this->punto2->x)/2, ($this->punto1->y+$this->punto2->y)/2 ); // de P1 a P2
			$this->pmLado2 = new Punto( ($this->punto2->x+$this->punto3->x)/2, ($this->punto2->y+$this->punto3->y)/2 ); // de P2 a P3
			$this->pmLado3 = new Punto( ($this->punto1->x+$this->punto3->x)/2, ($this->punto1->y+$this->punto3->y)/2 ); // de P1 a P3
		}
	}
?>