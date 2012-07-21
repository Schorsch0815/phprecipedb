<?php

class IngredientStepTest extends CTestCase
{

    public function testSplit()
    {
        $step = new IngredientStep;

        $step->ingredients = "5 m.-große 	Tomate(n)
                2 Dose/n 	Thunfisch, (naturell oder in Öl)
                1 große 	Zwiebel(n)
                1 Bund 	Petersilie
                3 EL 	Olivenöl
                1 Prise 	Zucker
                n. B. 	Pfeffer
                n. B. 	Salz

                ";
        $splitArray = $step->parseIngredients();

        for ($i = 0; $i < sizeof($splitArray); ++$i) {
            for ($j = 1; $j < sizeof($splitArray[$i]); ++$j) {
                printf(">>%s<<  ", $splitArray[$i][$j]);
            }
            echo "\n";
        }

        $step->ingredients = "700 g Rindfleisch
                400 g Zwiebeln
                2 EL Öl
                1 EL Tomatenmark
                750 ml Geflügelbrühe
                0,5 Stk. Paprikaschote, gelb
                0,5 Stk. Paprikaschote, rot
                0,5 Stk. Zucchini
                400 g Kartoffeln
                1 EL Paprikapulver, edelsüß
                1 TL Cayennepfeffer
                1 Prise(n) Salz
                2 Blatt Lorbeer
                1 Scheibe(n) Zitronenschale
                2 Scheibe(n) Knoblauchzehen
                0,5 TL Kümmel, ganz
                0,5 TL Majoran
                2 EL Petersilie, glatt
                2 Eier";

        $splitArray = $step->parseIngredients();

        for ($i = 0; $i < sizeof($splitArray); ++$i) {
            for ($j = 1; $j < sizeof($splitArray[$i]); ++$j) {
                printf(">>%s<<  ", $splitArray[$i][$j]);
            }
            echo "\n";
        }

        $step->ingredients = "    	Teig:
                500 g 	Mehl
                10 g 	Trockenhefe
                10 g 	Salz
                300 ml 	Wasser, lauwarm
                1/2 TL 	Staubzucker
                Belag:
                2 St 	Zwiebeln
                2 EL 	Olivenöl
                200 g 	Quark
                80 g 	Creme fraîche
                150 g 	Bauchspeck, mager
                2 St 	Eigelbe
                1 Prise 	Muskatnuss
                Salz, Pfeffer aus der Mühle
                2 Eier";

        $splitArray = $step->parseIngredients();

        for ($i = 0; $i < sizeof($splitArray); ++$i) {
            for ($j = 1; $j < sizeof($splitArray[$i]); ++$j) {
                printf(">>%s<<  ", $splitArray[$i][$j]);
            }
            echo "\n";
        }
    }

    public function testValidate()
    {
        $step = new IngredientStep;

        $step->ingredients = "    	Teig:
                500 g 	Mehl
                10 g 	Trockenhefe
                10 g 	Salz
                300 ml 	Wasser, lauwarm
                1/2 TL 	Staubzucker
                Belag:
                2 St 	Zwiebeln
                2 EL 	Olivenöl
                200 g 	Quark
                80 g 	Creme fraîche
                150 g 	Bauchspeck, mager
                2 St 	Eigelbe
                1 Prise 	Muskatnuss
                Salz, Pfeffer aus der Mühle";

        $step->validateIngredients();

        $step->ingredients = "

                500 g 	Mehl

                10 g 	Trockenhefe
                500 g 	Hackfleisch
                500 g 	Hühnerfilet
                500 g 	Hühnchen
                500 g 	Huhn
                2 Eier
                \t
                \t\t\t\v";

        $step->validateIngredients();

    }
}
