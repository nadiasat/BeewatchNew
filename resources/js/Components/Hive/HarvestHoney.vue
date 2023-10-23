<template>
    <button @click="modalHarvestHoney = true" class="
    flex justify-center
    items-center gap-4 
    mb-4 
    bg-amber-400 
    text-zinc-900
    rounded-xl py-2 
    font-semibold w-full lg:w-72
    mr-5 hover:bg-amber-200">
    <svg class="food-indicator" width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_801_16)">
        <path d="M19 17.3846C19 18.2768 18.2768 19 17.3846 19H2.61538C1.72323 19 1 18.2768 1 17.3846V11L1.46154 10.5066C3.08751 9.90705 4.38869 9.6606 5.67984 9.69321C7.04881 9.72779 8.38966 10.076 10.0711 10.6208L10.078 10.6231L10.0846 10.6257C11.7202 11.2705 12.9831 11.6464 14.2739 11.6777C15.5277 11.7082 16.8283 11.4137 18.5385 10.6882H19V17.3846Z" fill="currentColor"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.61558 4.28846H17.3848C18.277 4.28846 19.0002 5.0117 19.0002 5.90385V10.6882V17.3846C19.0002 18.2768 18.277 19 17.3848 19H2.61558C1.72343 19 1.0002 18.2768 1.0002 17.3846V11V5.90385C1.0002 5.0117 1.72343 4.28846 2.61558 4.28846ZM2.61558 4.75C1.97833 4.75 1.46173 5.2666 1.46173 5.90385V10.5065C3.0877 9.90705 4.38888 9.6606 5.68004 9.69321C7.04901 9.72779 8.38985 10.076 10.0713 10.6208L10.0782 10.6231L10.0848 10.6257C11.7204 11.2705 12.9833 11.6463 14.2741 11.6777C15.5279 11.7082 16.8285 11.4137 18.5387 10.6882V5.90385C18.5387 5.2666 18.0221 4.75 17.3848 4.75H2.61558ZM18.5387 11.1886C16.8777 11.8756 15.5579 12.1706 14.2629 12.1391C12.8903 12.1058 11.5673 11.7059 9.92226 11.0577C8.25187 10.5167 6.9656 10.1874 5.66838 10.1546C4.41055 10.1228 3.12653 10.3698 1.46173 10.9992V17.3846C1.46173 18.0219 1.97833 18.5385 2.61558 18.5385H17.3848C18.0221 18.5385 18.5387 18.0219 18.5387 17.3846V11.1886Z" fill="currentColor"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.950195 5.90385C0.950195 4.98408 1.69581 4.23847 2.61558 4.23846H17.3848C18.3046 4.23847 19.0502 4.98408 19.0502 5.90385V17.3846C19.0502 18.3044 18.3046 19.05 17.3848 19.05H2.61558C1.69581 19.05 0.950195 18.3044 0.950195 17.3846V5.90385ZM2.61558 4.33846C1.75104 4.33846 1.0502 5.03931 1.0502 5.90385V10.8734L1.41173 10.4868V5.90385C1.41173 5.23898 1.95071 4.7 2.61558 4.7H17.3848C18.0497 4.7 18.5887 5.23898 18.5887 5.90385V10.6382H18.9502V5.90385C18.9502 5.03931 18.2494 4.33846 17.3848 4.33846H2.61558ZM18.9502 10.7382H18.5488C16.8393 11.4625 15.5338 11.7583 14.2729 11.7277C12.9731 11.6961 11.7034 11.3175 10.0665 10.6722L10.0613 10.6701L10.0559 10.6684C8.37529 10.1238 7.04016 9.77758 5.67877 9.74319C4.39851 9.71086 3.10673 9.95439 1.49015 10.5494L1.0502 11.0198V17.3846C1.0502 18.2492 1.75104 18.95 2.61558 18.95H17.3848C18.2493 18.95 18.9502 18.2492 18.9502 17.3846V10.7382ZM1.51173 10.435C3.11068 9.8518 4.40012 9.61087 5.6813 9.64323C7.05785 9.678 8.40442 10.0282 10.0867 10.5733L10.0965 10.5764L10.1032 10.5792C11.7374 11.2234 12.9936 11.5966 14.2753 11.6277C15.5122 11.6578 16.7975 11.3695 18.4887 10.655V5.90385C18.4887 5.29421 17.9944 4.8 17.3848 4.8H2.61558C2.00594 4.8 1.51173 5.29421 1.51173 5.90385V10.435ZM1.51173 11.0338V17.3846C1.51173 17.9943 2.00594 18.4885 2.61558 18.4885H17.3848C17.9944 18.4885 18.4887 17.9943 18.4887 17.3846V11.2632C16.8559 11.9317 15.5477 12.2203 14.2617 12.1891C12.8804 12.1555 11.5511 11.7532 9.90538 11.1048C8.23657 10.5643 6.95638 10.2372 5.66712 10.2046C4.42564 10.1732 3.15668 10.4149 1.51173 11.0338ZM1.44405 10.9524C3.11298 10.3214 4.40358 10.0726 5.66965 10.1046C6.97444 10.1376 8.26643 10.4688 9.93766 11.0101L9.94062 11.0111C11.5843 11.6588 12.9006 12.056 14.2641 12.0891C15.5499 12.1203 16.8626 11.8277 18.5195 11.1424L18.5887 11.1138V17.3846C18.5887 18.0495 18.0497 18.5885 17.3848 18.5885H2.61558C1.95071 18.5885 1.41173 18.0495 1.41173 17.3846V10.9647L1.44405 10.9524Z" fill="currentColor"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.07978 1.00001H17.9206C18.5169 1.00001 19.0002 1.48336 19.0002 2.07959V3.29942C19.0002 4.10056 18.3507 4.75001 17.5496 4.75001H2.45079C1.64965 4.75001 1.0002 4.10056 1.0002 3.29942V2.07959C1.0002 1.48336 1.48354 1.00001 2.07978 1.00001ZM2.07978 1.46155C1.73844 1.46155 1.46173 1.73826 1.46173 2.07959V3.29942C1.46173 3.84566 1.90455 4.28847 2.45079 4.28847H17.5496C18.0958 4.28847 18.5387 3.84566 18.5387 3.29942V2.07959C18.5387 1.73826 18.262 1.46155 17.9206 1.46155H2.07978Z" fill="currentColor"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.950195 2.07959C0.950195 1.45574 1.45593 0.950012 2.07978 0.950012H17.9206C18.5445 0.950012 19.0502 1.45574 19.0502 2.07959V3.29942C19.0502 4.12817 18.3784 4.80001 17.5496 4.80001H2.45079C1.62203 4.80001 0.950195 4.12817 0.950195 3.29942V2.07959ZM2.07978 1.05001C1.51115 1.05001 1.0502 1.51097 1.0502 2.07959V3.29942C1.0502 4.07294 1.67726 4.70001 2.45079 4.70001H17.5496C18.3231 4.70001 18.9502 4.07294 18.9502 3.29942V2.07959C18.9502 1.51097 18.4892 1.05001 17.9206 1.05001H2.07978ZM2.07978 1.51155C1.76606 1.51155 1.51173 1.76587 1.51173 2.07959V3.29942C1.51173 3.81804 1.93216 4.23847 2.45079 4.23847H17.5496C18.0682 4.23847 18.4887 3.81804 18.4887 3.29942V2.07959C18.4887 1.76587 18.2343 1.51155 17.9206 1.51155H2.07978ZM1.41173 2.07959C1.41173 1.71064 1.71083 1.41155 2.07978 1.41155H17.9206C18.2896 1.41155 18.5887 1.71064 18.5887 2.07959V3.29942C18.5887 3.87327 18.1235 4.33847 17.5496 4.33847H2.45079C1.87693 4.33847 1.41173 3.87327 1.41173 3.29942V2.07959Z" fill="currentColor"/>
        </g>
        <defs>
        <clipPath id="clip0_801_16">
        <rect width="20" height="20"/>
        </clipPath>
        </defs>
    </svg>
        Nouvelle récolte
    </button>


    <Modal v-show="modalHarvestHoney" @close="modalHarvestHoney = false">
        <div class="container">
            <form @submit.prevent="submit" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-bold text-zinc-900">Nouvelle récolte de miel</h4>
                <!-- layout grid wit 2 columns and gap 4 -->
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">

                    <!-- in harvestHoneyForm create one input like the above for each jar in jars -->
                    <div v-for="jar in harvestHoneyForm.jars">
                        <BreezeLabel :for="'honey_jar'+jar.id" :value="jar.size" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 " />
                        <BreezeInput v-model="jar.number" :placeholder="jar.number" :id="'honey_jar'+id" type="number" min="0" class="mt-1 block w-full"/>
                    </div>




                </div>

                <button type="submit" :class="{ 'opacity-25': harvestHoneyForm.processing }"
                    :disabled="harvestHoneyForm.processing"
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                </button>
            </form>

            <div class="text-center">
                <button @click="modalHarvestHoney = false" class="text-red-1 font-semibold">Annuler</button>
            </div>
        </div>
    </Modal>




</template>

<script>
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";
import Swal from "sweetalert2";

export default {
    name: "HiveCreate",
    components: {
        Modal,
        BreezeLabel,
        BreezeInput
    },
    props: ['honey_jars', 'apiary_id'],
    data: function (props) {

        //using useForm create a form where for each jar we have a select with the number of jars
        let harvestHoneyForm = useForm({
            apiary_id:  props.apiary_id,
            jars: props.honey_jars.map(jar => {
                return {
                    id: jar.id,
                    size: jar.size,
                    number: 0
                }
            })
        });


        return {
            harvestHoneyForm,
            selectedValues: null,
            modalHarvestHoney: false,
            
        }
    },
    methods: {
        
        submit() {
            
            //foreach jar in jars, if the number of jar is not 0, add it to the form

            //if all inputs are 0, do not submit the form
            if (this.harvestHoneyForm.jars.every(jar => jar.number == 0)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Vous devez renseigner au moins un pot de miel',
                })
                return;
            }

            this.harvestHoneyForm.post(route('inventoryHoney.harvest'), {
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Récolte de miel enregistrée avec succès',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                },
            })
        }
    },
    mounted() {
        //console.log(this.hives)
        //console.log segment of url
        console.log(this.honey_jars);
    }
}
</script>

<style scoped>

</style>
