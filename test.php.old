<!DOCTYPE html>
<!--[if lte IE 7]> <html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!--><html class="no-js" lang="fr"> <!--<![endif]-->
<html>
    <head>
        <meta charset="UTF-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
        		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="http://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/agenda.css">
        <?php
            $larg = "<script language='Javascript'> document.write(window.innerWidth); </script>"; //obtenir largeur fenetre
            
        ?>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">La bonne nouvelle </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                </ul>
                <form class="form-inline mt-2 mt-md-0" abineguid="127CCB437C5D454B831DBEAD4626B5B3">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
<br>
<br>
<br>
<br>
<?php 
    require "../src/Date/Month.php";
    $month = new agenda\Date\Month($_GET['month'] ?? null,$_GET['year'] ?? null); 
    $fday= $month->getfirstDay()->modify('last monday');       
?> 
              <header>
                    <h1><?= $month->toString(); ?></h1>
                </header>
        <table>
        <?php for($i=0; $i<$month->getweeks(); $i ++): ?>
            <thead>
            <tr>
            <?php foreach($month->pdays as $k => $d): ?>
                <?php if($larg > "899px" &&  $i === 0):?>
                <th scope="col"><?= $d; ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php foreach($month->pdays as $k => $d): ?>
                    <td scope="row" data-label="<?= $d; ?>">
                    <?php 
                            $jjdate =(clone $fday)->modify("+". ($k + $i *7). "days")->format('d');
                            $monthyear = $month->toString();
                            $mon= explode(' ', $monthyear);
                            $expyear = $mon[1];
                            $monthint = $month->changeMonthtoInt($monthyear);
                    ?>
                    <?php if($d ==='Lundi'): ?>
                        <div class="calendar__day">
                            <?= (clone $fday)->modify("+". ($k + $i *7). "days")->format('d');?>
                           <div style="color: red">
                            <?php if($jjdate === '29' || $jjdate === '30' || $jjdate === '31'): ?>
                                <?= "Semaine ",date('W', strtotime($expyear.'-'.($monthint-1).'-'.$jjdate)); ?>
                             <?php else: ?>
                                <?= "Semaine ",date('W',strtotime($expyear.'-'.$monthint.'-'.$jjdate)); ?>
                            <?php endif; ?>
                    <?php else: ?>
                        <?= (clone $fday)->modify("+". ($k + $i *7). "days")->format('d');?>
                        </div> 
                    <?php endif; ?>
                      
                
                        </div>
                        <div>

                        <?php 
                        $test =$month->listBankholidays($expyear); 
                      var_dump($test);
                      $month->isholidays();
                       // echo $month->Daycalal($paq,"+", 39);
                     
                        
                        ?>
                        </div> 
                        <?php endforeach; ?> 
                        </td>
                   
                
            </tr>
            </tbody>
            <?php endfor; ?>
        </table>