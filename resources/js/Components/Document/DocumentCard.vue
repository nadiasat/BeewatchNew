<template>
    <div class="list-card
    bg-white rounded-lg flex items-center
    border-solid border-zinc-300 border-1 px-6 py-3
    w-full justify-between">
      <div class="texts flex flex-col items-start">
        <p class="title self-stretch mb-1 font-semibold text-lg">{{ document.name }}</p>
        <p class="subtitle font-normal self-stretch text-sm">{{ document.type }}</p>
      </div>
      <div class="btn-container slef-stretch flex gap-4">

        <div 
        class="btn-show-details rounded-lg
        p-3 flex items-center
        bg-amber-400 hover:bg-amber-200
        cursor-pointer"
        @click="openPdf()">
            Détails
        </div>
      </div>
      
    </div>

    <!-- <div class="pdf-container"
    v-show="showPDF">
        <VuePDF :src="pdf" />
    </div> -->
  </template>
  
  <script>

  //import { VuePDF, usePDF} from '@tato30/vue-pdf'

  export default {
    name: "DocumentCard",
    props: ["document"],
    components: {
      //VuePDF,
    },
    // setup(props) {

    //   const showPDF = false;
    //   const { pdf, pages, info } = usePDF(props.document.file_path)

    //   console.log(`Document has ${pages} pages`)
    //   console.log(`Document info: ${info}`)

    //   return {
    //     pdf,
    //     showPDF,
    //   }
    // },
    methods: {
        openPdf() {
          showPDF = true;
        }
    },
    mounted() {

      console.log(this.document);
      // modify the props to display the right data

    //   switch (this.intervention.type) {
    //     case "control":
    //       this.intervention.type = "Contrôle de la ruche";
    //       break;
    //     case "new_queen":
    //       this.intervention.type = "Nouvelle reine";
    //       break;
    //     case "material":
    //       this.intervention.type = "Modification du matériel";
    //       break;
    //     case "remove_queen":
    //       this.intervention.type = "Retrait de la reine";
    //       break;
    //     case "other":
    //       this.intervention.type = "Autre";
    //       break;
    //   }

        //console.log(this.intervention);
    
    },
  };
  </script>