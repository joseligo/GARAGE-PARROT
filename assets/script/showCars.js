let myList = document.getElementById("test");

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
  // let option = {
  //   headers: { "Content-Type": "application/json", Accept: "application/json" },
  // };
  // const response = fetch("./App/Api/CarsApibis.php?action=nbCars",option);

  // if (!response.ok) {
  //   const message = `An error has occured: ${response.status}`;
  //   throw new Error(message);
  // }

  // const nbCars = response.json();
  // console.log(nbCars.nbCars);
  // return nbCars;

  // let option = {
  //   headers: { "Content-Type": "application/json", Accept: "application/json" },
  // };
  // await fetch(
  //   "./App/Api/CarsApibis.php?action=nbCars",
  //   option
  // )
  // .then((response) => {
  //   if (response.ok) {
  //     return response.json();
  //   }
  //   throw new Error("Something went wrong");
  // })
  // .then((data) => {
  //   if (data.length == 0) {
  //     myList.innerHTML =
  //       "<p>Toutes nos voitures ont trouvé preneur. N'hésitez pas à nous contacter, de nouvelles oportunités seront bientôt disponibles</p>";
  //   } else {
  //     nbCars = data.nbCars
  //     return nbCars;
  //   }
  // });


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
  let cardContainer = document.getElementById('card-car-container');
  cardContainer.innerHTML = "";
  
    data.forEach((element) => {
      let div1 = document.createElement('div');
      div1.className = "col-4";
      cardContainer.appendChild(div1);
      let div2 = document.createElement('div');
      div2.className = "card shadow-sm";
      div1.appendChild(div2);
      let imgCar = document.createElement('img');
      console.log(element.mainImage);
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
      // myhtml += `<div class="feature col">
      //       <h3 class="fs-2 text-body-emphasis">${element.brand} ${element.model}</h3>
      //       <p>${element.km}</p>
      //     </div>`;
    });
  
  // document.getElementById("test").innerHTML = myhtml;
  // Afficher la pagination
  let nbPage = nbCars / 3 + 1;
  console.log(nbPage);
  
  let currentPage = 1;

  let htmlPagination = "";
  for (let i = 1; i <= nbPage; i++) {
    if (i == currentPage) {
      htmlPagination +=
        '<button class="btn btn-lg btn-primary me-2 active" disabled>' +
        i +
        "</button>";
    } else {
      htmlPagination +=
        '<button onclick="showCars(3,' +
        i +
        ')" class="btn btn-lg btn-outline-dark me-2">' +
        i +
        "</button>";
    }
  }
  document.getElementById("pagination").innerHTML = htmlPagination;
}
// function recupMinMan() {
//   fetch("App/Repository/CarsApi.php?action=minMax")
//     .then((response) => {
//       if (response.ok) {
//         console.log("it's ok");
//         return response.json();
//       }
//       throw new Error("Something went wrong");
//     })
//     .then((data) => {
//       let minMax;
//       if (data.length == 0) {
//         myList.innerHTML =
//           "<p>Toutes nos voitures ont trouvé preneur. N'hésitez pas à nous contacter, de nouvelles oportunités seront bientôt disponibles</p>";
//       } else {
//         return data;
//       }
//     });
// }
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
