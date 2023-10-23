<template>
    <div class="list-card
    bg-white rounded-lg flex items-center
    border-solid border-zinc-300 border-1 px-6 py-3
    w-full justify-between">
      <div class="texts flex flex-col items-start">
        <p class="title self-stretch mb-1 font-semibold text-lg">{{ intervention.type}}</p>
        <p class="subtitle font-normal self-stretch text-sm"> {{ intervention.formated_date }}</p>
      </div>
      <div v-if="intervention.type == 'Contrôle de la ruche' || intervention.type == 'Modification du matériel' || intervention.type == 'Traitement pour varroas' || intervention.type == 'Traitement pour maladie'"
      class="btn-container slef-stretch flex gap-4">

        <div 
        class="btn-show-details rounded-lg
        p-3 flex items-center
        bg-amber-400 hover:bg-amber-200
        cursor-pointer"
        @click="detailsClick">
            Détails
        </div>
      </div>
      
    </div>

    

    <!-- MODAL CONTROL-->
    <Modal v-show="showControlModal" @close="showControlModal = false">
      <form id="control-form" class="mx-8">
          <h4 class="text-center text-2xl font-bold pb-2 text-zinc-900">Résumé du contrôle</h4>
          <p class="text-center text-base font-semibold pb-8 text-zinc-900">Intervention du : {{ intervention.formated_date }}</p>
          <BreezeLabel value="Avez-vous aperçu la reine ?" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
          <!-- make 2 radio buttons yes or no -->
          <div class="flex items-center gap-4 mt-1">
              <label for="yes_glimpse">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.glimpse_queen" type="radio" id="yes_glimpse" name="glimpse_queen" value="true" 
                  :checked="controlForm.glimpse_queen === 1">
                  Oui
              </label>
              <label for="no_glimpse">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.glimpse_queen" type="radio" id="no_glimpse" name="glimpse_queen" value="false"
                  :checked="controlForm.glimpse_queen === 0">
                  Non
              </label>
          </div>

          <BreezeLabel value="La reine a-t-elle pondu ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
          <div class="flex items-center gap-4 mt-1">
              <label for="yes_laid">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.queen_laid" type="radio" id="yes_laid" name="queen_laid" value="true" 
                  :checked="controlForm.queen_laid === 1">
                  Oui
              </label>
              <label for="no_laid">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.queen_laid" type="radio" id="no_laid" name="queen_laid" value="false"
                  :checked="controlForm.queen_laid === 0">
                  Non
              </label>
          </div>
          
          <BreezeLabel value="Y a-t-il du couvain ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
          <div class="flex items-center gap-4 mt-1">
              <label for="yes_brood">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.brood" type="radio" id="yes_brood" name="brood" value="true" 
                  :checked="controlForm.brood === 1">
                  Oui
              </label>
              <label for="no_brood">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.brood" type="radio" id="no_brood" name="brood" value="false" 
                  :checked="controlForm.brood === 0">
                  Non
              </label>
          </div>

          <BreezeLabel value="Les cadres sont-ils pleins ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
          <div class="flex items-center gap-4 mt-1">
              <label for="yes_frames">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.frames_full" type="radio" id="yes_frames" name="frames_full" value="true" 
                  :checked="controlForm.frames_full === 1">
                  Oui
              </label>
              <label for="no_frames">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.frames_full" type="radio" id="no_frames" name="frames_full" value="false"
                  :checked="controlForm.frames_full === 0">
                  Non
              </label>
          </div>

          <BreezeLabel value="Y a-t-il du miel ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
          <div class="flex items-center gap-4 mt-1">
              <label for="yes_honey">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.honey" type="radio" id="yes_honey" name="honey" value="true" 
                  :checked="controlForm.honey === 1">
                  Oui
              </label>
              <label for="no_honey">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.honey" type="radio" id="no_honey" name="honey" value="false"
                  :checked="controlForm.honey === 0">
                  Non
              </label>
          </div>

          <BreezeLabel value="Y a-t-il du miel sur les cadres de la hausse ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
          <div class="flex items-center gap-4 mt-1">
              <label for="yes_honey_rise">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.honey_rise" type="radio" id="yes_honey_rise" name="honey_rise" value="true" 
                  :checked="controlForm.honey_rise === 1">
                  Oui
              </label>
              <label for="no_honey_rise">
                  <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                  v-model="controlForm.honey_rise" type="radio" id="no_honey_rise" name="honey_rise" value="false"
                  :checked="controlForm.honey_rise === 0">
                  Non
              </label>
          </div>

          <BreezeLabel value="Le miel est-t-il operculé ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes_sealed_honey">
                            <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="controlForm.sealed_honey" type="radio" id="yes_sealed_honey" name="sealed_honey" value="true" 
                            :checked="controlForm.sealed_honey === 1">
                            Oui
                        </label>
                        <label for="no_sealed_honey">
                            <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="controlForm.sealed_honey" type="radio" id="no_sealed_honey" name="sealed_honey" value="false"
                            :checked="controlForm.sealed_honey === 0">
                            Non
                        </label>
                    </div>

                    <BreezeLabel value="Y a-t-il beaucoup de cellules males ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes_male_cells">
                            <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="controlForm.male_cells" type="radio" id="yes_male_cells" name="male_cells" value="true" 
                            :checked="controlForm.male_cells === 1">
                            Oui
                        </label>
                        <label for="no_male_cells">
                            <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="controlForm.male_cells" type="radio" id="no_male_cells" name="male_cells" value="false"
                            :checked="controlForm.male_cells === 0">
                            Non
                        </label>
                    </div>

                    <BreezeLabel value="Avez-vous aperçu et éliminé des cellules de futures reines ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes_eliminate_queen_cells">
                            <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="controlForm.eliminate_queen_cells" type="radio" id="yes_eliminate_queen_cells" name="eliminate_queen_cells" value="true" 
                            :checked="controlForm.eliminate_queen_cells === 1">
                            Oui
                        </label>
                        <label for="no_eliminate_queen_cells">
                            <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="controlForm.eliminate_queen_cells" type="radio" id="no_eliminate_queen_cells" name="eliminate_queen_cells" value="false"
                            :checked="controlForm.eliminate_queen_cells === 0">
                            Non
                        </label>
                    </div>

                    <BreezeLabel value="La plaque sous les ruchers a-t-elle été nettoyée ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes_clean_plate">
                            <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="controlForm.clean_plate" type="radio" id="yes_clean_plate" name="clean_plate" value="true" 
                            :checked="controlForm.clean_plate === 1">
                            Oui
                        </label>
                        <label for="no_eclean_plate">
                            <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="controlForm.clean_plate" type="radio" id="no_clean_plate" name="clean_plate" value="false"
                            :checked="controlForm.clean_plate === 0">
                            Non
                        </label>
                    </div>
          
          <BreezeLabel for="nb_varroa" value="Nombre de varroas" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
          <BreezeInput readonly v-model="controlForm.nb_varroa" placeholder="25" id="nb_varroa" type="number" min="0" max="500"
                      class="mt-1 block w-full"/>

          <BreezeLabel for="comment" value="Commentaire supplémentaire" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
          <textarea readonly v-model="controlForm.comment"
          id="comment"
          class="mt-1 block w-full
          border-zinc-300 
          focus:border-amber-400 focus:ring-amber-400 
          rounded-md shadow-sm resize-none"
          rows="6" />

      </form>
      
      <div class="text-center">
              <button @click="() => {showControlModal = false}" class="text-red-1 font-semibold mt-4">Fermer</button>
      </div>
    </Modal>


    <!-- MATERIAL FORM -->
    <Modal v-show="showMaterialModal" @close="() => {showMaterialModal = false}">
        <form id="material-form" class="mx-8">
            <h4 class="text-center text-2xl font-bold pb-2 text-zinc-900">Résumé de la modification du matériel</h4>
            <p class="text-center text-base font-semibold pb-8 text-zinc-900">Intervention du : {{ intervention.formated_date }}</p>
            <BreezeLabel value="Hausse" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
            <!-- make 2 radio buttons yes or no -->
            <div class="flex items-center gap-4 mt-1">
                <label for="yes">
                    <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                    v-model="materialForm.rise" type="radio" id="yes" name="rise" value="true" :checked="materialForm.rise === 1">
                    Oui
                </label>
                <label for="no">
                    <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                    v-model="materialForm.rise" type="radio" id="no" name="rise" value="false"
                      :checked="materialForm.rise === 0">
                    Non
                </label>
            </div>


            <BreezeLabel for="nb_frames" value="Placement des cadres" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 " />
            <div class="frames-indicator grow flex items-start justify-between pt-[2px] pb-[2px]" >
                <div v-for="(value, index) in selectedValues" 
                :key="index"
                class="flex flex-col gap-1 justify-center items-center">
                    <!-- if value if empty text is "-", if frame "c", and if separator "s"-->

                    <div
                    class="w-4 h-[40px] rounded"
                    :class="value === 'empty' ? 'bg-[#AFAC99]' : value === 'frame' ? 'bg-amber-400' : 'bg-zinc-900'">
                    </div>

                    <div class="w-4 h-full rounded-md">
                        <!-- if value is empty pprint "-", if frame "c", and if separator "s"-->
                        <p class="text-center text-s font-bold text-zinc-900" :class="value === 'empty' ? 'text-zinc-900' : value === 'frame' ? 'text-white' : 'text-white'">
                            {{ value === 'empty' ? ' ' : value === 'frame' ? 'c' : 's' }}</p>
                    </div>

                </div>
            </div>

            
        </form>
        <div class="text-center">
                <button @click="() => {showMaterialModal = false;}" class="text-red-1 font-semibold mt-4">Fermer</button>
        </div>
    </Modal>

    <Modal v-show="showTreatmentModal" @close="() => {showTreatmentModal = false}">
      <!-- TREATMENT FORM -->
      <form id="treatment-form" class="mx-8">       
        <h4 v-if="treatmentForm.is_active == 1" class="text-center text-2xl font-bold pb-2 text-zinc-900">Résumé de nouveau traitement</h4>
        <h4 v-else class="text-center text-2xl font-bold pb-2 text-zinc-900">Résumé de fin de traitement</h4>
        <p class="text-center text-base font-semibold pb-8 text-zinc-900">Intervention du : {{ intervention.formated_date }}</p> 
        <BreezeLabel value="Traitement actif ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
        <!-- make 2 radio buttons yes or no -->
        <div class="flex items-center gap-4 mt-1">
            <label for="yes">
                <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                v-model="treatmentForm.is_active" type="radio" id="yes" name="rise" value="true" 
                :checked="treatmentForm.is_active === 1">
                Oui
            </label>
            <label for="no">
                <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                v-model="treatmentForm.is_active" type="radio" id="no" name="rise" value="false"
                :checked="treatmentForm.is_active === 0">
                Non
            </label>
        </div>

        <BreezeLabel v-if="treatmentForm.is_active == 'true' || treatmentForm.is_active == 1" 
        value="Type de traitement" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
        <!-- make a select with 2 options : varroas and sickness -->
        <select v-if="treatmentForm.is_active == 'true' || treatmentForm.is_active == 1"
        required disabled
        v-model="treatmentForm.type" class="mt-1 block w-full border-zinc-300
        focus:border-amber-400 focus:ring-amber-400 rounded-md shadow-sm">
            <option value="varroas">
                Varroas
            </option>
            <option value="sickness">
                Maladie
            </option>
        </select>

        <div v-if="treatmentForm.is_active == 'true' || treatmentForm.is_active == 1">
            <BreezeLabel value="Intensité du traitement" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
            <!-- make 2 radio buttons yes or no -->
            <div class="flex items-center gap-4 mt-1">
                <label for="low">
                    <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                    v-model="treatmentForm.intensity" type="radio" id="low" name="intensity" value="1" 
                    :checked="treatmentForm.intensity === 1">
                    Basse
                </label>
                <label for="medium">
                    <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                    v-model="treatmentForm.intensity" type="radio" id="medium" name="intensity" value="2"
                    :checked="treatmentForm.intensity === 2">
                    Moyenne
                </label>

                <label for="high">
                    <input disabled class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                    v-model="treatmentForm.intensity" type="radio" id="high" name="intensity" value="3"
                    :checked="treatmentForm.intensity === 3">
                    Haute
                </label>
            </div>
        </div>             
      </form>
      <div class="text-center">
              <button @click="() => {showTreatmentModal = false}" class="text-red-1 font-semibold mt-4">Fermer</button>
      </div>
    </Modal>


                    

  </template>
  
  <script>


  import Modal from "@/Components/Modal.vue";
  import { useForm } from "@inertiajs/inertia-vue3";
  import BreezeLabel from "@/Components/InputLabel.vue";
  import BreezeInput from "@/Components/TextInput.vue";

  export default {
    name: "InterventionCard",
    props: ["intervention"],
    components: {
      Modal,
      BreezeInput,
      BreezeLabel,
    },
    data(props) {

      console.log(props.intervention);

      let controlForm = useForm({
        hive_id: null,
        glimpse_queen: null,
        queen_laid: null,
        brood: null,
        frames_full: null,
        honey: null,
        honey_rise: null,
        sealed_honey: null,
        male_cells: null,
        eliminate_queen_cells: null,
        clean_plate: null,
        nb_varroa: null,
        comment: null,
      });
      
      let materialForm = useForm({
        hive_id: null,
        rise: null,
        frames_slots: null,
      });

      let treatmentForm = useForm({
        hive_id: null,
        is_active: null,
        type: null,
        intensity: null,
      });

      let frames_slots = null;
      


      switch (props.intervention.type) {
        case "control":
          controlForm =  useForm({
            hive_id: props.intervention.hive_id,
            glimpse_queen: props.intervention.details.glimpse_queen,
            queen_laid: props.intervention.details.queen_laid,
            brood: props.intervention.details.brood,
            frames_full: props.intervention.details.frames_full,
            honey: props.intervention.details.honey,
            honey_rise: props.intervention.details.honey_rise,
            sealed_honey: props.intervention.details.sealed_honey,
            male_cells: props.intervention.details.male_cells,
            eliminate_queen_cells: props.intervention.details.eliminate_queen_cells,
            clean_plate: props.intervention.details.clean_plate,
            nb_varroa: props.intervention.details.nb_varroa,
            comment: props.intervention.details.comment,
          });


          break;
        case "material":
          materialForm =  useForm({
              rise: props.intervention.details.new_rise,
              frames_slots: props.intervention.details.new_frames_slots,
          });

          frames_slots = props.intervention.details.new_frames_slots.split(',');

          //change values to full words
          frames_slots = frames_slots.map((value) => {
              if (value === 'e') {
                  return 'empty';
              } else if (value === 'c') {
                  return 'frame';
              } else {
                  return 'separator';
              }
          });

          break;
        case "treatment":
          treatmentForm =  useForm({
            is_active: props.intervention.details.is_active,
            type: props.intervention.details.type,
            intensity: props.intervention.details.intensity,
          });
          break;
      }

      return {
        showControlModal: false,
        showMaterialModal: false,
        showTreatmentModal: false,

        selectedValues: frames_slots,

        controlForm,
        materialForm,
        treatmentForm,
      };
    },
    methods: {
      detailsClick() {
        switch (this.intervention.type) {
          case "Contrôle de la ruche":
            this.showControlModal = true;
            console.log(this.controlForm);
            break;
          case "Modification du matériel":
            this.showMaterialModal = true;
            console.log(this.materialForm);
            break;
          case "Traitement pour varroas":
          case "Traitement pour maladie":
          case "Fin de traitement":
            this.showTreatmentModal = true;
            console.log(this.treatmentForm);
            break;
          
        }
        
      },
    },
    mounted() {

      // modify the props to display the right data

      console.log(this.intervention);

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
        case "treatment":
          if (this.intervention.details.intensity == 0) {
            this.intervention.type = "Fin de traitement";
          } else {
            this.intervention.type = "Traitement pour " + this.intervention.details.type;
          }
          
          break;
        case "add_food":
          this.intervention.type = "Nourrissement";
          break;
        case "remove_food":
          this.intervention.type = "Retrait du nourrissement";
          break;
        case "other":
          this.intervention.type = "Autre";
          break;
      }

        //parse date to display mm-dd-yyyy hh:mm
        //this.intervention.formated_date = new Date(this.intervention.formated_date).toLocaleString();
        // fromat date to display "le dd-mm-yyyy à hh:mm"
        //this.intervention.formated_date = this.intervention.formated_date.slice(0, 10) + " à " + this.intervention.formated_date.slice(11, 16);

        //console.log(this.intervention);
    
    },
  };
  </script>