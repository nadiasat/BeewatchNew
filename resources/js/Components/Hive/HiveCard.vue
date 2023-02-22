<template>
    <div class="apiary-card bg-white p-4 flex flex-col items-start rounded-xl ">
      <p class="name text-base font-semibold text-black self-stretch flex items-center mb-2">Nom ruche</p>
      <p class="adresse font-medium text-amber-400 self-stretch flex items-center mb-2 text-sm">Emplacement / adresse du rucher</p>
      <p class="title-nb-active-hives text-xs font-medium text-black self-stretch flex items-center mb-2">Ruches actives</p>
      <p class="value-nb-active-hives text-base font-medium text-amber-400 self-stretch flex items-center mb-2">5</p>
      <p class="title-nb-active-hives text-xs font-medium text-black self-stretch flex items-center mb-2">Ruches inactives</p>
      <p class="value-nb-inactive-hives text-base font-medium text-zinc-400 self-stretch flex items-center mb-2">2</p>
      <div class="btn-show-hives bg-amber-400 mb-2 rounded-md flex items-center justify-center h-3 self-stretch px-12 py-4">
        <p class="btn-show-hives-text font-medium text-black text-center text-sm">
          Consulter les ruches
        </p>
      </div>
      <div class="btn-edit-hive rounded-md flex items-center justify-center self-stretch px-12 py-4 border-solid border-black border-2">
        <img
          alt=""
          class="edit-icon"
          src="https://static.overlay-tech.com/assets/7d7cec2a-72c6-4360-b376-ef7e694a0092.svg"
        />
        <p class="btn-edit-hive-text font-medium text-black text-center text-sm">Modifier la ruche</p>
      </div>
    </div>


    <div class="hive-card bg-white p-4 flex flex-col items-start rounded-xl ">
      <div class="top-text mb-2 flex flex-col items-start self-stretch">
        <p class="name text-base font-semibold text-black self-stretch flex items-center mb-1">Nom ruche</p>
        <p class="date-queen font-medium text-amber-400 self-stretch flex items-center mb-2 text-sm">Date reine : 06.04.2021</p>
      </div>
      <div class="rise-section mb-2 flex flex-col items-start self-stretch pb-1 border-b-4">
        <p class="title-hausse flex items-center mb-1 font-medium">Hausse</p>
      </div>
      <div class="top-text mb-2 flex flex-col items-start self-stretch">
        <p class="title-frames flex items-center mb-1">Nombre de rayons</p>
        <div class="nb-frames mb-2 flex items-start self-stretch">
          <p class="text-nb-frames text-base font-medium text-amber-400 self-stretch flex items-center">6</p>
          <div class="frames-indicator">
            <div class="frame"></div>
          </div>
        </div>
      </div>
      <div class="top-text mb-2 flex flex-col items-start self-stretch">
        <p class="title-nb-varoas">Nombre de varoas</p>
        <p class="nb-varoas">10</p>
      </div>
      <div class="btn-new-intervention">
        <p class="btn-new-intervention-text">
          Nouvelle intervention
        </p>
      </div>
      <div class="btn-hive-details">
        <p class="btn-new-intervention-text">
          Détails de la ruche
        </p>
      </div>
    </div>
  </template>
    <script>

    import Swal from "sweetalert2";
    import { useForm } from "@inertiajs/inertia-vue3";

    export default {
      name: "HiveCard",
      props: ["hive"],
      data: function () {
        return {
          hive_id: null,
        };
      },
      methods: {
        deleteHive() {
          Swal.fire({
            title: "Voulez-vous vraiment supprimer cette ruche ?",
            text: "Cette action est irréversible.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d93131",
            confirmButtonText: "Confirmer",
            cancelButtonText: "Annuler",
          }).then((result) => {
            if (result.isConfirmed) {
              useForm({}).delete(route("hive.destroy", this.hive_id), {
                onSuccess() {
                  Swal.fire({
                    icon: "success",
                    title: "Ruche supprimé avec succès",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener("mouseenter", Swal.stopTimer);
                      toast.addEventListener("mouseleave", Swal.resumeTimer);
                    },
                  });
                },
              });
            }
          });
        },
      },
      mounted() {
        console.log(this.hive);
      },
    };
    </script>