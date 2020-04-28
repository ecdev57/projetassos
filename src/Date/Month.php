<?php
namespace agenda\Date;

use DateTime;

class Month {
    private $pmonthsYears =  ['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
    public $pdays   =  ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];  
    private $pmonth;
    private $pyear;
    private $timestamp;
    /**
     * Undocumented function
     *
     * @param integer $month le mois compris entre 1 et 12
     * @param integer $year
     * @throws \Exception
     */
    public function __construct( ?int $month = null, ?int $year = null)
    {
        if($month == null){
            $month = \intval(date('m'));
        }
        if($year == null){
            $year =  \intval(date('Y'));
        }
        if($month < 1 || $month >12){
            throw new \Exception("Le mois $month n'est pas valide");
        }
        if($year < 1970){
            throw new \Exception("L'année est inférieur à 1970");
        }
        $this->pmonth =$month;
        $this->pyear =$year;
        
    }
    /**
     * retoune le premier jour du mois
     * @return \Datetime
     */
    public function getfirstDay(){
        return new \DateTime("{$this->pyear}-{$this->pmonth}-01");
    }
    /**
     * retoune le mois en toute lettre Mars 2020
     * @return string
     */
    public function toString() {
       return $this->pmonthsYears[$this->pmonth -1].' '. $this->pyear;
    }
    /**
     * retoune le nombre de semaine de chaque mois
     * @return integer
    */
    public function getweeks() {
        $start = $this->getfirstDay();
        $end =(clone $start)->modify('+1 month -1 day');
        $weeks = \intval($end->format('W')) - \intval($start->format('W')) + 1;
        if($weeks <0){
            $weeks =\intval($end->format('W'));
        }
        return $weeks;
     }
    /**
    * Renvoie le mois en chiffre
    * @param [string] $monthStr le mois et l'anné a séparer
    * @return integer
    */
    public function changeMonthtoInt($monthStr){
            $mon= explode(' ', $monthStr);
            $m = ucfirst(strtolower(trim($mon[0])));
            switch ($m) {
                case "Janvier":        
                    $m = "01";
                    break;
                case "Fevrier":
                    $m = "02";
                    break;
                case "Mars":
                    $m = "03";
                    break;
                case "Avril":
                    $m = "04";
                    break;
                case "Mai":
                    $m = "05";
                    break;
                case "Juin":
                    $m = "06";
                    break;
                case "Juillet":        
                    $m = "07";
                    break;
                case "Août":
                    $m = "08";
                    break;
                case "Septembre":
                    $m = "09";
                    break;
                case "Octobre":
                    $m = "10";
                    break;
                case "Novembre":
                    $m = "11";
                    break;
                case "Decembre":
                    $m = "12";
                    break;
            }
            return $m;
            
    }
    // jour ferier liste fonction
    /**
     * Undocumented function
     *
     * @param [int] $an
     * @return array contenant le jour de paque
     */
    public function datepaque($an){

        $a =intdiv($an, 100);
        $b =$an % 100;
        $c =intdiv((3*($a+25)),4);
        $d =(3*($a+25))%4;
        $e =intdiv((8*($a+11)),25);
        $f =(5*$a+$b)%19;
        $g =(19*$f+$c-$e)%30;
        $h =intdiv(($f+11*$g),319);
        $j= intdiv((60*(5-$d)+$b),4);
        $k= (60*(5-$d)+$b)%4;
        $m =(2*$j-$k-$g+$h)%7;
        $n= intdiv(($g-$h+$m+114),31);
        $p= ($g-$h+$m+114)%31;
        $jour = $p+1;
        $mois =$n;
        return [$jour, $mois, $an];
    }

    /**
     * transfome une chaine en tableaux
     *
     * @param string $c corespond a la date a convertir c=13/04/2020
     * @param string $sep corsepond au separateur fournis par defaut sep =/
     * @return array retoune la chaine '13/04/2020' en tableau [13,04,2020]
     */
    public function dateList($c)
    {
        # code...
        $j= $c[0];
        $m= $c[1];
        $a= $c[2];
        return [intval($j),intval($m), intval($a)];
    }
    /**
     * transfome un tableaux en chaine
     *
     * @param array $d corespond a la date a convertir c=13/04/2020
     * @param string $sep corsepond au separateur fournis par defaut sep =/
     * @return string retoune un tableau [13,04,2020]  en chaine '13/04/2020'
     */
    public function dateChaine($d, $sep = '/')
    {
        $comma_separated = implode($sep, $d);

        return $comma_separated;
      // ("%02d"+ $sep +"%02d"+  $sep +"%02d" + $sep + "%0004d") % ($d[0]. $d[1]. $d[1]);
    }

    /**
     * Undocumented function
     *
     * @param string $paq contien lea date de paque
     * @param integer $contmoredauy jour à afficher en plus
     * @return array date calculer
     */
    public function Daycalal($paq, $op, $contmoredauy)
    {
       $rest = explode("/", $paq);
        if ($op == "+") {
            $date_debut = $rest[2].'/'.$rest[1].'/'.$rest[0];
            $date_fin = date('d/m/y', strtotime( $date_debut .' +'. $contmoredauy .'days'));
        }
        if ($op == "-") {
            $date_debut = $rest[2].'-'.$rest[1].'-'.$rest[0];
            $date_fin = date('d/m/y', strtotime( $date_debut .' -'. $contmoredauy .'days'));
        }
        
        return $date_fin ;

    }
    /**
     * calculer et affichert les jours ferier
     * @param string $an
     * @param integer $sd defini les jpour à afficher 0=luxembourg, 1=moselle et 2 france
     * @return array des jours ferier en fonctionde sd
     */
    public function listBankholidays($an, $sd=0){

        $dp =$this->dateChaine($this->datepaque($an));// jours de paque
        //jour ferier luxembourg sd =0
        if ($sd == 0) {
            // jour ferier fixe
                //jour de l'an
                $d =[1,1,$an]; 
                $e=$this->dateChaine($d,'/');
                $t = "Jour de l'an";
                //Fête du travail
                $d1 =[1,5,$an]; 
                $e1=$this->dateChaine($d1,'/');
                $t1 = "Fête du travail";
                //Journée de l’Europe
                $d2= [9,5,$an];
                $e2=$this->dateChaine($d2,'/');
                $t2 = "Journée de l’Europe";
                //Fête Nationnale
                $d3= [23,6,$an];
                $e3=$this->dateChaine($d3,'/');
                $t3 = "Fête nationale";
                //Toussaint
                $d4= [1,11,$an];
                $e4=$this->dateChaine($d4,'/');
                $t4 = "Toussaint";
                //Noel
                $d5= [25,12,$an];
                $e5=$this->dateChaine($d5,'/');
                $t5 = "Noël";
                //St.Etienne
                $d6= [26,12,$an];
                $e6=$this->dateChaine($d6,'/');
                $t6 = "St.Etienne";
                //Assomption
                $d7= [26,12,$an];
                $e7=$this->dateChaine($d7,'/');
                $t7 = "Assomption";
            // jour ferier aléatoire
                //Lundi Pâques
                $d8 = $this->Daycalal($dp, '+',1);
                $e8 = $d8;
                $t8 = "Lundi Pâques";
               
               //Jeudi de l'ascension
                $d9= $this->Daycalal($dp, '+',39);
                $e9=$d9;
                $t9 = "Ascension";
                //Dimanche Pâques
                $t10 ="Dimanche Pâques";
                //Lundi de Pentcôte
                $d11= $this->Daycalal($dp, '+',1);
                $e11=$d11;
                $t11 = "Lundi de Pâques";
                // table days holly
               return  array(
                    $e => $t,
                    $e1 => $t1,
                    $e2 => $t2, 
                    $e3 => $t3,
                    $e4 => $t4,
                    $e5 => $t5, 
                    $e6 => $t6, 
                    $e7 => $t7,
                    $e8 => $t8, 
                    $e9 => $t9, 
                    $dp => $t10,
                    $e11 => $t11, 
                );  
        }
         
        
                
        }
        function array_isearch($str, $array) {
            $found = array();
            foreach($array as $k => $v)
              if(strtolower($v) == strtolower($str)) $found[] = $k;
            return $found;
          }
          
               // array_push($result, key($array));
        
            
        }
    
      
