<template>
    <div class="hive-card bg-white p-4 flex flex-col items-start rounded-xl max-w-md">
      <div class="top-text mb-2 flex flex-col items-start self-stretch">
        <p class="name text-base font-semibold text-black self-stretch flex items-center mb-1">{{ hive.name }}</p>
        <div class="flex flex-row align-middle justify-between self-stretch">
          <p class="date-queen font-medium text-amber-400 self-stretch flex items-center mb-2 text-sm" :class="{'text-[#AFAC99]' : !hive.is_active}">{{hive.date_queen == null ? 'Pas de reine' : 'Date reine : ' + hive.date_queen}}</p>
          <svg v-if="hive.is_active" width="22" height="22" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9.44349 7.70355H10.6441C10.8546 7.70355 11.0566 7.66744 11.2444 7.60107C11.7827 7.62614 12.716 8.1651 13.1749 9.90463C13.3414 10.5359 13.4454 11.3254 13.4454 12.3058C13.4454 13.2437 13.2896 14.115 13.0375 14.9071C12.2999 17.2241 10.7698 18.8539 9.87506 19.5001C8.98033 18.8539 7.38743 17.2241 6.64989 14.9071C6.39778 14.115 6.24194 13.2437 6.24194 12.3058C6.24194 11.3254 6.36491 10.5359 6.56172 9.90463C7.10402 8.1651 8.20701 7.62614 8.8432 7.60107C9.03096 7.66744 9.23301 7.70355 9.44349 7.70355Z" :fill="hive.color_queen"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M6.64989 14.9071C6.67923 14.9992 6.70992 15.0903 6.74186 15.1802C7.51304 17.3522 9.01592 18.8796 9.87506 19.5001C10.7342 18.8796 12.1793 17.3522 12.9458 15.1802C12.9776 15.0902 13.0082 14.9992 13.0375 14.9071C13.2666 14.1872 13.4162 13.4018 13.4416 12.5605C13.4441 12.4761 13.4454 12.3912 13.4454 12.3058C13.4454 11.3254 13.3414 10.5359 13.1749 9.90463C13.1529 9.82151 13.1299 9.74112 13.1059 9.6634C12.6277 8.11476 11.757 7.62494 11.2444 7.60107C11.0566 7.66744 10.8546 7.70355 10.6441 7.70355H9.44349C9.23301 7.70355 9.03096 7.66744 8.8432 7.60107C8.23711 7.62495 7.20736 8.11525 6.64236 9.66569C6.6143 9.74269 6.58738 9.82232 6.56172 9.90463C6.36491 10.5359 6.24194 11.3254 6.24194 12.3058C6.24194 12.3912 6.24324 12.4761 6.24578 12.5605C6.27114 13.4018 6.42075 14.1872 6.64989 14.9071ZM6.74918 12.6449C6.78116 13.3939 6.91744 14.0957 7.12243 14.7431C7.30998 14.7773 7.54841 14.8187 7.81395 14.8601C8.45297 14.9598 9.23553 15.0572 9.84369 15.0572C10.4518 15.0572 11.2344 14.9598 11.8734 14.8601C12.139 14.8187 12.3774 14.7773 12.5649 14.7431C12.7699 14.0957 12.9062 13.3939 12.9382 12.6449C12.734 12.6775 12.4845 12.7155 12.2095 12.7535C11.4839 12.8539 10.5694 12.956 9.84369 12.956C9.11802 12.956 8.20346 12.8539 7.47786 12.7535C7.20291 12.7155 6.95337 12.6775 6.74918 12.6449ZM12.9444 12.1375C12.9345 11.3765 12.8582 10.7505 12.742 10.2387C12.5498 10.2723 12.311 10.3121 12.0466 10.3519C11.3803 10.4523 10.5383 10.5548 9.86829 10.5548C9.19827 10.5548 8.35627 10.4523 7.68999 10.3519C7.4214 10.3115 7.17926 10.271 6.98549 10.2371C6.84673 10.7464 6.75498 11.3724 6.74323 12.1375C6.95842 12.1724 7.23603 12.2153 7.54635 12.2582C8.26782 12.358 9.15413 12.456 9.84369 12.456C10.5332 12.456 11.4196 12.358 12.141 12.2582C12.4514 12.2153 12.7291 12.1724 12.9444 12.1375ZM7.14207 9.7568C7.31959 9.78746 7.53201 9.82249 7.76448 9.85752C8.4263 9.95723 9.23758 10.0548 9.86829 10.0548C10.499 10.0548 11.3103 9.95723 11.9721 9.85752C12.2116 9.82144 12.4297 9.78535 12.6104 9.75404C12.2102 8.50476 11.5763 8.16871 11.294 8.11033C11.0874 8.17108 10.8692 8.20355 10.6441 8.20355H9.44349C9.2152 8.20355 8.99392 8.17015 8.7847 8.10771C8.38864 8.16147 7.61832 8.52084 7.14207 9.7568ZM12.3737 15.2847C12.2441 15.307 12.1016 15.3306 11.9505 15.3542C11.3069 15.4546 10.4925 15.5572 9.84369 15.5572C9.19484 15.5572 8.3805 15.4546 7.73688 15.3542C7.58626 15.3307 7.44425 15.3072 7.31499 15.285C7.98028 16.9708 9.09836 18.2176 9.87398 18.8653C10.6358 18.2207 11.7144 16.9751 12.3737 15.2847Z" fill="#181818"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00533 0.671011C7.04899 0.540025 7.19057 0.469235 7.32156 0.512897C8.50518 0.907437 9.15137 2.07104 9.45139 2.61129C9.45465 2.61715 9.45786 2.62294 9.46104 2.62866C9.52809 2.74935 9.48461 2.90155 9.36391 2.96861C9.24321 3.03566 9.09101 2.99217 9.02396 2.87148C8.7136 2.31283 8.14879 1.31569 7.16344 0.987239C7.03246 0.943577 6.96167 0.801997 7.00533 0.671011Z" fill="#181818"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8821 0.671011C12.8385 0.540025 12.6969 0.469235 12.5659 0.512897C11.3823 0.907437 10.7361 2.07104 10.4361 2.61129C10.4328 2.61715 10.4296 2.62294 10.4264 2.62866C10.3594 2.74935 10.4028 2.90155 10.5235 2.96861C10.6442 3.03566 10.7964 2.99217 10.8635 2.87148C11.1738 2.31283 11.7387 1.31569 12.724 0.987239C12.855 0.943577 12.9258 0.801997 12.8821 0.671011Z" fill="#181818"/>
              <path d="M16.9088 16.0338C15.6136 16.7815 13.6778 15.8533 12.585 13.9605C11.4922 12.0677 11.6918 7.33617 11.8292 5.54325C13.5514 6.83375 16.1823 9.35984 17.2751 11.2526C18.3679 13.1454 18.2039 15.286 16.9088 16.0338Z" fill="white"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M14.8872 15.5365C15.5702 15.864 16.1958 15.868 16.6588 15.6007C17.1217 15.3334 17.431 14.7896 17.4889 14.0344C17.5465 13.282 17.3447 12.3732 16.8421 11.5026C16.3269 10.6103 15.4302 9.54079 14.4312 8.52218C13.7107 7.78756 12.951 7.09347 12.2684 6.528C12.2243 7.41054 12.197 8.55017 12.2453 9.69328C12.2795 10.5017 12.3512 11.3024 12.4786 12.0103C12.6075 12.7258 12.7872 13.3106 13.018 13.7105C13.5206 14.581 14.2068 15.2102 14.8872 15.5365ZM11.7887 6.14184C11.6652 8.22632 11.5981 12.2511 12.585 13.9605C13.6778 15.8533 15.6136 16.7815 16.9088 16.0338C18.2039 15.286 18.3679 13.1454 17.2751 11.2526C16.2787 9.52669 14.0033 7.27419 12.3041 5.91205C12.1399 5.78037 11.981 5.65701 11.8292 5.54325C11.8159 5.71695 11.802 5.91823 11.7887 6.14184Z" fill="#181818"/>
              <path d="M3.09514 16.0338C4.39029 16.7815 6.3261 15.8533 7.4189 13.9605C8.51171 12.0677 8.31212 7.33617 8.17473 5.54325C6.45255 6.83375 3.82158 9.35984 2.72878 11.2526C1.63597 13.1454 1.8 15.286 3.09514 16.0338Z" fill="white"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M5.11671 15.5365C4.4337 15.864 3.80813 15.868 3.34514 15.6007C2.88216 15.3334 2.57289 14.7896 2.51502 14.0344C2.45737 13.282 2.65919 12.3732 3.16179 11.5026C3.67698 10.6103 4.57371 9.54079 5.57271 8.52218C6.29319 7.78756 7.05293 7.09347 7.73552 6.528C7.77964 7.41054 7.80694 8.55017 7.75858 9.69328C7.72439 10.5017 7.6527 11.3024 7.52526 12.0103C7.39645 12.7258 7.21675 13.3106 6.98589 13.7105C6.48329 14.581 5.79711 15.2102 5.11671 15.5365ZM8.21518 6.14184C8.33866 8.22632 8.40583 12.2511 7.4189 13.9605C6.3261 15.8533 4.39029 16.7815 3.09514 16.0338C1.8 15.286 1.63597 13.1454 2.72878 11.2526C3.72525 9.52669 6.00065 7.27419 7.69978 5.91205C7.86404 5.78037 8.02292 5.65701 8.17473 5.54325C8.18804 5.71695 8.20193 5.91823 8.21518 6.14184Z" fill="#181818"/>
              <path d="M10 7.00006C8.89543 7.00006 8 6.11396 8 5.0209L8 4.22923C8 3.13616 8.89543 2.25006 10 2.25006C11.1046 2.25006 12 3.13616 12 4.22923V5.0209C12 6.11396 11.1046 7.00006 10 7.00006Z" :fill="hive.color_queen"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M8.5 4.22923L8.5 5.0209C8.5 5.83289 9.16662 6.50006 10 6.50006C10.8334 6.50006 11.5 5.83289 11.5 5.0209V4.22923C11.5 3.41723 10.8334 2.75006 10 2.75006C9.16662 2.75006 8.5 3.41723 8.5 4.22923ZM8 5.0209C8 6.11396 8.89543 7.00006 10 7.00006C11.1046 7.00006 12 6.11396 12 5.0209V4.22923C12 3.13616 11.1046 2.25006 10 2.25006C8.89543 2.25006 8 3.13616 8 4.22923V5.0209Z" fill="#181818"/>
              <path d="M7.24219 6.70308C7.24219 5.48746 8.18285 4.50201 9.3432 4.50201H10.7439C11.9042 4.50201 12.8449 5.48746 12.8449 6.70308C12.8449 7.66144 12.2603 8.47674 11.4442 8.7789C11.2252 8.86001 10.9894 8.90415 10.7439 8.90415H9.3432C9.09764 8.90415 8.86192 8.86001 8.64287 8.7789C7.82684 8.47674 7.24219 7.66144 7.24219 6.70308Z" fill="white"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M10.7439 5.00201H9.3432C8.48065 5.00201 7.74219 5.74143 7.74219 6.70308C7.74219 7.45743 8.20143 8.08227 8.81649 8.31001C8.98105 8.37095 9.15805 8.40415 9.3432 8.40415H10.7439C10.929 8.40415 11.106 8.37095 11.2706 8.31001C11.8857 8.08227 12.3449 7.45743 12.3449 6.70308C12.3449 5.74143 11.6064 5.00201 10.7439 5.00201ZM9.3432 4.50201C8.18285 4.50201 7.24219 5.48746 7.24219 6.70308C7.24219 7.66144 7.82684 8.47674 8.64287 8.7789C8.86192 8.86001 9.09764 8.90415 9.3432 8.90415H10.7439C10.9894 8.90415 11.2252 8.86001 11.4442 8.7789C12.2603 8.47674 12.8449 7.66144 12.8449 6.70308C12.8449 5.48746 11.9042 4.50201 10.7439 4.50201H9.3432Z" fill="#181818"/>
          </svg>
        </div>
      </div>
      <div class="rise-section mb-4 flex flex-col items-start self-stretch pb-1 border-b-4" :class="[hive.rise && hive.is_active ? 'border-amber-400' : 'border-[#AFAC99]']">
        <p class="title-hausse h-3 flex items-center mb-1 font-medium text-sm">Hausse</p>
      </div>
      <div class="top-text mb-2 flex flex-col items-start self-stretch">
        <p class="title-frames h-3 flex items-center mb-1 text-sm">Nombre de cadres</p>
        <div class="nb-frames flex items-start self-stretch">
          <p class="text-nb-frames mr-4 text-base font-semibold text-amber-400 self-stretch flex items-center align-middle" :class="{'text-[#AFAC99]' : !hive.is_active}">{{ hive.nb_frames }}</p>
          <div class="frames-indicator h-full grow flex items-start justify-between pt-[2px] pb-[2px]" >
            <div v-for="frame in hive.nb_frames" class="frame w-1 h-full rounded-md" :class="[hive.is_active ? 'bg-amber-400' : 'bg-[#AFAC99]']"></div>
          </div>
        </div>
      </div>
      <div class="top-text mb-2 flex flex-col items-start self-stretch">
        <p class="title-nb-varoas h-3 self-stretch flex items-center mb-1 text-sm">Nombre de varoas</p>
        <p class="nb-varoas text-base font-semibold" :class="{'text-[#AFAC99]' : !hive.is_active}">{{ hive.nb_varroa }}</p>
      </div>
      <!-- <div class="btn-new-intervention bg-amber-400 hover:bg-amber-200 mb-2 rounded-md flex items-center justify-center h-3 self-stretch px-10 py-5 cursor-pointer" :class="[!hive.is_active ? 'bg-[#AFAC99] hover:bg-[#E0DDCE]' : '']">
        <p class="btn-new-intervention-text font-medium text-black text-center text-sm">
          Nouvelle intervention
        </p>
      </div> -->
      <ButtonNewIntervention :hive="hive" ></ButtonNewIntervention>
      <div @click="showDetails()" 
      class="btn-hive-details rounded-md flex 
      items-center justify-center 
      self-stretch px-10 py-2 
      border-solid border-zinc-900 border-2
      hover:bg-zinc-900 hover:text-white text-zinc-900 cursor-pointer">
        <p class="btn-new-intervention-text font-medium text-center text-sm">
          Détails de la ruche
        </p>
      </div>
    </div>
  </template>
    <script>

    import Swal from "sweetalert2";
    import { useForm } from "@inertiajs/inertia-vue3";
    import ButtonNewIntervention from "./ButtonNewIntervention.vue";
    import {Inertia} from "@inertiajs/inertia";
    export default {
      name: "HiveCard",
      props: ["hive"],
      data: function () {
        return {
          hive_id: null,
        };
      },
      components: {
        ButtonNewIntervention,
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
        showDetails() {
          Inertia.get(route("hive.details", 
          {
            apiary: this.hive.apiary_id, 
            hive: this.hive.id, 
            hive_id: this.hive.id, 
            hive_name: this.hive.name}));
        }
      },
      mounted() {
        //console.log(this.hive);
      },
    };
    </script>