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

        <div 
        class="btn-show-details rounded-lg
        p-3 flex items-center
        bg-amber-400 hover:bg-amber-200
        cursor-pointer">
            Détails
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

      switch (this.intervention.type) {
        case "control":
          this.intervention.type = "Contrôle de la ruche";
          break;
        case "new_queen":
          this.intervention.type = "Nouvelle reine";
          break;
        case "material":
          this.intervention.type = "Modification du matériel";
          break;
        case "remove_queen":
          this.intervention.type = "Retrait de la reine";
          break;
        case "other":
          this.intervention.type = "Autre";
          break;
      }

        //parse date to display mm-dd-yyyy hh:mm
        this.intervention.created_at = new Date(this.intervention.created_at).toLocaleString();
        // fromat date to display "le dd-mm-yyyy à hh:mm"
        this.intervention.created_at = this.intervention.created_at.slice(0, 10) + " à " + this.intervention.created_at.slice(11, 16);

        //console.log(this.intervention);
    
    },
  };
  </script>