fetch("./App/Api/CarsApi.php?action=minMax")
    .then((response) => {
      if (response.ok) {
        return response.json();
      }
      throw new Error("Something went wrong");
    })
    .then((data) => {
      if (data.length == 0) {
        myList.innerHTML =
          "<p>Toutes nos voitures ont trouvé preneur. N'hésitez pas à nous contacter, de nouvelles oportunités seront bientôt disponibles</p>";
      } else {
				showCars(6,1);
        setDoubleRange({
					element: '#doubleRange',
					type: 'Price',
					minValue: data.minPrice,
					maxValue: data.maxPrice,
					maxInfinite: false,
					stepValue: 1000,
					defaultMinValue: data.minPrice,
					defaultMaxValue: data.maxPrice,
					unite: '€'
				});
				setDoubleRange({
					element: '#doubleRange2',
					type: 'Km',
					minValue: data.minKm,
					maxValue: data.maxKm,
					maxInfinite: false,
					stepValue: 10000,
					defaultMinValue: data.minKm,
					defaultMaxValue: data.maxKm,
					unite: 'km'
				});
				setDoubleRange({
					element: '#doubleRange3',
					type: 'Year',
					minValue: data.minYear,
					maxValue: data.maxYear,
					maxInfinite: false,
					stepValue: 10,
					defaultMinValue: data.minYear,
					defaultMaxValue: data.maxYear,
					unite: ''
				});
      }
		})

function setDoubleRange(configDoubleRange)
{
	//Configuration du mobule :
	var classOrIDDoubleRange = configDoubleRange.element;
	let type = configDoubleRange.type;
	var minValue = configDoubleRange.minValue;
	var maxValue = configDoubleRange.maxValue;
	var maxInfinite = configDoubleRange.maxInfinite;
	var stepValue = configDoubleRange.stepValue;
	var unite = configDoubleRange.unite;
	var defaultMinValue = configDoubleRange.defaultMinValue;
	var defaultMaxValue = configDoubleRange.defaultMaxValue;

	var doubleRange = document.querySelector(classOrIDDoubleRange);
	var barre = doubleRange.querySelector(`.barre${type}`);
	var barreMilieu = doubleRange.querySelector(`.barreMilieu${type}`);
	var thumb1 = doubleRange.querySelector(`.t1${type}`);
	var thumb2 = doubleRange.querySelector(`.t2${type}`);

	var draggable = false;
	var targetToMove = false;
	var largeurBarre = barre.scrollWidth;
	var margeLeftBarre = barre.getBoundingClientRect().left;

	//Le mousemove est détecté sur la div contenant tout le double range pour éviter les pertes de suivis si la souris sort du thumb
	//Detection de la souris pour les ordinateurs :
	thumb1.addEventListener("mousedown", dragStart, false);
	thumb2.addEventListener("mousedown", dragStart, false);
	doubleRange.addEventListener("mousemove", drag, false);
	doubleRange.addEventListener("mousedown", clickBar, false);
	document.addEventListener("mouseup", dragStop, false);

	//Detection du tactile pour les téléphone/tablettes... :
	thumb1.addEventListener("touchstart", dragStart, { passive: true}, false);
	thumb2.addEventListener("touchstart", dragStart, { passive: true}, false);
	doubleRange.addEventListener("touchmove", drag, { passive: true}, false);
	doubleRange.addEventListener("touchstart", clickBar, { passive: true}, false);
	document.addEventListener("touchend", dragStop, { passive: true}, false);
	
	setDefaultValues();
	
	function dragStart(e){ draggable = true; targetToMove = e.target.className.split(' ')[0]; largeurBarre = barre.scrollWidth; margeLeftBarre = barre.getBoundingClientRect().left; }
	function dragStop(){ if(!draggable){return false} else {draggable = false; targetToMove = false; createFormData(); showCarsFilter()}}

	function drag(e)
	{
		if(draggable && targetToMove != false)
		{
			var thumbToMove = doubleRange.querySelector('.'+targetToMove);
			//Detection de la position X de la souris :
			var x = e.clientX;
			//Detection de la position X pour le tactile :
			if(e.type === 'touchmove'){ x = e.touches[0].clientX; }

			var pourcentage = ((x-margeLeftBarre)*100)/largeurBarre;

			if(pourcentage <= 0) {pourcentage=0}
			if(pourcentage > 100){pourcentage=100}

			//Déplacement du thumb :
			thumbToMove.style.left = pourcentage+'%';
			
			//Mise à jour de la barre du milieu et des labels :
			majBarreMilieuETLabels();
		}
	}
	
	function clickBar(e)
	{
		//Detection de la position X de la souris :
		var x = e.clientX;
		console.log(x);
		//Detection de la position X pour le tactile :
		if(e.type === 'touchmove'){ x = e.touches[0].clientX; }

		let pourcentage = ((x-margeLeftBarre)*100)/largeurBarre;
		if(pourcentage< 0) {pourcentage = 0};
		if(pourcentage > 100) {pourcentage = 100}

		//Detection du thumb le plus proche :
		var percentThumb1 = parseInt(thumb1.style.left);
		var percentThumb2 = parseInt(thumb2.style.left);
		console.log(percentThumb1)
		console.log(percentThumb2)
		if(Math.abs(percentThumb1-pourcentage) <= Math.abs(percentThumb2-pourcentage))
		{
			thumb1.style.left = pourcentage+'%';
		}
		else
		{
			thumb2.style.left = pourcentage+'%';
		}
		
		//Mise à jour de la barre du milieu et des labels :
		majBarreMilieuETLabels();
	}
	
	function setDefaultValues()
	{
		if(typeof defaultMinValue === 'undefined' || typeof defaultMaxValue === 'undefined'){ return false; }
		if(defaultMinValue < minValue || defaultMinValue > maxValue || defaultMaxValue < minValue || defaultMaxValue > maxValue){ return false; }

		thumb1.style.left = convertionValueToPercent(defaultMinValue)+'%';
		thumb2.style.left = convertionValueToPercent(defaultMaxValue)+'%';
		majBarreMilieuETLabels();
		//Rechargement des cards
	}

	function majBarreMilieuETLabels()
	{
		var pourcentageT1 = parseFloat(thumb1.style.left);
		var pourcentageT2 = parseFloat(thumb2.style.left);
		var labelMin = doubleRange.querySelector('.labelMin');
		var labelMax = doubleRange.querySelector('.labelMax');
		var inputMin = doubleRange.querySelector('.inputMin');
		var inputMax = doubleRange.querySelector('.inputMax');

		//Detection du pourcentage le plus petit et le plus grand, car les thumbs peuvent se croiser :
		let pourcentageMin = 0;
		let pourcentageMax = 0;
		if(pourcentageT1 <= pourcentageT2){ pourcentageMin = pourcentageT1; pourcentageMax = pourcentageT2; }
		else{ pourcentageMin = pourcentageT2; pourcentageMax = pourcentageT1; }
		if(pourcentageMin < 0) {pourcentageMin = 0}
		if(pourcentageMax > 100) {pourcentageMax = 100}

		//Mise à jour de la position de la barre du milieu
		barreMilieu.style.left = pourcentageMin+'%';
		barreMilieu.style.width = (pourcentageMax-pourcentageMin)+'%';

		//Mise à jour des labels :
		labelMin.textContent = convertionPercentToValue(pourcentageMin, true);
		labelMax.textContent = convertionPercentToValue(pourcentageMax, false);

		//Mise à jour des inputs :
		inputMin.value = convertionPercentToValue(pourcentageMin, true, false);
		inputMax.value = convertionPercentToValue(pourcentageMax, false, false);

		//Gestion du maxInfinite (remplace la valeur du max par l'infini) :
		if(pourcentageMax > 99 && maxInfinite == true){ labelMax.textContent = '∞'; inputMax.value = ''; }

		
	}

	function convertionPercentToValue(pourcentage, arrondmin = true, afficherUnite = true)
	{
		//Converti le pourcentage en valeur par rapport au minValue et maxValue :
		var resPFV = ((pourcentage*(maxValue-minValue))/100)+minValue;
		//Arrondie la valeur par rapport au chiffre stepValue :
		if (arrondmin) {resPFV = Math.floor(resPFV/stepValue)*stepValue;}
		else {resPFV = Math.ceil(resPFV/stepValue)*stepValue;}
		
		//Ajoute l'unité :
		if(afficherUnite){ resPFV = resPFV+' '+unite; }

		return resPFV;
	}
	
	function convertionValueToPercent(value)
	{
		var resPercent = ((value-minValue)*100)/(maxValue-minValue);

		return resPercent;
	}
}