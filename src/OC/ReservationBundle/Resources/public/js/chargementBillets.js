$(document).ready(function() 
{
	// On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
	var $container = $('div#commande_billet_billets');

	// On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
	var index = $container.find(':input').length;

	var number = 0;

	if(index == 0)
	{
		//On appelle commande.nbBillets fois lea fonction addBillet
		while (number < {{ commande.nbBillets }}) 
		{
			addBillet($container);
			number++;
		}
	}
	

	// La fonction qui ajoute un formulaire BilletType
	function addBillet($container) 
	{
		// Dans le contenu de l'attribut « data-prototype », on remplace :
		// - le texte "__name__label__" qu'il contient par le label du champ
		// - le texte "__name__" qu'il contient par le numéro du champ
		var template = $container.attr('data-prototype')
		.replace(/__name__label__/g, 'Billet label')
		.replace(/__name__/g,        index)
		;

		// On crée un objet jquery qui contient ce template
		var $prototype = $(template);

		// On ajoute le prototype modifié à la fin de la balise <div>
		$container.append($prototype);

		// Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
		index++;
	}

});