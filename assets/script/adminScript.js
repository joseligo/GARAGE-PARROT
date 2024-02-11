// Permettre l'ajout d'une nouvelle marque lors de la création d'une annonce
let inputBrand = document.getElementById("brand");
let divNewBrand = document.getElementById("addBrand");
let addNewBrand = document.getElementById("newBrand");
let inputModel = document.getElementById("model");

inputBrand.addEventListener("change", (e) => {
  divNewModel.classList.add("hidden");
  addNewModel.disabled = true;
  addNewModel.required = false;
  if (e.target.value == "newBrand") {
    divNewBrand.classList.remove("hidden");
    addNewBrand.disabled = false;
    addNewBrand.required = true;
    inputModel.required = false;
    inputModel.disabled = true;
    divNewModel.classList.remove("hidden");
    addNewModel.disabled = false;
    addNewModel.required = true;
  } else {
    divNewBrand.classList.add("hidden");
    addNewBrand.disabled = true;
    addNewBrand.required = false;
    selectModel(e.target.value, inputModel);
  }
});

// Alimenter la liste des modèles en fonction de la marque sélectionnée

function selectModel(value, champ) {
  let option = {
    method: "GET",
    headers: { "Content-Type": "application/json", Accept: "application/json" },
  };
  fetch(`./App/Api/CarsApibis.php?action=getModels&brand=${value}`, option)
    .then((response) => {
      if (response.ok) {
        return response.json();
      }
      throw new Error("Something went wrong");
    })
    .then((data) => {
      if (data.length === 0) {
        console.log("erreur lors de la récupération des models");
      } else {
        champ.innerHTML = "";
        let option = document.createElement("option");
        option.textContent = "---";
        champ.appendChild(option);
        data.forEach((element) => {
          let option = document.createElement("option");
          option.value = element.idModel;
          option.textContent = element.model;
          champ.appendChild(option);
        });
        let option2 = document.createElement("option");
        option2.textContent = "-- Ajouter un modèle";
        option2.value = "newModel";
        champ.appendChild(option2);
      }
    });
}
// Permettre l'ajout d'un nouveau modèle lors de la création d'une annonce

let divNewModel = document.getElementById("addModel");
let addNewModel = document.getElementById("newModel");

inputModel.addEventListener("change", (e) => {
  if (e.target.value == "newModel") {
    divNewModel.classList.remove("hidden");
    addNewModel.disabled = false;
    addNewModel.required = true;
  } else {
    divNewModel.classList.add("hidden");
    addNewModel.disabled = true;
    addNewModel.required = false;
  }
});
