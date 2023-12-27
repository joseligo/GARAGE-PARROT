let myList = document.getElementById("test");

function showCars() {
  let option = {
    headers:{ 'Content-Type': 'application/json',
              'Accept': 'application/json' } 
  };
  fetch("./App/Api/CarsApibis.php?action=showAllCars", option)
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
        console.log(data);
        data.forEach(car=>  {myList.innerHTML += car.model});
      }
    });
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
