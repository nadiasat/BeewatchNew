<template>


    <button @click="modalCreateMaterial = true" 
    class="flex justify-center items-center mb-4 
    border-amber-400 bg-amber-400 text-zinc-900 
    border-2 rounded-xl py-2 font-semibold 
    w-full lg:w-72 hover:bg-amber-200 hover:border-amber-200">
        <svg class="fill-zinc-900 mr-4" width="16" height="16" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 6H6M12 6H6M6 6V0M6 6V12" stroke="currentColor"/>
        </svg>
        Ajouter du matériel

    </button>




    <Modal v-show="modalCreateMaterial" @close="modalCreateMaterial = false">
        <div class="container">
            <form @submit.prevent="submit" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Nouveau matériel</h4>
                
                <BreezeLabel for="name" value="Nom" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <BreezeInput v-model="createMaterialForm.name" placeholder="Nom matériel" id="name" type="text"
                class="mt-1 block w-full" required />

                <div class="flex justify-between gap-4">
                    <div class="grow">
                        <BreezeLabel for="nb_current_stock" value="Stock actuel" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 " />
                        <BreezeInput v-model="createMaterialForm.current_stock" id="nb_current_stock" type="number" min="0" max="500"
                            class="mt-1 block w-full"/>
                    </div>
                    <div class="grow">
                        <BreezeLabel for="nb_max_stock" value="Stock maximal" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                        <BreezeInput v-model="createMaterialForm.max_stock" id="nb_max_stock" type="number" min="0" max="500"
                            class="mt-1 block w-full"/>
                    </div>
                </div>

                <button type="submit" :class="{ 'opacity-25': createMaterialForm.processing }"
                    :disabled="createMaterialForm.processing"
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                </button>
            </form>

            <div class="text-center">
                <button @click="modalCreateMaterial = false" class="text-red-1 font-semibold">Annuler</button>
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
    name: "MaterialCreate",
    props: {
        //make the porp reactive
        inventory_place_id: {
            type: Number,
        }
    },
    components: {
        Modal,
        BreezeLabel,
        BreezeInput
    },
    data: function (props) {
        return {
            modalCreateMaterial: false,
            createMaterialForm: useForm({
                name: null,
                current_stock: null,
                max_stock: null,
                inventory_place_id: props.inventory_place_id,
            }),
        }
    },
    methods: {
        submit() {
            console.log(this.createMaterialForm)
            console.log(this.createMaterialForm.current_stock > this.createMaterialForm.max_stock)
            //if current stock is greater than max stock then return error
            if (this.createMaterialForm.current_stock > this.createMaterialForm.max_stock) {
                Swal.fire({
                    icon: 'error',
                    title: 'Le stock actuel ne peut pas être supérieur au stock maximal !',
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
                //set stock to null
                this.createMaterialForm.max_stock = null;
                this.createMaterialForm.current_stock = null;
                return;
            }
            
            this.createMaterialForm.post(route('inventoryMaterial.store'), {
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Matériel ajouté avec succès !',
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
                
            });
        }
    },
    mounted() {
        console.log(this.inventory_place_id)
    }
}
</script>

<style scoped>

</style>
