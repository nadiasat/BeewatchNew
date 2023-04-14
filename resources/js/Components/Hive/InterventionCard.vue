<template>
    <div class="list-card
    bg-white rounded-lg flex items-center
    border-solid border-zinc-300 border-1 px-6 py-3
    w-full justify-between">
      <div class="texts flex flex-col items-start">
        <p class="title self-stretch mb-1 font-semibold text-lg">{{ intervention.type}}</p>
        <p class="subtitle font-normal self-stretch text-sm"> {{ intervention.created_at }}</p>
      </div>
      <div class="btn-container slef-stretch flex gap-4">
        <div v-if="$page.props.auth.user.permissions.includes('manage hives')"
        class="btn-edit rounded-lg
        p-3 flex items-center
        border-2 border-zinc-900">
            <img
            alt=""
            class="edit-icon w-3 h-3"
            src="https://static.overlay-tech.com/assets/d661920a-1401-4883-91fa-934ff7ed6836.svg"
            />
        </div>
        <div 
        class="btn-show-details rounded-lg
        p-3 flex items-center
        bg-amber-400">
            <img
            alt=""
            class="arrow-right w-3 h-3"
            src="https://static.overlay-tech.com/assets/6eb03e7e-64b0-4584-9fc5-8151fa9fec31.svg"
            />
        </div>
      </div>
      
    </div>
  </template>
  
  <script>
  export default {
    name: "InterventionCard",
    props: ["intervention"],
    mounted() {

      // modify the props to display the right data
      if (this.intervention.type === "control") {
            this.intervention.type = "Contrôle de la ruche";
        } else if (this.intervention.type === "new_queen") {
            this.intervention.type = "Nouvelle reine";
        } else if (this.intervention.type === "material") {
            this.intervention.type = "Modification du matériel";
        } else if (this.intervention.type === "remove_queen") {
            this.intervention.type = "Retrait de la reine";
        } else if (this.intervention.type === "other") {
            this.intervention.type = "Autre";
        }

        //parse date to display mm-dd-yyyy hh:mm
        this.intervention.created_at = new Date(this.intervention.created_at).toLocaleString();
        // fromat date to display "le dd-mm-yyyy à hh:mm"
        this.intervention.created_at = this.intervention.created_at.slice(0, 10) + " à " + this.intervention.created_at.slice(11, 16);

        //console.log(this.intervention);
    
    },
  };
  </script>