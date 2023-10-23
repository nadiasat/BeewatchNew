<template>
  <div class="apiary-card bg-white p-4 flex flex-col items-start rounded-xl grow max-w-xs">
    <p class="name text-base font-semibold text-black self-stretch flex items-center mb-2">{{ apiary.name }}</p>
    <p class="adresse font-medium text-amber-400 self-stretch flex items-center mb-2 text-sm break-normal">{{ apiary.address }}</p>
    <p class="title-nb-active-hives text-sm font-medium text-black self-stretch flex items-center mb-2">Ruches actives</p>
    <p class="value-nb-active-hives text-base font-medium text-amber-400 self-stretch flex items-center mb-2">{{
      apiary.nb_active_hives }}</p>
    <p class="title-nb-active-hives text-sm font-medium text-black self-stretch flex items-center mb-2">Ruches inactives
    </p>
    <p class="value-nb-inactive-hives text-base font-medium text-zinc-400 self-stretch flex items-center mb-2">{{
      apiary.nb_inactive_hives }}</p>
    <div @click="showHives()"
      class="btn-show-hives bg-amber-400 hover:bg-amber-200 mb-2 rounded-md flex items-center justify-center h-3 self-stretch px-12 py-5 cursor-pointer">
      <p class="btn-show-hives-text font-medium text-black text-center text-sm">
        Consulter les ruches
      </p>
    </div>

    <ApiaryEdit 
    v-if="$page.props.auth.user.permissions.includes('manage apiaries')"
    :apiary="apiary"
    :inventory_places="inventory_places"></ApiaryEdit>

    </div>
</template>

    
<script>

import Swal from "sweetalert2";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import ApiaryEdit from "./ApiaryEdit.vue";

export default {
  name: "ApiaryCard",

  props: ["apiary", "inventory_places"],
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
      //redirect to hives page using route
      Inertia.get(route("hive", this.apiary.id));

      //location.href = '/apiary/' + this.apiary.id + '/hive';
      //this.$inertia.get("hive", { apiary: this.apiary });
    },
  },
  mounted() {
    console.log(this.apiary);
  },
  components: {
    ApiaryEdit,
  },
};
</script>