/*********************
 Modal pour ajout de projet
 *********************/

var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
  modal.style.display = "block";
};
span.onclick = function () {
  modal.style.display = "none";
};
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

/*********************
 Modal pour plus de détail 
 *********************/

var addModal = document.getElementById("addProjectModal");
var infoModal = document.getElementById("projectInfoModal");
document.getElementById("openAddModalButton").onclick = function () {
  addModal.style.display = "block";
};
document.getElementById("openInfoModalButton").onclick = function () {
  infoModal.style.display = "block";
};
window.onclick = function (event) {
  if (event.target == addModal) {
    addModal.style.display = "none";
  }
  if (event.target == infoModal) {
    infoModal.style.display = "none";
  }
};

$(document).ready(function () {
  $(".btn-projet").click(function () {
    var projectId = $(this).data("id"); // Récupère l'ID du projet
    // Effectuer une requête AJAX pour obtenir les données du projet
    $.ajax({
      url: "get_project_details.php", // Créer ce fichier PHP pour retourner les données du projet
      type: "POST",
      data: { id: projectId },
      success: function (response) {
        // Supposons que 'response' est l'HTML qui doit être inséré dans la modale
        $("#projectInfoModal .modal-content-projet").html(response);
        $("#projectInfoModal").modal("show");
      },
    });
  });
});

/*********************
 Modal pour plus de détail ( submit quand on fait entré )
 *********************/
/* 
document
  .getElementById("com_pperso")
  .addEventListener("keydown", function (event) {
    if (event.key === "Enter" && !event.shiftKey) {
      event.preventDefault();
      this.form.submit();
    }
  }); */
