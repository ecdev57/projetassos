<?php
//Appel de la classe Month.php pour pouvoir appeler les méthodes dans index.php
use agenda\Date\Month;
?>
<!DOCTYPE html>
<!--[if lte IE 7]> <html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!-->
<html class="no-js" lang="fr">
<!--<![endif]-->

<head>
<meta charset="UTF-8">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="http://www.cssscript.com/wp-includes/css/sticky.css"
	rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/agenda.css">



</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="#">La bonne nouvelle </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarCollapse" aria-controls="navbarCollapse"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a class="nav-link" href="#">Home <span
						class="sr-only">(current)</span></a></li>
				<li class="nav-item"><a class="nav-link" href="#">Link</a></li>
				<li class="nav-item"><a class="nav-link disabled" href="#"
					tabindex="-1" aria-disabled="true">Disabled</a></li>
			</ul>
			<!-- abinguid = c'est l'option donotrackme de safari (macos) => inutile ici (abineguid="127CCB437C5D454B831DBEAD4626B5B3) -->
			<form class="form-inline mt-2 mt-md-0" action="">
				<input class="form-control mr-sm-2" type="text" placeholder="Search"
					aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav>
	<br>
	<br>
	<br>
	<main role="main" class="test">

           <?php
               //require "../src/Date/Month.php";
               $month = new Month($_GET['month'] ?? null,$_GET['year'] ?? null);
               $fday= $month->getfirstDay()->modify('last monday');
           ?>
           <table>
           <?php for($i=0; $i<$month->getweeks(); $i ++): ?>

    <thead>
				<tr>
      <?php foreach($month->pdays as $k => $d): ?>
        <th scope="col">Lundi</th>
					<th scope="col">Mardi</th>
					<th scope="col">Mercredi</th>
					<th scope="col">Jeudi</th>
					<th scope="col">Vendredi</th>
					<th scope="col">Samedi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<!-- <li v-for='(user, index) in sortedCats '> -->
					<td scope="row" data-label="Nom">{{ user.name }}</td>
					<td data-label="Prénom">{{ user.username }}</td>
					<td data-label="Email">{{ user.email }}</td>
					<td data-label="Rôle">{{ user.role }}</td>
					<td data-label="Rôle">{{ user.send }}</td>
					<td data-label="Administration">
						<button type="button" class="btn btn-primary" data-toggle="modal"
							data-target="#myModal" Onclick="editeruser(index, user.id)">
							Modifier</button>
						<button type="button" class="btn btn-danger"
							Onclick="removeElement(user.id,user.name)">Supprimer</button>
					</td>
					<!-- 					</li> -->
				</tr>
			</tbody>
		</table>
		<header>
			<h1><?php $month->toString(); ?></h1>
		</header>


		<table
			class="calendar__table calendar__table--&lt;?= $month-&gt;getweeks();?&gt; weeks">
                    <?php for($i=0; $i<$month->getweeks(); $i ++): ?>
                        <?php foreach($month->pdays as $k => $d): ?>
                        <tr>

				<td>
                                <?php if( $i === 0):?>
                                    <div class="calendar__weekday">
                                <?php endif; ?>

                                 <?php $d; ?>
                                </div>
					<div class="calendar__day"><?php (clone $fday)->modify("+". ($k + $i *7). "days")->format('d');?></div>
				</td>
                            <!--<?php endforeach;?>-->
                        </tr>
                    <!--<?php endfor;?>-->
                </table>


                <?php

 $larg = "<script language='Javascript'> document.write(window.innerWidth); </script>"; //obtenir largeur fenetre

 echo $larg; // affiche la largeur de la fenetre


 ?>


	</main>

</body>
<?php endforeach;?>
<?php endfor;?>
</html>