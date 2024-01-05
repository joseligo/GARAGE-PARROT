let myList = document.getElementById("test");
let currentPage = 1;
console.log(currentPage);
let cardContainer = document.getElementById('card-car-container');



function getNbCars(){
    return new Promise(resolve => {
      let option = {
          headers: { "Content-Type": "application/json", Accept: "application/json" },
        };
        fetch(
          "./App/Api/CarsApibis.php?action=nbCars",
          option
        )
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
            resolve(nbCars = data.nbCars)
          }
    })
  })
}
function showCars(limit, page) {
  let option = {
    headers: { "Content-Type": "application/json", Accept: "application/json" },
  };
  fetch(
    "./App/Api/CarsApibis.php?action=showAllCars&limit=" +
      limit +
      "&page=" +
      page,
    option
  )
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
        setCarsInPage(data);
      }
    });
}
async function setCarsInPage(data) {
  // Afficher les voitures
  let nbCars = await getNbCars()
  let nbPage = nbCars / 6 + 1;

  cardContainer.innerHTML = "";
  
    data.forEach((element) => {
      createCard(element);
    });
  
  createPagination(nbPage);
}

function createCard(element) {
  let div1 = document.createElement('div');
  div1.className = "col-4 mb-3";
  cardContainer.appendChild(div1);
  let div2 = document.createElement('div');
  div2.className = "card shadow-sm";
  div1.appendChild(div2);
  let imgCar = document.createElement('img');
  imgCar.src = `./assets/images/uploads/${element.mainImage}`;
  div2.appendChild(imgCar);
  let div3 = document.createElement('div');
  div3.className = "card-body";
  div2.appendChild(div3);
  let cardTitle = document.createElement('h5');
  cardTitle.className = "card-title";
  cardTitle.textContent = `${element.title}`;
  div2.appendChild(cardTitle);
  let paragraphCar = document.createElement('p');
  paragraphCar.className = "card-text";
  paragraphCar.textContent = `${element.comment}`;
  div2.appendChild(paragraphCar);
  let buttonCar = document.createElement('button');
  buttonCar.className = "btn btn-primary";
  buttonCar.textContent =  "Voir le véhicule";
  div2.appendChild(buttonCar);
  let dateAnnonce = document.createElement('small');
  dateAnnonce.className = "text-body-secondary";
  dateAnnonce.textContent =  element.dateAnnonce;
  div2.appendChild(dateAnnonce);
}
async function createPagination(nbPage){
  let htmlPagination = "";
  for (let i = 1; i <= nbPage; i++) {
    if (i == currentPage) {
      htmlPagination +=
        `<button class="btn btn-lg btn-primary me-2 active btn${i}" disabled>` +
        i +
        "</button>";
    } else {
      htmlPagination +=
        `<button onclick="getCurrentPage(${i});showCars(6,` +
        i +
        ')" class="btn btn-lg btn-outline-dark me-2">' +
        i +
        "</button>";
    }
  }
  document.getElementById("pagination").innerHTML = htmlPagination;
}
function getCurrentPage(i){
  currentPage = i;
}
function showCarsFilter() {
  let formData = createFormData();
  let option = {
    method: "POST",
    body: formData,
  };
  fetch("App/Repository/CarsRepository.php?action=filter", option)
    .then((response) => {
      if (response.ok) {
        return response.text();
      }
      throw new Error("Something went wrong");
    })
    .then((data) => {
      if (data.length == 0) {
        myList.innerHTML =
          "<p>Toutes nos voitures ont trouvé preneur. N'hésitez pas à nous contacter, de nouvelles oportunités seront bientôt disponibles</p>";
      } else {
        myList.innerHTML = "";
        myList.innerHTML += data;
      }
    });
}

function createFormData() {
  let formFilter = document.getElementById("formFilter");
  formFilter = new FormData(formFilter);
  for (let key of formFilter.entries()) {
    console.log(key[0] + ", " + key[1]);
  }
  return formFilter;
}
