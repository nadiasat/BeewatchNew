<template>
    <div class="apiary-card bg-white p-4 flex flex-col items-start rounded-xl max-w-md">
      <p class="name text-base font-semibold text-black self-stretch flex items-center mb-2">{{ apiary.name }}</p>
      <p class="adresse font-medium text-amber-400 self-stretch flex items-center mb-2 text-sm">{{ apiary.address }}</p>
      <p class="title-nb-active-hives text-sm font-medium text-black self-stretch flex items-center mb-2">Ruches actives</p>
      <p class="value-nb-active-hives text-base font-medium text-amber-400 self-stretch flex items-center mb-2">{{ apiary.nb_active_hives }}</p>
      <p class="title-nb-active-hives text-sm font-medium text-black self-stretch flex items-center mb-2">Ruches inactives</p>
      <p class="value-nb-inactive-hives text-base font-medium text-zinc-400 self-stretch flex items-center mb-2">{{ apiary.nb_inactive_hives }}</p>
      <div @click="showHives()" class="btn-show-hives bg-amber-400 mb-2 rounded-md flex items-center justify-center h-3 self-stretch px-12 py-4 cursor-pointer">
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
        <p class="btn-edit-hive-text font-medium text-black text-center text-sm">Modifier le rucher</p>
      </div>
    </div>
  </template>

    
    <script>

    import Swal from "sweetalert2";
    import { useForm } from "@inertiajs/inertia-vue3";
    import { Inertia } from "@inertiajs/inertia-vue3";

    export default {
      name: "ApiaryCard",
      props: ["apiary"],
      data: function () {
        return {
          apiary_id: null,
        };
      },
      methods: {
        deleteApiary() {
          Swal.fire({
            title: "Voulez-vous vraiment supprimer ce rucher ?",
            text: "Cette action est irréversible.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d93131",
            confirmButtonText: "Confirmer",
            cancelButtonText: "Annuler",
          }).then((result) => {
            if (result.isConfirmed) {
              useForm({}).delete(route("apiaries.destroy", this.apiary_id), {
                onSuccess() {
                  Swal.fire({
                    icon: "success",
                    title: "Rucher supprimé avec succès",
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
        //Redirect to hives page
        showHives() {
          this.$inertia.get("hive", { apiary: this.apiary });
        },
      },
      mounted() {
        console.log(this.apiary);
      },
    };
    </script>