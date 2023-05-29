<template>


    <button @click="modalCreateJar = true" class="flex justify-center items-center mb-4 
    border-amber-400 bg-amber-400 text-zinc-900 
    border-2 rounded-xl py-2 font-semibold 
    w-full lg:w-72 hover:bg-amber-200 hover:border-amber-200">
        <svg class="fill-zinc-900 mr-4" width="16" height="16" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 6H6M12 6H6M6 6V0M6 6V12" stroke="currentColor"/>
        </svg>
        Ajouter une sortie de pots

    </button>

    <Modal v-show="modalCreateJar" @close="modalCreateJar = false">
        <div class="container">
            <form @submit.prevent="submit" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Nouvelle sortie de pots</h4>
                
                    <!-- make 2 radio buttons yes or no -->
                    <div class="flex items-center gap-4 mt-1">
                        <label for="user">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createJarForm.other_person_checked" 
                            type="radio" id="user" name="other_person_radio" value="false"
                            @change="onChange($event)">
                            Membre
                        </label>
                        <label for="other_person_yes">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createJarForm.other_person_checked" 
                            type="radio" id="other_person" name="other_person_radio" value="true" 
                            @change="onChange($event)">
                            Personne externe
                        </label>
                    </div>
                
                <div id="other_person_input" v-if="createJarForm.other_person_checked == 'true'">
                    <BreezeLabel for="other_person_name" value="Personne externe" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <BreezeInput v-model="createJarForm.other_person" placeholder="Nom de la personne" id="other_person_name" type="text"
                        class="mt-1 block w-full" />
                </div>

                <div id="membre_input" v-else="createJarForm.other_person_checked">
                    <BreezeLabel for="user" value="Personne" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                    <VueMultiselect 
                        v-model="createJarForm.user"
                        :options="users"
                        :taggable="true"
                        :multiple="false"
                        :label="'name'"
                        :track-by="'id'"
                        id="user" 
                        class="mt-1 block w-full">
                    </VueMultiselect>
                </div>


                <div class="flex gap-4">
                    <div class="flex-grow">
                        <BreezeLabel for="date" value="Date de sortie" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                        <BreezeInput v-model="createJarForm.created_at" placeholder="Date de début" id="date_start" type="date"
                        class="mt-1 block w-full"/>
                    </div>
                    
                    <div class="flex-grow">
                        <BreezeLabel for="jar" value="Type" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                        <VueMultiselect 
                            v-model="createJarForm.jar"
                            :options="jars"
                            :taggable="true"
                            :multiple="false"
                            :label="'size'"
                            :track-by="'id'"
                            id="jar" 
                            class="mt-1 block w-full">
                        </VueMultiselect>
                    </div>
                </div>

                <BreezeLabel for="nb_jars" value="Nombre de pots" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <BreezeInput v-model="createJarForm.nb_jar" id="nb_jars" type="number" min="0" max="100"
                    class="mt-1 block w-full" required/>



                <button type="submit" :class="{ 'opacity-25': createJarForm.processing }"
                    :disabled="createJarForm.processing"
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                </button>
            </form>

            <div class="text-center">
                <button @click="modalCreateJar = false" class="text-red-1 font-semibold">Annuler</button>
            </div>
        </div>
    </Modal>




</template>

<script>
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";
import BreezeCheckbox from "@/Components/Checkbox.vue";
import VueMultiselect from 'vue-multiselect';
import Swal from "sweetalert2";
import { constrainPoint } from "@fullcalendar/core/internal";

export default {
    name: "RecordCreate",
    props: {
        jars: {
            type: Object,
            required: true
        },
        users: {
             type: Object,
             required: true
        }
    },
    components: {
        Modal,
        BreezeLabel,
        BreezeInput,
        BreezeCheckbox,
        VueMultiselect
    },
    data: function (props) {

        //get only size and id of jars in jar object
        // props.jars.forEach((element, index) => {
        //     props.jars[index] = {
        //         size: element.size,
        //         id: element.id
        //     }
        // });

        //get only lastname + firstname and id of users in users object
        props.users.forEach((element, index) => {
            props.users[index] = {
                name: element.lastname + ' ' + element.firstname,
                id: element.id
            }
        });
        return {
            modalCreateJar: false,
            createJarForm: useForm({
                created_at: null,
                nb_jar: null,
                jar: null,
                user: null,
                other_person_checked: false,
                other_person: null,
            }),
            jars: props.jars,
            
            users: props.users,
        }
    },
    methods: {
        submit() {
            //get only id of jar
            this.createJarForm.jar = this.createJarForm.jar.id;

            //if user is null, set user to 0
            if (this.createJarForm.user == null) {
                this.createJarForm.user = 0;
            }
            else {
                this.createJarForm.user = this.createJarForm.user.id;
            }
            //console.log(this.createJarForm);
            //$honey_jar->nb_jar - $request->nb_jar < 0
            //console.log(this.jars);

            // find jar in jars array
            let jar = this.jars.find(jar => jar.id == this.createJarForm.jar);

            if (jar.nb_jar - this.createJarForm.nb_jar < 0) {
                //console.log('error');
                Swal.fire({
                    icon: 'error',
                    title: 'Le stock actuel de pot n\'est pas suffisant !',
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
                this.createJarForm.nb_jar = null;
                return;
            }

            this.createJarForm.post(route('inventoryHoney.record'), {
                // if  new record nb_jar - nb_nbjar is lower than 0, print error

                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Nouvelle sortie de pots créés avec succès',
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
                }
            })
        },
        //on change
        onChange(event) {
            //console.log(event.target.value);
            //console.log(this.createJarForm.other_person_checked);
            //if other_person_checked is true, set user to null

            if (this.createJarForm.other_person_checked == 'true') {
                this.createJarForm.user = null;
            }
            else {
                this.createJarForm.other_person = null;
            }

            console.log(this.createJarForm);
        }
    },
    mounted() {
        // console.log(this.jars);
        // console.log(this.users);

    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
